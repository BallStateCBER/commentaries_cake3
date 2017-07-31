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
        $this->assertSession($id, 'Auth.User.id');
    }

    /**
     * Test editing account info
     *
     * @return void
     */
    public function testAccountInfoForUsers()
    {
        $id = $this->Users->getIdFromEmail('edfox@bsu.edu');
        $this->session(['Auth.User.id' => $id]);

        $this->get('/users/my-account');
        $userInfo = [
            'name' => 'Placeholder Extra',
            'email' => 'placeholder@ymail.com',
            'bio' => "I'm the placeholder!",
            'sex' => 'm'
        ];

        $this->post('/users/my-account', $userInfo);
        $this->assertResponseOk();
        $this->assertResponseContains('Your account has been updated.');
    }

    /**
     * Test adding a new user
     *
     * @return void
     */
    public function testAddingANewUser()
    {
        $id = $this->Users->getIdFromEmail('edfox@bsu.edu');
        $this->session(['Auth.User.id' => $id]);

        $this->get('/users/add');
        $newUser = [
            'name' => 'Buddy Utter',
            'email' => 'butter@bsu.edu',
            'sex' => 'm',
            'bio' => 'I am ALL BUTTER.',
            'password' => 'butterbuddy',
            'group' => 1
        ];

        $this->post('/users/add', $newUser);
        $this->assertResponseOk();
        $this->assertResponseContains('The user has been saved.');
    }

    public function testEditingUsersAccounts()
    {
        $id = $this->Users->getIdFromEmail('butter@bsu.edu');
        $this->session(['Auth.User.id' => $id]);

        $erica = $this->Users->getIdFromEmail('placeholder@ymail.com');
        $user = $this->Users->get($erica);
        $this->get("users/edit/$erica");
        if ($user->name == 'Placeholder Extra') {
            $this->assertResponseOk();
        }

        $userInfo = [
            'name' => 'Erica Dee Fox',
            'email' => 'edfox@bsu.edu',
            'bio' => "",
            'sex' => 'f'
        ];

        $this->post("/users/edit/$erica", $userInfo);
        $this->assertResponseOk();
        $this->assertResponseContains('The user has been saved.');
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
     * Test delete action for users
     *
     * @return void
     */
    public function testDeletingUsers()
    {
        $id = $this->Users->getIdFromEmail('edfox@bsu.edu');
        $this->session(['Auth.User.id' => $id]);

        // delete the new user
        $id = $this->Users->getIdFromEmail('butter@bsu.edu');

        $this->post("/users/delete/$id");
        $this->assertResponseSuccess();
    }
}
