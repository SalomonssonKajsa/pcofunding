<?php

namespace PCO\ExtractBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AdvertController extends Controller{
//class AdvertController{

	public function indexAction(){
		//return new Response("testest");
		return $this->render('PCOExtractBundle:Advert:index.html.twig');

	}

	public function projetsAction(){

		//hämta projekt
		$adresse = "https://lendix.com/projets/";
		$page = file_get_contents ($adresse);

		return $this->render('PCOExtractBundle:Advert:projets.html.twig');

	}

	public function plateformesAction(){
		return $this->render('PCOExtractBundle:Advert:plateformes.html.twig');
	}
}