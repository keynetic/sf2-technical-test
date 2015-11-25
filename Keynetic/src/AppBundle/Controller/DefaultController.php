<?php

namespace AppBundle\Controller;

use FOS\UserBundle\Model\UserInterface;
use Github\Client;
use AppBundle\Form\Type;
use AppBundle\Form\Type\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class DefaultController extends Controller {
	/**
	 * @Route("/", name="homepage")
	 * @Template()
	 */
	public function indexAction( Request $request ) {

		if ( $this->isGranted( 'IS_AUTHENTICATED_REMEMBERED' ) ) {

			$params = array();
			$query  = $request->get( 'q' );

			if ( $query ) {
				$client            = new Client();
				$users             = $client->api( 'users' )->find( $query );
				$params['results'] = $users;

				if ( empty( $users['users'] ) ) {
					$this->get( 'session' )->getFlashBag()->add( 'notice', 'No results' );
				}
			}

			return $params;
		} else {
			return $this->redirectToRoute( 'fos_user_security_login' );
		}
	}

	/**
	 * @Route(path="/{username}/comment", name="comment")
	 * @Template()
	 */
	public function commentAction( Request $request, $username ) {

		if ( $this->isGranted( 'IS_AUTHENTICATED_REMEMBERED' ) and ! empty( $username ) ) {

			$params             = array();
			$params['username'] = $username;
			$user               = $this->getUser();

			$client       = new Client();
			$repositories = $client->api( 'user' )->repositories( $username );

			$repos       = array();
			$em          = $this->getDoctrine()->getManager();
			$rRepository = $em->getRepository( 'AppBundle:Repo' );

			if ( ! is_object( $user ) || ! $user instanceof UserInterface ) {
				throw new AccessDeniedException( 'This user does not have access to this section.' );
			}

			foreach ( $repositories as $repository ) {
				$comments               = $rRepository->getCommentsforUser( $repository['id'], $user );
				$repository['comments'] = $comments;

				$form               = $this->createForm( new CommentType( $repository['id'] ) );
				$repository['form'] = $form->createView();
				$repos[]            = $repository;
				$form->handleRequest( $request );

				if ( $form->isValid() ) {
					$comment = $form->getData();
					$comment->setUser( $user );

					$repo = $rRepository->find( $comment->getRepo()->getId() );

					if ( $repo == null ) {
						$em->persist( $comment );

					} else {
						$repo->addComment( $comment );
						$em->persist( $repo );
					}

					$em->flush();

					return $this->redirectToRoute( 'comment', array( 'username' => $username ) );
				}
			}

			$params['repositories'] = $repos;

			return $params;

		} else {
			return $this->redirectToRoute( 'fos_user_security_login' );
		}
	}


}
