<?php
namespace Includes\Classes\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Interop\Container\ContainerInterface as ContainerInterface;

class HomeController
{
   protected $container;

   // constructor receives container instance
   public function __construct(ContainerInterface $container) {
       $this->container = $container;
   }

   public function home($request, $response, $args) {

        return $this->container['view']->render($response, 'home.html');

   }

   public function contact($request, $response, $args) {

        return $this->container['view']->render( $response, 'contact.html' );

   }
}