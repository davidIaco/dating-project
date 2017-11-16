<?php

namespace FollowMeBundle\Form;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class Add extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add( "dating_title", TextType::class, [
					"label"=> "add.label.title",
				"constraints"=> [
						new Regex([ "pattern" => "/^[\w]{3,32}$/",
								"message" => "Erreur de typo"]),
						new NotBlank([ "message" => "add.error.title"])
				],
				"attr"=> [
						"class"=> "form-control",
						"placeholder" => "add.label.hide.title",
				]
		])
			->add( "dating_description", TextareaType::class, [
				"label"=> "add.label.describe",
				"constraints"=> [
						new Regex([ "pattern" => "/^[\w]{3,2048}$/",
								"message" => "Erreur de typo"]),
						new NotBlank([ "message" => "add.error.describe"])
						
				],
				"attr"=> [
						"class"=> "form-control",
						"placeholder" => "add.label.hide.describe",
				]
		])
			->add( "dating_start", DateTimeType::class, [
				"label"=> "add.label.start.time",
				'format' => 'yyyy-MM-dd HH:mm',
				"constraints"=> [						
						new NotBlank([ "message" => "add.error.starttime"])
				],
				
		])
			->add( "dating_end", TimeType::class, [
				"label"=> "add.label.end.time",
				"constraints"=> [						
						new NotBlank([ "message" => "add.error.endtime"])
				],				
		]);
	}
}
