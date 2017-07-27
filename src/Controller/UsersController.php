<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function forgotPassword()
    {
        if ($this->request->is('post')) {
            $adminEmail = Configure::read('admin_email');
            $email = $this->Users->cleanEmail($this->request->data['email']);
            if (empty($email)) {
                $this->Flash->error('Please enter the email address associated with your account to have your password reset. Email <a href="mailto:'.$adminEmail.'">'.$adminEmail.'</a> if you need any assistance.');
            } else {
                $userId = $this->Users->getUserIdWithEmail($email);
                if ($userId) {
                    if ($this->Users->sendPasswordResetEmail($userId, $email)) {
                        $this->Flash->success('You should be receiving an email shortly with a link to reset your password.');
                    } else {
                        $this->Flash->error('There was an error sending your password-resetting email out. Please try again, and if it continues to not work, email <a href="mailto:'.$adminEmail.'">'.$adminEmail.'</a> if you need any assistance.');
                    }
                } else {
                    $this->Flash->error('We couldn\'t find an account registered with the email address <strong>'.$email.'</strong>. Make sure you spelled it correctly. Email <a href="mailto:'.$adminEmail.'">'.$adminEmail.'</a> if you need any assistance.');
                }
            }
        }
        $this->set([
            'titleForLayout' => 'Forgot Password'
        ]);
    }

    public function login()
    {
        $this->set('titleForLayout', 'Log In');
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);

                // do they have an old sha1 password?
                if ($this->Auth->authenticationProvider()->needsPasswordRehash()) {
                    $user = $this->Users->get($this->Auth->user('id'));
                    $Users->password = $this->request->getData('password');
                    $this->Users->save($user);
                }

                // Remember login information
                if ($this->request->data('remember_me')) {
                    $this->Cookie->configKey('User', [
                        'expires' => '+1 year',
                        'httpOnly' => true
                    ]);
                    $this->Cookie->write('User', [
                        'email' => $this->request->data('email'),
                        'password' => $this->request->data('password')
                    ]);
                }
                return $this->redirect($this->Auth->redirectUrl());
            }
            if (!$user) {
                $this->Flash->error(__('We could not log you in. Please check your email & password.'));
            }
        }
    }

    public function resetPassword($userId = null, $resetPasswordHash = null)
    {
        $user = $this->Users->get($userId);
        $email = $user->email;

        $expectedHash = $this->Users->getResetPasswordHash($userId, $email);

        if ($resetPasswordHash != $expectedHash || $resetPasswordHash == null || $userId == null) {
            $this->Flash->error('Invalid password-resetting code. Make sure that you entered the correct address and that the link emailed to you hasn\'t expired.');
            $this->redirect('/');
        }

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, [
                'password' => $this->request->data['new_password'],
                'confirm_password' => $this->request->data['confirm_password']
            ]);

            if ($this->Users->save($user)) {
                $data = $user->toArray();
                $this->Auth->setUser($data);
                $this->Flash->success('Password changed. You are now logged in.');
                return $this->redirect('/');
            }

            $this->Flash->error('There was an error changing your password. Please check to make sure they\'ve been entered correctly.');
            return $this->redirect('/');
        }

        $this->set([
            'titleForLayout' => 'Reset Password',
            'userId' => $userId,
            'email' => $email,
            'resetPasswordHash' => $resetPasswordHash
        ]);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Groups', 'LastAlertArticles']
        ];
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Groups', 'LastAlertArticles', 'Commentaries']
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $groups = $this->Users->Groups->find('list', ['limit' => 200]);
        $lastAlertArticles = $this->Users->LastAlertArticles->find('list', ['limit' => 200]);
        $this->set(compact('user', 'groups', 'lastAlertArticles'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $groups = $this->Users->Groups->find('list', ['limit' => 200]);
        $lastAlertArticles = $this->Users->LastAlertArticles->find('list', ['limit' => 200]);
        $this->set(compact('user', 'groups', 'lastAlertArticles'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
