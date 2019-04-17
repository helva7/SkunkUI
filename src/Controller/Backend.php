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
     * @Route("/fence", name="show_existing_geofence") methods={"GET", "POST"}
     */

	public function getGeofence(SessionInterface $session)
    {	
		
		$fence = $this->getDoctrine()
			->getRepository(Geofence::class)
			->findFence();
			
		if (!$fence) {
			
			return new Response('1');
			
		} else {
		
			return $this->render('fence.html.twig', ['fence'=>$fence]);
		}
	}
	
	
	
	/**
     * @Route("/geofence", name="create_geofence") methods={"GET","POST"}
     */
    public function geofence()
    {
		$request = Request::createFromGlobals(); // the envelope, and were looking inside it.

        // catch the variables we sent from the JavaScript.
		// if fence is not set, the first componetn will not exist (as all of them)
        
		if ( $request->request->get('lat', 'default') )  {
		
			$lat = $request->request->get('lat', 'default');
			
			$lng = $request->request->get('lng', 'default');
			
			$radius = $request->request->get('radius', 'default');
			
				if ( ($radius != 0.00) AND ($lat != 0.00) AND ($lng != 0.00)) {
				
					// to work the objects
					$entityManager = $this->getDoctrine()->getManager();

					// create blank entity of type "Geofence"
					$fence = new Geofence();
					
					$fence->setLat($lat);
					
					$fence->setLng($lng);
					
					$fence->setRadius($radius);
					
				  
					$entityManager->persist($fence);

					// actually executes the queries (i.e. the INSERT query)
					$entityManager->flush();
					
				   
					return new Response(
						'Geofence is set!'
					);
				}
			
		} else {
			
			throw $this->createNotFoundException(
				'Geo fence is not set.'
			);
		}
		
		if ( $radius == 0.00 ) {
			
			throw $this->createNotFoundException(
				'Geo fence is not set.'
			);
		}
    
        
    }
	
	
	
	/**
     * @Route("/deleteFence", name="delete_fence") methods={"GET", "POST"}
     */

	public function deleteFence(SessionInterface $session)
    {	
		
		$entityManager = $this->getDoctrine()->getManager();
		
		$fences = $entityManager->getRepository(Geofence::class)->findAll();
		
		
		if (!$fences) {
			throw $this->createNotFoundException(
				'Geo fence is not set.'
			);
		}
		
		foreach ($fences as $fence) {
		
			$entityManager->remove($fence);
		}
		
		$entityManager->flush();
		
		
		return new Response('Geo fence has been removed.');

	}
	
	
    
    
}