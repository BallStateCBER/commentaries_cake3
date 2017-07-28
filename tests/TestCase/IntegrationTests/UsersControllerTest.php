<?php
namespace App\Test\TestCase\Controller;

use App\Controller\UsersController;
use Cake\Core\Configure;
use Cake\Mailer\Email;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\UsersController Test Case
 */
class UsersControllerTest extends IntegrationTestCase
{
    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Users') ? [] : ['className' => 'App\Model\Table\UsersTable'];
        $this->Users = TableRegistry::get('Users', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Users);

        parent::tearDown();
    }

    /**
     * Test sending password reset email
     *
     * @return void
     */
    public function testSendingPasswordReset()
    {
        $this->get("/users/forgot-password");
        $this->assertResponseOk();

        $data = [
            'email' => 'edfox@bsu.edu'
        ];

        $this->post('/users/forgot-password', $data);
        $this->assertResponseContains('Message sent.');
        $this->assertResponseOk();
    }

    /**
     * Test actually resetting the password
     *
     * @return void
     */
    public function testResettingThePassword()
    {
        $id = $this->Users->getIdFromEmail('edfox@bsu.edu');
        $this->session(['Auth.User.id' => $id]);

        // what if someone's trying to fabricate a password-resetting code?
        $this->get("users/reset-password/$id/abcdefg");
        $this->assertRedirect('/');

        // get password reset hash
        $hash = $this->Users->getResetPasswordHash($id, 'edfox@bsu.edu');

        // now, this is the REAL URL for password resetting
        $resetUrl = "users/reset-password/$id/$hash";
        $this->get($resetUrl);
        $this->assertResponseOk();

        $passwords = [
            'new_password' => 'Placeholder!',
            'new_confirm_password' => 'Placeholder!'
        ];

        $this->post($resetUrl, $passwords);
        $this->assertResponseOk();
        $this->assertSession($id, 'Auth.User.id');
        $this->assertResponseContains('Password changed.');
    }

    /**
     * Test login method
     *
     * @return void
     */
    public function testLoggingIn()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $this->get('/login');
        $this->assertResponseOk();

        $data = [
            'email' => 'hotdogplaceholderpants@fightyou.net',
            'password' => 'i am such a great password'
        ];

        $this->post('/login', $data);

        $this->assertResponseContains('We could not log you in.');

        $this->get('/login');
        $this->assertResponseOk();

        $data = [
            'email' => 'edfox@bsu.edu',
            'password' => 'Placeholder!'
        ];

        $this->post('/login', $data);

        $id = $this->Users->getIdFromEmail('edfox@bsu.edu');
        #$this->assertSession($id, 'Auth.User.id');
    }

    /**
     * Test logout
     *
     * @return void
     */
    public function testLoggingOut()
    {
        $id = $this->Users->getIdFromEmail('edfox@bsu.edu');
        $this->session(['Auth.User.id' => $id]);

        $this->get('/logout');
        $this->assertSession(null, 'Auth.User.id');
    }

    /**
     * Test editing account info
     *
     * @return void
     */
    /*public function testAccountInfoForUsers()
    {
        $this->session(['Auth.User.id' => $id]);

        $this->get('/account');
        $userInfo = [
            'name' => 'Placeholder Extra',
            'email' => 'placeholder@ymail.com',
            'bio' => "I'm the placeholder!"
        ];
        $user = $this->Users->get($id);
        $user = $this->Users->patchEntity($user, $userInfo);
        if ($this->Users->save($user)) {
            $this->assertResponseOk();
        }
    }

    /**
     * Test editing account info
     * plus file uploading
     *
     * @return void
     */
    /*public function testPhotoUploadingForUsers()
    {
        $this->session(['Auth.User.id' => $id]);

        $salt = Configure::read('profile_salt');
        $newFilename = md5('placeholder.jpg'.$salt);

        $this->get('/account');
        $userInfo = [
            'name' => 'Placeholder',
            'email' => 'placeholder@gmail.com',
            'bio' => "I'm the BEST placeholder!",
            'photo' => [
                'name' => 'placeholder.jpg',
                'type' => 'image/jpeg',
                'tmp_name' => WWW_ROOT . DS . 'img' . DS . 'users' . $newFilename,
                'error' => 4,
                'size' => 845941,
            ]
        ];
        $user = $this->Users->get($id);
        $user = $this->Users->patchEntity($user, $userInfo);
        if ($this->Users->save($user)) {
            $this->assertResponseOk();
            if ($user->photo == $newFilename) {
                return $this->assertResponseOk();
            }

            // file upload unit testing not done yet!
            $this->markTestIncomplete();
        }
    }


    /**
     * Test delete action for users
     *
     * @return void
     */
    /*public function testDeletingUsers()
    {
        $this->session(['Auth.User.id' => 1]);

        // delete the new user
        $id = $this->Users->getIdFromEmail('mal@blum.com');

        $this->get("users/delete/$id");
        $this->assertResponseSuccess();
    } */
}