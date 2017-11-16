<?php

namespace FollowMeBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class SignUp extends SignIn
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		parent::buildForm( $builder, $options);
		
		$builder 			
				->add( "confirm", TextType::class, [
					"label"=> "sign.confirm",
					"constraints"=> [
						new Regex([ "pattern" => "/^[\w]{8,32}$/",
								"message" => "sign.wrong.pswd.error"]),
						new NotBlank([ "message" => "sign.must.confirm"])
				],
					"attr"=> [
						"class"=> "form-control",
				]
		]);
	}	
}
