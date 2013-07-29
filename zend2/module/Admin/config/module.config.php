<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Admin\Controller\AdminController' => 'Admin\Controller\AdminController',
            'Admin\Controller\AuthController' => 'Admin\Controller\AuthController',
            'Admin\Controller\BlogController' => 'Admin\Controller\BlogController',
            'Admin\Controller\PagesController' => 'Admin\Controller\PagesController',
            'Admin\Controller\UsersController' => 'Admin\Controller\UsersController',
            'Admin\Controller\SettingController' => 'Admin\Controller\SettingController',
            'Admin\Controller\ListingController' => 'Admin\Controller\ListingController',
            'Admin\Controller\CrudController' => 'Admin\Controller\CrudController',
        ),
    ),
    'admin' => array(
        'use_admin_layout' => true,
        'admin_layout_template' => 'layout/admin',
    ),
    'navigation' => array(
        'admin' => array(),
    ),
    'router' => array(
        'routes' => array(
            'admin' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\AdminController',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
            ),
            'admin-login' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin-login.zf2',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\AuthController',
                        'action' => 'login',
                    ),
                ),
                'may_terminate' => true,
            ),
            'admin-logout' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin-logout.zf2',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\AuthController',
                        'action' => 'logout',
                    ),
                ),
                'may_terminate' => true,
            ),
            'admin-auth-index' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin-auth.zf2',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\AuthController',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
            ),
            'admin-blog' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/blogs[/filed/:search_field][/key/:search_key][/page/:page][/order/:order][/by/:order_by]',
                    'constraints' => array(
                        'action' => '(?!\bpage\b)[a-zA-Z][a-zA-Z0-9_-]*',
                        'page' => '[0-9]+',
                        'order' => '[0-9]+',
                        'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'search_field' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'search_key' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\BlogController',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
            ),
            'admin-users' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin-users[/filed/:search_field][/key/:search_key][/page/:page][/order/:order][/by/:order_by]',
                    'constraints' => array(
                        'action' => '(?!\bpage\b)[a-zA-Z][a-zA-Z0-9_-]*',
                        'page' => '[0-9]+',
                        'order' => '[0-9]+',
                        'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'search_field' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'search_key' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\UsersController',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
            ),
            'admin-user-edit' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin-user/edit[/user/:user_id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'user_id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\UsersController',
                        'action' => 'edit',
                    ),
                ),
                'may_terminate' => true,
            ),
            'admin-user-delete' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin-user/delete[/user/:user_id][/page/:page]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'user_id' => '[0-9]+',
                        'page' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\UsersController',
                        'action' => 'delete',
                    ),
                ),
                'may_terminate' => true,
            ),
            'admin-user-view' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin-user/view[/user/:user_id][/page/:page]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'user_id' => '[0-9]+',
                        'page' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\UsersController',
                        'action' => 'view',
                    ),
                ),
                'may_terminate' => true,
            ),
            'admin-pages' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin-pages[/filed/:search_field][/key/:search_key][/page/:page][/order/:order][/by/:order_by]',
                    'constraints' => array(
                        'action' => '(?!\bpage\b)[a-zA-Z][a-zA-Z0-9_-]*',
                        'page' => '[0-9]+',
                        'order' => '[0-9]+',
                        'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'search_field' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'search_key' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\PagesController',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
            ),
            'admin-page-new' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin-page-new',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\PagesController',
                        'action' => 'create',
                    ),
                ),
                'may_terminate' => true,
            ),
            'admin-page-edit' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin-page/edit[/page_id/:page_id][/page/:page]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'page_id' => '[0-9]+',
                        'page' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\PagesController',
                        'action' => 'edit',
                    ),
                ),
                'may_terminate' => true,
            ),
            'admin-page-delete' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin-page/delete[/page_id/:page_id][/page/:page]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'page_id' => '[0-9]+',
                        'page' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\PagesController',
                        'action' => 'delete',
                    ),
                ),
                'may_terminate' => true,
            ),
            'admin-page-view' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin-page/view[/page_id/:page_id][/page/:page]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'page_id' => '[0-9]+',
                        'page' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\PagesController',
                        'action' => 'view',
                    ),
                ),
                'may_terminate' => true,
            ),
            'admin-listing' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin-listing.zf2',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\ListingController',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
            ),
            'admin-settings' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin-settings[/filed/:search_field][/key/:search_key][/page/:page][/order/:order][/by/:order_by]',
                    'constraints' => array(
                        'action' => '(?!\bpage\b)(?!\border_by\b)(?!\border\b)(?!\bsearch_field\b)(?!\bsearch_key\b)[a-zA-Z][a-zA-Z0-9_-]*',
                        'page' => '[0-9]+',
                        'order' => '[0-9]+',
                        'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'search_field' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'search_key' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\SettingController',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
            ),
            'admin-setting-edit' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin-settings/edit[/key/:id][/page/:page]',
                    'constraints' => array(
                        'action' => '(?!\bpage\b)[a-zA-Z][a-zA-Z0-9_-]*',
                        'page' => '[0-9]+',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\SettingController',
                        'action' => 'edit',
                    ),
                ),
                'may_terminate' => true,
            ),
            'admin-crud-users' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin-crud-users',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\CrudController',
                        'action' => 'userslist',
                    ),
                ),
                'may_terminate' => true,
            ),
            'admin-crud-user' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin-crud-user/[user/:user_id]',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\CrudController',
                        'action' => 'userslist',
                        'user_id' => '[0-9]+',
                    ),
                ),
                'may_terminate' => true,
            ),
            'admin-user-edit' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin-user-edit/[user/:user_id]',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\UsersController',
                        'action' => 'edituser',
                        'user_id' => '[0-9]+',
                    ),
                ),
                'may_terminate' => true,
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        ),
        'template_map' => array(
            'admin-paginator-slide' => __DIR__ . '/../view/paginator-slide.phtml',
        ),
//        'display_not_found_reason' => true,
//        'display_exceptions' => true,
//        'doctype' => 'HTML5',
//        'not_found_template' => 'error/404',
//        'exception_template' => 'error/index',
//        'template_map' => array(
//            'error/404' => __DIR__ . '/../view/error/404.phtml',
//            'error/index' => __DIR__ . '/../view/error/index.phtml',
//        ),
    ),
);
