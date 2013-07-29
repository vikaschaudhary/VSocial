<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace User;

use Zend\ModuleManager\Feature\ServiceProviderInterface,
    Zend\Mvc\ModuleRouteListener,
    Zend\Mvc\MvcEvent,
    Zend\Session\Container,
    Zend\Session\SessionManager,
    Zend\Db\ResultSet\ResultSet,
    Zend\Db\TableGateway\TableGateway

#Zend\ServiceManager\ServiceLocatorInterface
;
use User\Model,
    User\Model\Table;

class Module implements ServiceProviderInterface {

  public function onBootstrap(MvcEvent $e) {
    $eventManager = $e->getApplication()->getEventManager();
    $moduleRouteListener = new ModuleRouteListener();
    $moduleRouteListener->attach($eventManager);
   
    $eventManager->attach(MvcEvent::EVENT_DISPATCH, array($this, 'bootstrapSession'));
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
            'users' => function($sm) {
              $locator = $sm->getServiceLocator();
              return new View\Helper\User($locator);
            },
        ),
    );
  }

  public function getServiceConfig() {
    return array(
        'factories' => array(
            'User\Model\UserTable' => function($sm) {
              return new Table\UserTable($sm->get('UserTableGateway'));
            },
            'UserTableGateway' => function ($sm) {
              $resultSetArrayObject = new ResultSet();
              $resultSetArrayObject->setArrayObjectPrototype(new Model\User());
              return new TableGateway('users', $sm->get('Zend\Db\Adapter\Adapter'), null, $resultSetArrayObject);
            },
        ),
        'Zend\Session\SessionManager' => function ($sm) {
          $config = $sm->get('config');
          if (isset($config['session'])) {
            $session = $config['session'];

            $sessionConfig = null;
            if (isset($session['config'])) {
              $class = isset($session['config']['class']) ? $session['config']['class'] : 'Zend\Session\Config\SessionConfig';
              $options = isset($session['config']['options']) ? $session['config']['options'] : array();
              $sessionConfig = new $class();
              $sessionConfig->setOptions($options);
            }

            $sessionStorage = null;
            if (isset($session['storage'])) {
              $class = $session['storage'];
              $sessionStorage = new $class();
            }

            $sessionSaveHandler = null;
            if (isset($session['save_handler'])) {
              $sessionSaveHandler = $sm->get($session['save_handler']);
            }

            $sessionManager = new SessionManager($sessionConfig, $sessionStorage, $sessionSaveHandler);

            if (isset($session['validator'])) {
              $chain = $sessionManager->getValidatorChain();
              foreach ($session['validator'] as $validator) {
                $validator = new $validator();
                $chain->attach('session.validate', array($validator, 'isValid'));
              }
            }
          } else {
            $sessionManager = new SessionManager();
          }
          Container::setDefaultManager($sessionManager);
          return $sessionManager;
        },
    );
  }

  public function bootstrapSession($e) {
    $session = $e->getApplication()
            ->getServiceManager()
            ->get('Zend\Session\SessionManager');
    $session->start();

    $container = new Container('initialized');
    if (!isset($container->init)) {
      $session->regenerateId(true);
      $container->init = 1;
    }
  }

}
