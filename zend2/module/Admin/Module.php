<?php

namespace Admin;

use Zend\ModuleManager\Feature,
    Zend\EventManager\EventInterface,
    Zend\Mvc\MvcEvent,
    Zend\Mvc\Router\RouteMatch,
    Zend\Session\Container,
    Zend\ServiceManager\ServiceLocatorInterface,
    Zend\Session\SessionManager;
use Zend\Db\ResultSet\ResultSet,
    Zend\Db\TableGateway\TableGateway;
use Admin\View\Helper,
    Admin\Model;

/**
 * Module class for Admin
 *
 * @package Admin
 */
class Module implements Feature\AutoloaderProviderInterface, Feature\ConfigProviderInterface, Feature\ServiceProviderInterface, Feature\BootstrapListenerInterface {

  /**
   * @{inheritdoc}
   */
  public function getAutoloaderConfig() {
//    return array(
//        Loader\AutoloaderFactory::STANDARD_AUTOLOADER => array(
//            Loader\StandardAutoloader::LOAD_NS => array(
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

  /**
   * @{inheritdoc}
   */
  public function getConfig() {
    return include __DIR__ . '/config/module.config.php';
  }

  /**
   * @{inheritdoc}
   */
  public function getServiceConfig() {
    return array(
        'factories' => array(
            'Admin\Model\AdminTable' => function($sm) {
              return new Model\Table\AdminTable($sm->get('AdminTableGateway'));
            },
            'AdminTableGateway' => function ($sm) {
              $resultSetPrototype = new ResultSet();
              $resultSetPrototype->setArrayObjectPrototype(new Model\Admin());
              return new TableGateway('users', $sm->get('Zend\Db\Adapter\Adapter'), null, $resultSetPrototype);
            },
            'Admin\Model\BlogTable' => function($sm) {
              $table = new Model\Table\BlogTable($sm->get('AdminBlogTableGateway'));
              return $table;
            },
            'AdminBlogTableGateway' => function ($sm) {
              $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
              $resultSetPrototype = new ResultSet();
              $resultSetPrototype->setArrayObjectPrototype(new Model\Blog());
              return new TableGateway('blogs', $dbAdapter, null, $resultSetPrototype);
            },
            'Admin\Model\PageTable' => function($sm) {
              $table = new Model\Table\PageTable($sm->get('AdminPageTableGateway'));
              return $table;
            },
            'AdminPageTableGateway' => function ($sm) {
              $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
              $resultSetPrototype = new ResultSet();
              $resultSetPrototype->setArrayObjectPrototype(new Model\Pages());
              return new TableGateway('core_pages', $dbAdapter, null, $resultSetPrototype);
            },
            'Admin\Model\SettingTable' => function($sm) {
              $table = new Model\Table\SettingTable($sm->get('AdminSettingTableGateway'));
              return $table;
            },
            'AdminSettingTableGateway' => function ($sm) {
              $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
              $resultSetPrototype = new ResultSet();
              $resultSetPrototype->setArrayObjectPrototype(new Model\Setting());
              return new TableGateway('settings', $dbAdapter, null, $resultSetPrototype);
            },
            'admin_navigation' => 'Admin\Navigation\Service\AdminNavigationFactory',
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
        ),
    );
  }

  /**
   * @{inheritdoc}
   */
  public function onBootstrap(EventInterface $e) {
    $app = $e->getParam('application');
    $em = $app->getEventManager();

    $em->attach(MvcEvent::EVENT_DISPATCH, array($this, 'selectLayoutBasedOnRoute'));
  }

  /**
   * Select the admin layout based on route name
   *
   * @param  MvcEvent $e
   * @return void
   */
  public function selectLayoutBasedOnRoute(MvcEvent $e) {
    $app = $e->getParam('application');
    $sm = $app->getServiceManager();
    $config = $sm->get('config');



    if (false === $config['admin']['use_admin_layout']) {
      return;
    }
    $this->bootstrapSession($e);
    $match = $e->getRouteMatch();
    $controller = $e->getTarget();
    if (!$match instanceof RouteMatch || 0 !== strpos($match->getMatchedRouteName(), 'admin') || $controller->getEvent()->getResult()->terminate()
    ) {
      return;
    }

    $layout = $config['admin']['admin_layout_template'];
    $controller->layout($layout);
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

  public function getViewHelperConfig() {
    return array(
        'factories' => array(
            // the array key here is the name you will call the view helper by in your view scripts
            'adminSession' => function() {
              return new Helper\AdminSession();
            },
            'params' => function (ServiceLocatorInterface $helpers) {
              $services = $helpers->getServiceLocator();
              $app = $services->get('application');
              return new \Application\View\Helper\Params($app->getRequest(), $app->getMvcEvent());
            }
        ),
    );
  }

}
