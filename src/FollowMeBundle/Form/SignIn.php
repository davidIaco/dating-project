<?php

namespace FollowMeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Regex;

class SignIn extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder 
				->add( "user_mail", EmailType::class, [
					"label"=> "sign.mail",
					"constraints"=> [
						new Email([ "message" => "sign.mail.error"]),
						new NotBlank([ "message" => "sign.mail.error"])
				],
				"attr"=> [
						"class"=> "form-control",
						"placeholder" => "sign.mail",
				]
		])
				->add( "user_pswd", TextType::class, [
					"label"=> "sign.pswd",
					"constraints"=> [
						new Regex([ "pattern" => "/^[\w]{8,32}$/",
								"message" => "sign.wrong.pswd.error"]),
						new NotBlank([ "message" => "sign.pswd.error"])
				],
				"attr"=> [
						"class"=> "form-control",
				]
		]);				
	}	
}
