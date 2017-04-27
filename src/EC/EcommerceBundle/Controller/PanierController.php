<?php

namespace EC\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use EC\EcommerceBundle\Form\UtilisateursAdressesType;
use EC\EcommerceBundle\Entity\UtilisateursAdresses;


class PanierController extends Controller
{
	public function ajouterAction($id)
	{
		$session = $this->getRequest()->getSession();

		if (!$session->has('panier')) 
			$session->set('panier', array());

		$panier = $session->get('panier');

		if (array_key_exists($id, $panier)) {
			if ($this->getRequest()->query->get('qte') != null)
				$panier[$id] = $this->getRequest()->query->get('qte');

			$this->get('session')->getFlashBag()->add('success','Quantité modifié avec succès');
		}
		else {
			if ($this->getRequest()->query->get('qte') != null)
				$panier[$id] = $this->getRequest()->query->get('qte');
			else
				$panier[$id] = 1;

			$this->get('session')->getFlashBag()->add('success','Article ajouté avec succès');
		}

		$session->set('panier',$panier);

		return $this->redirect($this->generateUrl('panier'));
	}

	public function supprimerAction($id)
	{
		$session = $this->getRequest()->getSession();
		$panier = $session->get('panier');

		if (array_key_exists($id, $panier)) {

			unset($panier[$id]);
			$session->set('panier', $panier);
			$this->get('session')->getFlashBag()->add('success', 'Article supprimé avec succès');
		}

		return $this->redirect($this->generateUrl('panier'));
	}

	public function panierAction()
	{
		$session = $this->getRequest()->getSession();
		if (!$session->has('panier'))
			$session->set('panier', array());

		$em = $this->getDoctrine()->getManager();
		$produits = $em->getRepository('ECEcommerceBundle:Produits')->findArray(array_keys($session->get('panier')));

		return $this->render('ECEcommerceBundle:Panier:contenu.html.twig', array(
			'produits' => $produits,
			'panier' => $session->get('panier')
		));

	}

	public function livraisonAction()
	{
		$em = $this->getDoctrine()->getManager();
		$utilisateur = $this->container->get('security.context')->getToken()->getUser();
		$entity = new UtilisateursAdresses();
		$form = $this->createForm(new UtilisateursAdressesType($em), $entity);

		if ($form->handleRequest($this->getRequest())->isValid()) {

			$em = $this->getDoctrine()->getManager();
			$entity->setUtilisateur($utilisateur);
			$em->persist($entity);
			$em->flush();

			return $this->redirect($this->generateUrl('livraison'));
		}

		return $this->render('ECEcommerceBundle:Panier:livraison.html.twig', array(
			'utilisateur' => $utilisateur,
			'form' => $form->createView()
		));
	}

	public function menuAction()
	{
		$session = $this->getRequest()->getSession();
		if (!$session->has('panier'))
			$articles = 0;
		else
			$articles = count($session->get('panier'));

		return $this->render('ECEcommerceBundle:Panier:panier.html.twig', array(
			'articles' => $articles));
	}

}