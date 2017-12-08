<?php
namespace App\Test\TestCase\Controller;

use App\Test\TestCase\ApplicationTest;
use Cake\Core\Configure;

class UsersTableTest extends ApplicationTest
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersTable
     */
    public $Users;
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
     * Test cleanEmail method
     *
     * @return void
     */
    public function testCleanEmail()
    {
        $jankyEmail = 'aLiCeGlAsSfAnZ765@bsu.edu';
        $cleanFancyEmail = $this->Users->cleanEmail($jankyEmail);
        $this->assertEquals($cleanFancyEmail, 'aliceglassfanz765@bsu.edu');
    }
    /**
     * Test generatePassword method
     *
     * @return void
     */
    public function testGeneratePassword()
    {
        $newPassword = $this->Users->generatePassword();
        $this->assertEquals(6, strlen($newPassword));
    }
    /**
     * Test getEmailFromId method
     *
     * @return void
     */
    public function testGetEmailFromId()
    {
        $user = $this->Users->find()
            ->where(['name' => 'Addy Admin'])
            ->first();
        $email = $this->Users->getEmailFromId($user->id);
        $this->assertEquals($user['email'], $email);
    }
    /**
     * Test getIdFromEmail method
     *
     * @return void
     */
    public function testGetIdFromEmail()
    {
        $user = $this->Users->find()
            ->where(['name' => 'Addy Admin'])
            ->first();
        $id = $this->Users->getIdFromEmail($user['email']);
        $this->assertEquals($user->id, $id);
    }
    /**
     * Test sendNewsmediaAlertEmail method
     *
     * @return void
     */
    public function testSendNewsmediaAlertEmail()
    {
        $user = $this->newsmedia['Auth']['User'];
        $commentary = $this->commentaries[0];
        $email = $this->Users->sendNewsmediaAlertEmail($user, $commentary);
        $email = implode($email);
        $this->assertTextContains($user['name'], $email);
        $this->assertTextContains($user['email'], $email);
    }

    /**
     * Test sendNewsmediaIntroEmail method
     *
     * @return void
     */
    public function testSendNewsmediaIntroEmail()
    {
        $user = $this->newsmedia['Auth']['User'];
        $email = $this->Users->sendNewsmediaIntroEmail($user);
        $email = implode($email);
        $this->assertTextContains($user['name'], $email);
        $this->assertTextContains($user['email'], $email);
    }
    /**
     * Test getResetPasswordHash method
     *
     * @return void
     */
    public function testGetResetPasswordHash()
    {
        $user = $this->Users->find()
            ->where(['name' => 'Addy Admin'])
            ->first();
        $hash = $this->Users->getResetPasswordHash($user->id, $user['email']);
        $this->assertEquals(md5($user->id . $user['email'] . Configure::read('security_salt') . date('my')), $hash);
    }
    /**
     * Test sendPasswordResetEmail
     *
     * @return void
     */
    public function testSendPasswordResetEmail()
    {
        $user = $this->Users->find()
            ->where(['name' => 'Addy Admin'])
            ->first();
        $email = $this->Users->sendPasswordResetEmail($user->id, $user['email']);
        $email = implode($email);
        $resetPasswordHash = $this->Users->getResetPasswordHash($user->id, $user['email']);
        $this->assertTextContains($resetPasswordHash, $email);
    }
}
