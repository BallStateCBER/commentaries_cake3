<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    /**
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);
    Router::connect('/users/admin', ['controller' => 'Users', 'action' => 'adminIndex']);

    Router::defaultRouteClass(DashedRoute::class);

    Router::connect('/', ['controller' => 'commentaries', 'action' => 'index']);
    Router::connect('/login', ['controller' => 'users', 'action' => 'login']);
    Router::connect('/logout', ['controller' => 'users', 'action' => 'logout']);
    Router::connect('/tags', ['controller' => 'commentaries', 'action' => 'tags']);
    Router::connect(
        '/tag/:id',
        ['controller' => 'commentaries', 'action' => 'tagged'],
        ['id' => '[0-9]+', 'pass' => ['id']]
    );
    Router::connect(
        "/:id/:slug/*",
        ['controller' => 'commentaries', 'action' => 'view'],
        ['id' => '[0-9]+', 'pass' => ['id']],
        ['slug' => '[-_a-z0-9]+', 'pass' => ['slug']]
    );
    Router::connect(
        "/commentary/:id/*",
        ['controller' => 'commentaries', 'action' => 'view'],
        ['id' => '[0-9]+', 'pass' => ['id']]
    );

    // So /index.rss leads to the RSS feed
    Router::connect('/index.rss', ['controller' => 'commentaries', 'action' => 'rss']);
    Router::connect('/drafts', ['controller' => 'commentaries', 'action' => 'drafts']);

    Router::connect('/newsmedia', ['controller' => 'commentaries', 'action' => 'newsmedia_index']);
    Router::connect('/newsmedia/subscribe', ['controller' => 'users', 'action' => 'add_newsmedia']);
    Router::connect('/newsmedia/my_account', ['controller' => 'users', 'action' => 'my_account', 'newsmedia' => true]);
    Router::connect('/forgot_password', ['controller' => 'users', 'action' => 'forgot_password']);
    Router::connect('/reset_password/*', ['controller' => 'users', 'action' => 'reset_password']);

    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
     *    `$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);`
     *    `$routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);`
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks(DashedRoute::class);
});
