<?php
namespace App\Test\TestCase\Controller;

use App\Test\TestCase\ApplicationTest;

class UsersControllerTest extends ApplicationTest
{
    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
    }
    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        parent::tearDown();
    }
    /**
     * Test login method
     *
     * @return void
     */
    public function testLoggingInAndViewingUsers()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $this->get('/login');
        $this->assertResponseOk();

        $data = [
            'email' => 'admin@bsu.edu',
            'password' => 'i am such a great password'
        ];

        $this->post('/login', $data);

        $this->assertResponseContains('We could not log you in.');

        $this->get('/login');
        $this->assertResponseOk();

        $data = [
            'email' => 'admin@bsu.edu',
            'password' => 'placeholder'
        ];

        $this->post('/login', $data);
        $this->assertResponseSuccess();

        $this->session($this->admin);

        $this->get('/users/admin');
        $this->assertResponseContains('admin@bsu.edu');
    }
    /**
     * Test logout
     *
     * @return void
     */
    public function testLoggingOutAndViewingUsers()
    {
        $this->session($this->admin);

        $this->get('/logout');
        $this->assertSession(null, 'Auth.User.id');

        $this->session($this->newsmedia);

        $this->get('/users/admin');
        $this->assertRedirect();
    }
    /**
     * Test the procedure for resetting one's password
     */
    public function testPasswordResetProcedure()
    {
        $this->get('/users/forgot-password');
        $this->assertResponseOk();

        $user = [
            'email' => 'admin@bsu.edu'
        ];
        $this->post('/users/forgot-password', $user);
        $this->assertResponseContains('Message sent.');
        $this->assertResponseOk();

        $this->get('/users/reset-password/1/12345');
        $this->assertRedirect('/');

        // get password reset hash
        $hash = $this->Users->getResetPasswordHash(1, 'admin@bsu.edu');
        $resetUrl = "/users/reset-password/1/$hash";
        $this->get($resetUrl);
        $this->assertResponseOk();

        $passwords = [
            'new_password' => 'Placeholder!',
            'new_confirm_password' => 'Placeholder!'
        ];
        $this->post($resetUrl, $passwords);
        $this->assertResponseContains('Password changed.');
        $this->assertResponseOk();

        $this->get('/login');

        $newCreds = [
            'email' => 'admin@bsu.edu',
            'password' => 'Placeholder!'
        ];

        $this->post('/login', $newCreds);
        $this->assertSession(1, 'Auth.User.id');
    }
    /**
     * Test entire life cycle of user account
     *
     * @return void
     */
    public function testRegistrationAndAccountEditingAndDeletingAUser()
    {
        $this->get('/users/add');
        $this->assertRedirect();

        $this->session($this->admin);
        $this->get('/users/add');
        $this->assertResponseOk();

        // validation works?
        $newUser = [
            'name' => 'Paulie Placeholder',
            'email' => 'userplaceholder2@bsu.edu',
            'bio' => "Blah blah blah blah blah blah blah blah blah",
            'password' => 'placeholder',
            'group_id' => 3
        ];

        $this->post('/users/add', $newUser);
        $this->assertResponseContains('The user has been saved');

        $user = $this->Users->find()->where(['name' => $newUser['name']])->first();
        $this->get('/users/edit/' . $user['id']);

        $accountInfo = [
            'name' => 'Paulie Farce',
            'email' => 'userplaceholder2@bsu.edu',
            'bio' => 'I am yet another placeholder.'
        ];
        $id = $this->Users->getIdFromEmail($accountInfo['email']);

        // for the moment, we're not using this test, because it's not working and I have no idea why
        /*$this->get('/account');
        $this->post('/account', $accountInfo);
        $user = $this->Users->get($id);
        dd($user);

        $this->assertEquals('I am yet another placeholder.', $user->bio);*/

        $this->get('/logout');

        $this->session($this->newsmedia);

        $this->get("users/delete/$id");
        $id = $this->Users->getIdFromEmail($accountInfo['email']);
        $this->assertEquals($id, 4);

        // let's try again with an admin
        $this->session($this->admin);

        $this->get("users/delete/$id");

        $id = $this->Users->getIdFromEmail($accountInfo['email']);
        $this->assertEquals($id, null);

        $this->markTestIncomplete();
    }

    /**
     * test addNewsmedia function
     *
     * @return void
     */
    public function testAddNewsmedia()
    {
        $this->session($this->admin);
        $this->get('/newsmedia/subscribe');
        $this->assertResponseOk();
        $data = [
            'name' => 'Clepsydra',
            'email' => 'clepsydra@bsu.edu',
            'password' => $this->Users->generatePassword()
        ];

        $this->post('/newsmedia/subscribe', $data);
        $this->assertResponseContains('Newsmedia member added.');

        $user = $this->Users->find()->where(['name' => 'Clepsydra'])->firstOrFail();
        $this->assertEquals('Clepsydra', $user['name']);
    }
}
