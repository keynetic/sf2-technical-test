<?php

namespace AppBundle\Controller;

use FOS\UserBundle\Model\UserInterface;
use Github\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class DefaultController extends Controller {
	/**
	 * @Route("/", name="homepage")
	 * @Template()
	 */
	public function indexAction(Request $request) {

		if ( $this->isGranted( 'IS_AUTHENTICATED_REMEMBERED' ) ) {

			$params = array();
			$query  = $request->get( 'q' );
			if ( $query ) {
				$client = new Client();
				$users  = $client->api( 'users' )->find( $query );
				$params['results'] = $users;

				if ( empty($users['users']) ) {
					$this->get('session')->getFlashBag()->add( 'notice', 'No results' );
				}
			}

			return $params;
		} else {
			return $this->redirectToRoute( 'fos_user_security_login' );
		}
	}


}
