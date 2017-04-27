<?php

namespace EC\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoriesController extends Controller
{
	public function menuAction()
	{
		$em = $this->getDoctrine()->getManager();
		$categories = $em->getRepository('ECEcommerceBundle:Categories')->findAll();

		return $this->render('ECEcommerceBundle:Categories:categories.html.twig', array(
			'categories' => $categories
		));
	}
}