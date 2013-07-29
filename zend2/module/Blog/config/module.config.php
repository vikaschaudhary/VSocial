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
            'Blog\Controller\Index' => 'Blog\Controller\IndexController',
            'Blog\Controller\Crud' => 'Blog\Controller\CrudController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'blog' => array(
                'type' => 'segment',
                'options' => array(
                    #'route' => '/blogs[/:action][-:page]',
                    'route' => '/blogs[/:action][/page/:page][/category/:category_title][/id/:category][/tag/:tag][/tid/:tag_id]',
                    'constraints' => array(
                        #'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '(?!\bpage\b)(?!\btag_id\b)(?!\btag\b)(?!\bcategory_title\b)(?!\bcategory\b)[a-zA-Z][a-zA-Z0-9_-]*',
                        'page' => '[0-9]+',
                        'tag_id' => '[0-9]+',
                        'tag' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'category_title' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'category' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Blog\Controller\Index',
                        'action' => 'index',
                    ),
                ),
            ),
            'blog-detail' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/blog[/:id][/:title]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                        'title' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Blog\Controller\Index',
                        'action' => 'detail',
                    ),
                ),
            ),
            'blog-search' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/blogs[/:action][/page/:page][/ket/:keyword]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'keyword' => '[a-zA-Z][0-9]+',
                        'page' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Blog\Controller\Index',
                        'action' => 'index',
                    ),
                ),
            ),
            'blog-crud' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/blog/crud[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Blog\Controller\Crud',
                        'action' => 'index',
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