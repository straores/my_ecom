<?php

namespace EC\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EC\EcommerceBundle\Entity\Categories;


class ProduitsController extends Controller
{
	public function produitsAction(Categories $categorie = null)
	{
		$session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getManager();
		
        if ($categorie != null)
            $findProduits = $em->getRepository('ECEcommerceBundle:Produits')->byCategory($categorie);
        else
            $findProduits = $em->getRepository('ECEcommerceBundle:Produits')->findBy(array(
                'disponible' => 1
            ));

        if ($session->has('panier'))
            $panier = $session->get('panier');
        else
            $panier = false;

        $produits = $this->get('knp_paginator')->paginate($findProduits, $this->getRequest()
            ->query->get('page', 1),3);


        return $this->render('ECEcommerceBundle:Produits:produits.html.twig', array(
            'produits' => $produits,
            'panier' => $panier
        ));
	}

    public function presentationAction($id)
    {
        $session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository('ECEcommerceBundle:Produits')->find($id);

        if (!$produit) throw $this->createNotFoundException("La page n'existe pas");

        if ($session->has('panier'))
            $panier = $session->get('panier');
        else
            $panier = false;

        return $this->render('ECEcommerceBundle:Produits:presentation.html.twig', array(
            'produit' => $produit,
            'panier' => $panier
        ));
    }

}


