<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Routing\Router;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');

        // deny methods for non-users
        $this->Auth->deny(['add', 'adminIndex', 'delete', 'logout', 'myAccount', 'index']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if ($this->Auth->user('group_id') != 1) {
            return $this->Flash->error(__('You are not an admin.'));
        }
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                return $this->Flash->success(__('The user has been saved.'));
            }
            return $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $groups = $this->Users->Groups->find('list', ['limit' => 200]);
        $this->set(compact('user', 'groups'));
        $this->set('_serialize', ['user']);
    }

    public function adminIndex()
    {
        if ($this->Auth->user('group_id') != 1) {
            return $this->Flash->error(__('You are not an admin.'));
        }
        $users = $this->Users->find('all')
            ->contain('Groups');
        $this->set([
            'titleForLayout' => 'Manage Users',
            'users' => $this->paginate($users)
        ]);
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
        if ($this->Auth->user('group_id') != 1) {
            return $this->Flash->error(__('You are not an admin.'));
        }
        $this->viewBuilder()->autoLayout(false);
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
            return $this->redirect([
                'controller' => 'users',
                'action' => 'adminIndex'
            ]);
        }
        $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        return $this->redirect([
            'controller' => 'users',
            'action' => 'adminIndex'
        ]);
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
        if ($this->Auth->user('group_id') != 1) {
            return $this->Flash->error(__('You are not an admin.'));
        }

        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $groups = $this->Users->Groups->find('list', ['limit' => 200]);
        $this->set(compact('user', 'groups'));
        $this->set('_serialize', ['user']);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                return $this->Flash->success(__('The user has been saved.'));
            }
            return $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
    }

    public function forgotPassword()
    {
        if ($this->request->is('post')) {
            $adminEmail = Configure::read('admin_email');
            $email = $this->Users->cleanEmail($this->request->data['email']);
            if (empty($email)) {
                $this->Flash->error('Please enter the email address associated with your account to have your password reset. Email <a href="mailto:'.$adminEmail.'">'.$adminEmail.'</a> if you need any assistance.');
            } else {
                $userId = $this->Users->getIdFromEmail($email);
                if ($userId) {
                    if ($this->Users->sendPasswordResetEmail($userId, $email)) {
                        $this->Flash->success('Message sent. You should be receiving an email shortly with a link to reset your password.');
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
                    $user->password = $this->request->getData('password');
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

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    public function myAccount()
    {
        $this->set('titleForLayout', 'My Profile');

        $id = $this->Auth->user('id');
        $email = $this->Auth->user('email');
        $user = $this->Users->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $data = $user->toArray();
                $this->Auth->setUser($data);
                return $this->Flash->success(__('Your account has been updated.'));
            }
            return $this->Flash->error(__('Sorry, we could not update your information. Please try again.'));
        }
        $this->set(compact('user'));
    }

    public function newsmediaMyAccount()
    {
        $id = $this->Auth->user('id');
        $user = $this->Users->get($id);

        $this->set([
            'titleForLayout' => 'My Account'
        ]);
        $this->set(compact('user'));

        if ($user->group_id != 3) {
            return $this->Flash->error(__('You are not a member of the press.'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $data = $this->request->getData();

            $user->email = $this->Users->cleanEmail($data['email']);
            $emailLookup = $this->Users->getIdFromEmail($data['email']);
            if ($emailLookup && $emailLookup !== $id) {
                return $this->Flash->error(__('Sorry, that email is already in use.'));
            }

            if ($this->Users->save($user)) {
                $data = $user->toArray();
                $this->Auth->setUser($data);
                return $this->Flash->success(__('Your account has been updated.'));
            }
            return $this->Flash->error(__('Sorry, we could not update your information. Please try again.'));
        }
    }

    public function addNewsmedia()
    {
        /* Set information about the next commentary to be published
         * if alerts have already been sent out for it and this user
         * needs to be caught up. */
        $this->loadModel('Commentaries');

        $nextCommentary = $this->Commentaries->getNextForNewsmedia();
        if (!empty($nextCommentary)) {
            $commentaryId = $nextCommentary->id;
            $alertsSent = $this->Commentaries->isMostRecentAlert($commentaryId);
            if ($alertsSent) {
                $this->set(compact('nextCommentary'));
            }
        }

        if (isset($nextCommentary) && ! empty($nextCommentary)) {
            $articleTitle = $nextCommentary['title'];
            $date = date('l, F jS', strtotime($nextCommentary['published_date']));
            $url = Router::url([
                'controller' => 'commentaries',
                'action' => 'view',
                'id' => $nextCommentary['id'],
                'slug' => $nextCommentary['slug']
            ]);
            $this->set(compact('articleTitle', 'date', 'url'));
        }

        $user = $this->Users->newEntity();

        // Show a randomly-generated password instead of a blank field
        if (! isset($user->password) || empty($user->password)) {
            $password = $this->Users->generatePassword();
        }

        if ($this->request->session()->read(['Auth.User.group_id']) == 3) {
            $title = 'Add a Reporter to Newsmedia Alerts';
        } else {
            $title = 'Add Newsmedia Member';
        }
        $this->set([
            'titleForLayout' => $title
        ]);

        $this->set(compact('password', 'user'));

        if ($this->request->is('post')) {
            // Make sure password isn't blank
            if ($user->password === '') {
                $user->password = $this->Users->generatePassword();
            }

            $user->group_id = 3;
            $user->nm_email_alerts = 1;
            $user->password = $password;
            $user->email = $this->Users->cleanEmail($this->request->data['email']);

            if ($this->Users->save($user)) {
                $this->Flash->success('Newsmedia member added.');

                if (!$this->Users->sendNewsmediaIntroEmail($user)) {
                    $this->Flash->error('There was an error sending the introductory email.');
                }

                if ($user->send_alert && ! empty($nextCommentary) && $alertsSent) {
                    if (!$this->Users->sendNewsmediaAlertEmail($user, $nextCommentary)) {
                        $this->Flash->error('There was an error sending an alert message for the article "'.$nextCommentary->title.'".');
                    }
                }

                // Clear form
                $this->request->data = [];
                $this->request->data['send_alert'] = true;
                return;
            }
            $this->Flash->error('There was an error adding the user.');
        } else {
            $this->request->data['send_alert'] = true;
        }
    }

    public function resetPassword($userId = null, $resetPasswordHash = null)
    {
        $user = $this->Users->get($userId);
        $email = $user->email;

        $this->set([
            'titleForLayout' => 'Reset Password',
            'userId' => $userId,
            'email' => $email,
            'resetPasswordHash' => $resetPasswordHash
        ]);

        $expectedHash = $this->Users->getResetPasswordHash($userId, $email);

        if ($resetPasswordHash != $expectedHash) {
            $this->Flash->error('Invalid password-resetting code. Make sure that you entered the correct address and that the link emailed to you hasn\'t expired.');
            $this->redirect('/');
        }

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, [
                'password' => $this->request->data['new_password'],
                'confirm_password' => $this->request->data['new_confirm_password']
            ]);

            if ($this->Users->save($user)) {
                $data = $user->toArray();
                $this->Auth->setUser($data);
                return $this->Flash->success('Password changed. You are now logged in.');
            }

            $this->Flash->error('There was an error changing your password. Please check to make sure they\'ve been entered correctly.');
            return $this->redirect('/');
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Groups']
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
            'contain' => ['Groups', 'Commentaries']
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }
}
