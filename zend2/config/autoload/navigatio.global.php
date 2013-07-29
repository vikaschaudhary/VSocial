<?php

/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */
return array(
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Home',
                'route' => 'home',
            ),
            array(
                'label' => 'Blog',
                'route' => 'blog',
//                'pages' => array(
//                    array(
//                        'label' => 'Child #1',
//                        'route' => 'page-1-child'
//                    )
//                )
            ),
            array(
                'label' => 'Sign Up',
                'route' => 'signup',
            ),
            array(
                'label' => 'Contact',
                'route' => 'contact',
            )
        )
    )
);

