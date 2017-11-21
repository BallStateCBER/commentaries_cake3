<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         3.3.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Test\TestCase;

use App\Application;
use App\Test\Fixture\UsersFixture;
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Cake\Http\MiddlewareQueue;
use Cake\ORM\TableRegistry;
use Cake\Routing\Middleware\AssetMiddleware;
use Cake\Routing\Middleware\RoutingMiddleware;
use Cake\TestSuite\IntegrationTestCase;

/**
 * ApplicationTest class
 */
class ApplicationTest extends IntegrationTestCase
{
    public $fixtures = [
        'app.commentaries',
        'app.commentaries_tags',
        'app.groups',
        'app.tags',
        'app.users'
    ];

    public $commentaries;
    public $commentariesTags;
    public $groups;
    public $tags;

    public $admin;
    public $commentary;
    public $newsmedia;

    public $objects = [
        'Commentaries',
        'CommentariesTags',
        'Groups',
        'Tags',
        'Users'
    ];

    public function setUp()
    {
        parent::setUp();
        foreach ($this->objects as $object) {
            $this->$object = TableRegistry::get($object);
        }

        foreach ($this->objects as $class) {
            $fixture = "App\Test\Fixture\\" . $class . "Fixture";
            $object = new $fixture();
            $class = strtolower($class);
            $this->$class = [];
            foreach ($object->records as $fix) {
                $this->$class[] = $fix;
            }
        }

        // set up the users fixtures
        $usersFixture = new UsersFixture();

        $this->admin = [
            'Auth' => [
                'User' => $usersFixture->records[0]
            ]
        ];

        $this->commentary = [
            'Auth' => [
                'User' => $usersFixture->records[1]
            ]
        ];

        $this->newsmedia = [
            'Auth' => [
                'User' => $usersFixture->records[2]
            ]
        ];
    }

    /**
     * testMiddleware
     *
     * @return void
     */
    public function testMiddleware()
    {
        $app = new Application(dirname(dirname(__DIR__)) . '/config');
        $middleware = new MiddlewareQueue();

        $middleware = $app->middleware($middleware);

        $this->assertInstanceOf(ErrorHandlerMiddleware::class, $middleware->get(0));
        $this->assertInstanceOf(AssetMiddleware::class, $middleware->get(1));
        $this->assertInstanceOf(RoutingMiddleware::class, $middleware->get(2));
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        foreach ($this->objects as $object) {
            unset($this->$object);
        }

        parent::tearDown();
    }
}
