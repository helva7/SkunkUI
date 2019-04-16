<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Location;
use App\Entity\Geofence;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;   


use Symfony\Component\HttpFoundation\Session\SessionInterface;



class Backend extends AbstractController
{
    
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }
    
    
	/**
     * @Route("/location", name="last_known_location") methods={"GET", "POST"}
     */

	public function getLatLong(SessionInterface $session)
    {	
		
		$latLong = $this->getDoctrine()
			->getRepository(Location::class)
			->findLastKnownLocation();
		
		return $this->render('latLong.html.twig', ['latLong'=>$latLong]);
		
		
	}
	
	
	/**
     * @Route("/geofence", name="geofence") methods={"GET","POST"}
     */
    public function geofence()
    {
		$request = Request::createFromGlobals(); // the envelope, and were looking inside it.

        // catch the variables we sent from the JavaScript.
        $lat = $request->request->get('lat', 'default');
		
		$lng = $request->request->get('lng', 'default');
    
        
        // to work the objects
        $entityManager = $this->getDoctrine()->getManager();

        // create blank entity of type "Geofence"
        $fence = new Geofence();
        
        $fence->setLat($lat);
		
		$fence->setLng($lng);
		
      
        $entityManager->persist($fence);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
		
       
        return new Response(
            'Geofence is set!'
        );
    }
	
	
	
	
    
    
}