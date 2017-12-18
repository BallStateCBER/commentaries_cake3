<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @property \App\Model\Table\CommentariesTable $Commentaries
 * @property \Cake\ORM\Association\BelongsToMany $CommentariesTags
 * @property \App\Model\Table\TagsTable $Tags
 * @property \DataCenter\Controller\Component\TagManagerComponent $TagManager;
 * @property \App\Model\Table\UsersTable $Users
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    public $helpers = [
        'AkkaCKEditor.CKEditor' =>
            ['distribution' => 'basic',
            'local_plugin' => [
                'emojione' => [
                    'location' => WWW_ROOT . 'js',
                    'file' => 'emojione.js'
                    ]
                ],
            'version' => '4.5.0'
            ],
        'CakeJs.Js',
        'DataCenter.Tag',
        'Html'
    ];

    public $components = [
        'DataCenter.Flash',
        'DataCenter.TagManager'
    ];

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Cookie');
        $this->loadComponent('Flash');
        $this->loadComponent('RequestHandler');
        $this->loadComponent(
            'Auth',
            [
                'loginAction' => [
                    'prefix' => false,
                    'controller' => 'Users',
                    'action' => 'login'
                ],
                'logoutRedirect' => [
                    'prefix' => false,
                    'controller' => 'Commentaries',
                    'action' => 'index'
                ],
                'authenticate' => [
                    'Form' => [
                        'fields' => [
                            'username' => 'email',
                            'password' => 'password'
                        ],
                        'passwordHasher' => [
                            'className' => 'Fallback',
                            'hashers' => [
                                'Default',
                                'Weak' => ['hashType' => 'sha1']
                            ]
                        ]
                    ]
                ],
                'authError' => 'You are not authorized to view this page',
                'authorize' => 'Controller'
            ]
        );

        $this->Auth->allow();

        $this->loadModel('Commentaries');
        $this->loadModel('CommentariesTags');
        $this->loadModel('Groups');
        $this->loadModel('Tags');
        $this->loadModel('Users');

        $this->TagManager = $this->viewBuilder()->setHelpers(['DataCenter.Tag']);

        if ($this->request->getParam('action') != 'autoComplete') {
            $recentCommentaries = $this->Commentaries->find()
                ->select(['id', 'title', 'summary', 'slug'])
                ->where(['is_published' => 1])
                ->order(['published_date' => 'DESC'])
                ->limit(4)
                ->toArray();

            if ($this->request->getParam('action') != 'autoComplete') {
                $this->set([
                    'authUser' => $this->Auth->user('id') ? $this->Users->get($this->Auth->user('id')): null,
                    'recentCommentaries' => $recentCommentaries,
                ]);
            }
        }
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->getType(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
        if ($this->request->getParam('action') != 'autoComplete') {
            $this->set([
                'topTags' => $this->TagManager->getTop('Commentaries', 10)
            ]);
        }
    }
}
