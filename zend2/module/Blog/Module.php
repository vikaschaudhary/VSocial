<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Blog;

use Zend\ModuleManager\Feature\ServiceProviderInterface,
    Zend\Mvc\ModuleRouteListener,
    Zend\Mvc\MvcEvent,
    Zend\Db\ResultSet\ResultSet,
    Zend\Db\TableGateway\TableGateway

#Zend\ServiceManager\ServiceLocatorInterface
;
use Blog\Model,
    Blog\Model\Table;

class Module implements ServiceProviderInterface {

  public function onBootstrap(MvcEvent $e) {
    $eventManager = $e->getApplication()->getEventManager();
    $moduleRouteListener = new ModuleRouteListener();
    $moduleRouteListener->attach($eventManager);
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
            'blog' => function($sm) {
              $locator = $sm->getServiceLocator();
              return new View\Helper\Blog($locator);
            },
        ),
    );
  }

  public function getServiceConfig() {
    return array(
        'factories' => array(
            'Blog\Model\BlogTable' => function($sm) {
              return new Table\BlogTable($sm->get('BlogTableGateway'));
            },
            'BlogTableGateway' => function ($sm) {
              $resultSetArrayObject = new ResultSet();
              $resultSetArrayObject->setArrayObjectPrototype(new Model\Blogs());
              return new TableGateway('blogs', $sm->get('Zend\Db\Adapter\Adapter'), null, $resultSetArrayObject);
            },
            'Blog\Model\CategoryTable' => function($sm) {
              return new Table\CategoryTable($sm->get('BlogCateogryTableGateway'));
            },
            'BlogCateogryTableGateway' => function ($sm) {
              $resultSetArrayObject = new ResultSet();
              $resultSetArrayObject->setArrayObjectPrototype(new Model\Category());
              return new TableGateway('blogs_categories', $sm->get('Zend\Db\Adapter\Adapter'), null, $resultSetArrayObject);
            },
            'Blog\Model\CommentTable' => function($sm) {
              return new Table\CommentTable($sm->get('BlogCommentTableGateway'));
            },
            'BlogCommentTableGateway' => function ($sm) {
              $resultSetArrayObject = new ResultSet();
              $resultSetArrayObject->setArrayObjectPrototype(new Model\Comment());
              return new TableGateway('blogs_comments', $sm->get('Zend\Db\Adapter\Adapter'), null, $resultSetArrayObject);
            },
        ),
    );
  }

}
