<?php


namespace Test\PlatformBundle\Controller;	//var man hittar controllern

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\HttpFoundation\Response; //controllern använder sig av Response
use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdvertController extends Controller
{

	public function indexAction($page)	
    {
    	//skapar access till container
    	$mailer=$this->container->get('mailer');
    	
    	//finns ingen sida under 1
    	if($page < 1){
    		//trigga exception NotFOundException, kommer ge error 404
    		throw new NotFoundHttpException('Page"'.$page.'" inexistante.');
    	}

    // Notre liste d'annonce en dur
    $listAdverts = array(
      array(
        'title'   => 'Recherche développpeur Symfony',
        'id'      => 1,
        'author'  => 'Alexandre',
        'content' => 'Nous recherchons un développeur Symfony débutant sur Lyon. Blabla…',
        'date'    => new \Datetime()),
      array(
        'title'   => 'Mission de webmaster',
        'id'      => 2,
        'author'  => 'Hugo',
        'content' => 'Nous recherchons un webmaster capable de maintenir notre site internet. Blabla…',
        'date'    => new \Datetime()),
      array(
        'title'   => 'Offre de stage webdesigner',
        'id'      => 3,
        'author'  => 'Mathieu',
        'content' => 'Nous proposons un poste pour webdesigner. Blabla…',
        'date'    => new \Datetime())
    );


    	//här ska listan över annoncer hämtas, för att sedan visas genom template
    	return $this->render('TestPlatformBundle:Advert:index.html.twig', array('listAdverts'=>$listAdverts));
    }

	public function viewAction($id){

		$advert = array(
			'title'=>'Recherche développeur Symfony2',
			'id'=> $id,
			'author'=> 'Alexandre',
			'content'=> 'Nous rechercherons un développeur Symfony2 débutant sur Lyon.',
			'date'=> new \Datetime()
			);

		//hämtar annoncen med id $id
		return $this->render('TestPlatformBundle:Advert:view.html.twig', array('advert'=>$advert));
	}


	public function addAction(Request $request){

		//hämtar antispam-servicen
		$antispam=$this->container->get('test_platform.antispam');

		$text='...';
		if($antispam->isSpam($text)){
			throw new \Exception('Votre message a été détecté comme spam');
		}

		//Om requesten är en POST så har besökaren submittat ett formulär
		if($request->isMethod('POST')){
			//Här behandlar man hantering av formuläret
			$request->getSession()->getFlashBag()->add('notice','Annonce bien enregistrée.');
			//sedan skickar man vidare till sida där annonsen visualiseras
			return $this->redirectToRoute('test_platform_view', array('id'=>5));
		}

		//om inte POST, då visar man formuläret
		return $this->render('TestPlatformBundle:Advert:add.html.twig');

	}

	public function editAction($id, Request $request){
		//här hämtar man annonsen med id $id
		//samma metod som för add
		if($request->isMethod('POST')){
			$request->getSession()->getFlashBag()->add('notice','Annonce bien modifiée.');
			return $this->redirectToRoute('test_platform_view', array('id'=>5));
		}

		$advert= array(
			'title'=> 'Recherche développeur Symfony',
			'id'=> $id,
			'author'=> 'Alexandre',
			'content'=> 'Nous recherchons un développeur Symfony débutant sur Lyon',
			'date'=> new \Datetime()

			);

		return $this->render('TestPlatformBundle:Advert:edit.html.twig', array('advert'=>$advert));
	}

	public function deleteAction($id){
		//Hämtar annonsen med id $id
		//tar bort annonsen
		return $this->render('TestPlatformBundle:Advert:delete.html.twig');
	}

	public function menuAction(){
	//just nu: en fast lista. sen: hämta från databas
	$listAdverts = array(
      array('id' => 2, 'title' => 'Recherche développeur Symfony'),
      array('id' => 5, 'title' => 'Mission de webmaster'),
      array('id' => 9, 'title' => 'Offre de stage webdesigner')
    );

    return $this->render('TestPlatformBundle:Advert:menu.html.twig', array(
      // Tout l'intérêt est ici : le contrôleur passe
      // les variables nécessaires au template !
      'listAdverts' => $listAdverts
    ));
	}


}