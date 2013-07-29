<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Application\View\Helper;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Role\GenericRole;
use Zend\Permissions\Acl\Resource\GenericResource;

class Module implements ServiceProviderInterface {

  protected $params;

  public function onBootstrap(MvcEvent $e) {
    $eventManager = $e->getApplication()->getEventManager();
    $moduleRouteListener = new ModuleRouteListener();
    $moduleRouteListener->attach($eventManager);

    $this->initAcl($e);
    $eventManager->attach('route', array($this, 'checkAcl'));
  }

  public function initAcl(MvcEvent $e) {

    $acl = new Acl();

    $roles = require_once __DIR__ . '/../../config/aclroles.php';
    #echo "<pre>";
    $allResources = array();
    foreach ($roles as $role => $resources) {

      $role = new GenericRole($role);
      $acl->addRole($role);

      #$allResources = array_merge($resources, $allResources);

      //adding resources
      foreach ($resources as $resource) {
        $acl->addResource(new GenericResource($resource));
      }
      //adding restrictions

      foreach ($resources as $resource) {
        $acl->allow($role, $resource);
      }
    }

    #exit;
    //testing
    #var_dump($acl->isAllowed('admin','home'));
    //true
    //setting to view
    $e->getViewModel()->acl = $acl;
  }

  public function checkAcl(MvcEvent $e) {
    $route = $e->getRouteMatch()->getMatchedRouteName();
    //you set your role
    $userRole = 'guest';

    if ($e -> getViewModel() -> acl ->hasResource($route) && !$e -> getViewModel() -> acl -> isAllowed($userRole, $route)) {
      $response = $e->getResponse();
      //location to page or what ever
      $response->getHeaders()->addHeaderLine('Location', $e->getRequest()->getBaseUrl() . '/404');
      $response->setStatusCode(303);
    }
  }

  public function getConfig() {
    return include __DIR__ . '/config/module.config.php';
  }

  public function getAutoloaderConfig() {
//    return array(
//        'Zend\Loader\StandardAutoloader' => array(
//            'namespaces' => array(
//                __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
//            ),
//        ),
//    );
    return array(
        'Zend\Loader\ClassMapAutoloader' => array(
            __DIR__ . '/autoload_classmap.php',
        ),
        'Zend\Loader\StandardAutoloader' => array(
            'namespaces' => array(
                __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
            )
        )
    );
  }

  public function getViewHelperConfig() {
    return array(
        'factories' => array(
            // the array key here is the name you will call the view helper by in your view scripts
            'absoluteUrl' => function($sm) {
              $locator = $sm->getServiceLocator(); // $sm is the view helper manager, so we need to fetch the main service manager
              return new Helper\AbsoluteUrl($locator->get('Request'));
            },
            'params' => function (ServiceLocatorInterface $helpers) {
              $services = $helpers->getServiceLocator();
              $app = $services->get('application');
              return new Helper\Params($app->getRequest(), $app->getMvcEvent());
            }
        ),
    );
  }

  public function getServiceConfig() {
    return array();
  }

}
