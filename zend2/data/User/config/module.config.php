<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
return array(
    'controllers' => array(
        'invokables' => array(
            'User\Controller\Index' => 'User\Controller\IndexController',
            'User\Controller\Auth' => 'User\Controller\AuthController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'user_home' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/profile[/:username][/:user_id]',
                    'constraints' => array(
                        'action' => '(?!\busername\b)[a-zA-Z][a-zA-Z0-9_-]*',
                        'username' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'user_id' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'User\Controller\Index',
                        'action' => 'index',
                    ),
                ),
            ),
            'user_login' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/login',
                    'defaults' => array(
                        'controller' => 'User\Controller\Auth',
                        'action' => 'login',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'blog' => __DIR__ . '/../view',
        ),
        'template_map' => array(
            'paginator-slide' => __DIR__ . '/../view/paginator-slide.phtml',
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
);