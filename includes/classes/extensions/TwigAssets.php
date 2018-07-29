<?php
/**
 * Assets for Twig (Slim Framework)
 *
 * @link      https://www.natecreative.com
 * @copyright Copyright (c) 2011-2018 Nathan LaBrake
 * @license   
 */
namespace Includes\Classes\Extensions;

class TwigAssets extends \Twig_Extension
{
    /**
     * @var \Slim\Interfaces\RouterInterface
     */
    private $router;

    /**
     * @var string|\Slim\Http\Uri
     */
    private $uri;

    /**
     * Directory for the assets folder
     * @var string
     */
    private $assetsDir;

    public function __construct($router, $uri)
    {
        $this->router = $router;
        $this->uri = $uri;
        $this->setAssetsDir( 'assets' );
    }

    public function getName()
    {
        return 'slim_assets';
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('asset', array($this, 'asset')),
        ];
    }

    public function asset( $path )
    {
        if ( is_string($this->uri) ) {
            return $this->uri . '/' . $this->assetsDir . '/' . $path;
        }
        if ( method_exists($this->uri, 'getBaseUrl') ) {
            return $this->uri->getBaseUrl() . '/' . $this->assetsDir . '/' . $path;
        }
    }

    public function setAssetsDir( $path ) {
        $this->assetsDir = $path;
    }

}