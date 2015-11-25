<?php

namespace AppBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use AppBundle\Form\Type\RepoType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('repo', 'repo')
			->add('body', 'textarea')
			->add('save', 'submit', array( 'label' => 'Create comment' ) )
		;
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'AppBundle\Entity\Comment'
		));
	}

	public function getName()
	{
		return 'comment';
	}
}