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
class UsersTest extends IntegrationTestCase
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
     * test email cleaner method
     *
     * @return void
     */
    public function testCleanEmailMethod()
    {
        $email = '     PLACEHOLDEREMAIL@GMAIL.COM   ';
        $email = $this->Users->cleanEmail($email);
        $expected = 'placeholderemail@gmail.com';

        $this->assertEquals($expected, $email);
    }

    /**
     * Test getEmailFromId method
     *
     * @return void
     */
    public function testGetEmailFromId()
    {
        $user = $this->Users->find()
            ->where(['name' => 'Erica Dee Fox'])
            ->first();

        $email = $this->Users->getEmailFromId($user->id);

        $this->assertEquals($user->email, $email);
    }

    /**
     * Test getIdFromEmail method
     *
     * @return void
     */
    public function testGetIdFromEmail()
    {
        $user = $this->Users->find()
            ->where(['name' => 'Erica Dee Fox'])
            ->first();

        $id = $this->Users->getIdFromEmail($user->email);

        $this->assertEquals($user->id, $id);
    }

    /**
     * Test getResetPasswordHash method
     *
     * @return void
     */
    public function testGetResetPasswordHash()
    {
        $user = $this->Users->find()
            ->where(['name' => 'Erica Dee Fox'])
            ->first();

        $hash = $this->Users->getResetPasswordHash($user->id, $user->email);

        $this->assertEquals(md5($user->id.$user->email.Configure::read('security_salt').date('my')), $hash);
    }

    /**
     * Test sendPasswordResetEmail
     *
     * @return void
     */
    public function testSendPasswordResetEmail()
    {
        $user = $this->Users->find()
            ->where(['name' => 'Erica Dee Fox'])
            ->first();

        $email = $this->Users->sendPasswordResetEmail($user->id, $user->email);
        $email = implode($email);

        $resetPasswordHash = $this->Users->getResetPasswordHash($user->id, $user->email);

        $this->assertTextContains($resetPasswordHash, $email);
    }
}
