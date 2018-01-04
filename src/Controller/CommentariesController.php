<?php
namespace App\Controller;

use App\Model\Entity\User;
use App\Slack;
use Cake\Core\Configure;
use Cake\Mailer\Email;
use DebugKit\DebugTimer;

/**
 * Commentaries Controller
 *
 * @property \App\Model\Table\CommentariesTable $Commentaries
 *
 * @method \App\Model\Entity\Commentary[]
 */
class CommentariesController extends AppController
{
    public $helpers = [
        'Rss'
    ];

    /**
     * initialize method
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->Slack = new Slack();
        $this->Auth->deny(['add', 'delete', 'drafts', 'edit', 'newsmediaIndex', 'sendTimedAlert']);
    }

    /**
     * Determines whether or not the user is authorized to make the current request
     *
     * @param User|null $user User entity
     * @return bool
     */
    public function isAuthorized($user)
    {
        if ($this->request->getParam('action') == 'newsmediaIndex') {
            if (!isset($user)) {
                return false;
            }
        }
        $adminActions = ['add', 'delete', 'drafts', 'edit'];
        if (in_array($this->request->getParam('action'), $adminActions)) {
            if (!isset($user)) {
                return false;
            }
            if ($user['group_id'] == 3) {
                return false;
            }
        }

        return true;
    }

    /**
     * private __addAndRemoveTags method
     *
     * @param \Cake\Datasource\EntityInterface $commentary entity
     * @return void
     */
    private function __addAndRemoveTags($commentary)
    {
        if (!isset($this->request->getData('data')['Tag'])) {
            if (isset($commentary->tags)) {
                // this suggests all tags have been removed
                foreach ($commentary->tags as $tag) {
                    $this->Commentaries->Tags->unlink($commentary, [$tag]);
                }
            }
        } else {
            if (isset($commentary->tags)) {
                // clear out all the old tags to prevent duplicates
                foreach ($commentary->tags as $tag) {
                    $this->Commentaries->Tags->unlink($commentary, [$tag]);
                }
            }
            foreach ($this->request->getData('data')['Tag'] as $id) {
                $tag = $this->Tags->get(intval($id));
                $this->Commentaries->Tags->link($commentary, [$tag]);
            }
        }
    }

    /**
     * private __dateFormat method
     *
     * @param array $date to format
     * @return false|string
     */
    private function __dateFormat($date)
    {
        return date('Y-m-d', strtotime($date['year'] . '-' . $date['month'] . '-' . $date['day']));
    }

    /**
     * If publishing to a future date, save to drafts and auto-publish on the appropriate day
     *
     * @param \Cake\Datasource\EntityInterface|array $commentary entity
     * @return array
     */
    private function __setupAutopublish($commentary)
    {
        $publish = $this->request->getData('is_published');
        $publishingDate = $this->request->getData('published_date');
        $publishingDate = $publishingDate['year'] . $publishingDate['month'] . $publishingDate['day'];
        if ($publish && $publishingDate > date('Ymd')) {
            $commentary['delay_publishing'] = 1;
            $commentary['is_published'] = 0;
        } else {
            $commentary['delay_publishing'] = 0;
        }

        return $commentary;
    }

    /**
     * Add method
     *
     * @return null
     */
    public function add()
    {
        $authors = $this->Commentaries->Users->find('list', [
            'limit' => 200
        ])->where(['author' => 1]);
        $tags = $this->Commentaries->Tags->find('list', ['limit' => 200]);
        $this->TagManager->prepareEditor($this);

        if ($this->Auth->user('group_id') == 3) {
            $this->Flash->error(__('You are not authorized for this.'));

            return null;
        }

        $commentary = $this->Commentaries->newEntity();

        $this->set(compact('commentary', 'authors', 'tags'));
        $this->set('_serialize', ['commentary']);
        $this->set(['titleForLayout' => 'Add a Commentary']);

        if ($this->request->is('post')) {
            $commentary = $this->Commentaries->patchEntity($commentary, $this->request->getData());
            $commentary->published_date = $this->__dateFormat($this->request->getData('published_date'));
            $this->__setupAutopublish($commentary);
            if ($this->Commentaries->save($commentary)) {
                $this->__addAndRemoveTags($commentary);
                $this->Flash->success(__('The commentary has been saved.'));

                return null;
            }
            $this->Flash->error(__('The commentary could not be saved. Please, try again.'));
        }

        return null;
    }

    /**
     * browse method
     *
     * @param int|null $year to browse by
     * @return array|null
     */
    public function browse($year = null)
    {
        $publishedDates = $this->Commentaries->find()
            ->select(['published_date'])
            ->where(['published_date !=' => 'NULL'])
            ->order(['published_date' => 'ASC'])
            ->toArray();

        $years = [];

        foreach ($publishedDates as $publishedDate) {
            $years[] = date('Y-m-d', strtotime($publishedDate->published_date));
        }

        $earliestYear = substr($years[0], 0, 4);
        $last = array_pop($years);
        $latestYear = substr($last, 0, 4);
        if (is_numeric($year) && $year >= $earliestYear && $year <= $latestYear) {
            $titleForLayout = "CBER Weekly Commentaries - $year";
        } else {
            $year = $latestYear;
            $titleForLayout = 'CBER Weekly Commentaries';
        }

        $commentaries = $this->Commentaries->find()
            ->select(['id', 'title', 'summary', 'created', 'published_date', 'slug'])
            ->where(['published_date LIKE' => "$year%"])
            ->andWhere(['is_published' => 1])
            ->order(['published_date' => 'ASC'])
            ->toArray();

        // If an array is being requested by an element
        if (isset($this->params['requested'])) {
            return $commentaries;
        }

        $this->set(compact(
            'commentaries',
            'earliestYear',
            'latestYear',
            'titleForLayout',
            'year'
        ));

        return null;
    }

    /**
     * Delete method
     *
     * @param string|null $id Commentary id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $commentary = $this->Commentaries->get($id);
        if ($this->Commentaries->delete($commentary)) {
            $this->Flash->success(__('The commentary has been deleted.'));
        } else {
            $this->Flash->error(__('The commentary could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * drafts method
     *
     * @return array|null
     */
    public function drafts()
    {
        // Get commentaries
        $commentaries = $this->Commentaries->find()
            ->where(['is_published' => 0])
            ->order(['modified' => 'DESC'])
            ->toArray();

        // Either return them as an array or set them as view variables
        if (isset($this->params['requested'])) {
            return $commentaries;
        }
        $this->set([
            'commentaries' => $commentaries,
            'titleForLayout' => 'Commentary Drafts'
        ]);

        return null;
    }

    /**
     * Edit method
     *
     * @param string|null $id Commentary id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if ($this->Auth->user('group_id') == 3) {
            $this->Flash->error(__('You are not authorized for this.'));

            return null;
        }

        $commentary = $this->Commentaries->get($id, [
            'contain' => ['Tags']
        ]);

        $authors = $this->Commentaries->Users->find('list', [
            'limit' => 200
        ])->where(['author' => 1]);
        $tags = $this->Commentaries->Tags->find('list', ['limit' => 200]);
        $this->TagManager->prepareEditor($this);
        $this->set(compact('commentary', 'authors', 'tags'));
        $this->set('_serialize', ['commentary']);
        $this->set(['titleForLayout' => "Edit commentary: $commentary->title"]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $commentary = $this->Commentaries->patchEntity($commentary, $this->request->getData());
            $commentary->published_date = $this->__dateFormat($this->request->getData('published_date'));
            $this->__setupAutopublish($commentary);
            if ($this->Commentaries->save($commentary)) {
                $this->__addAndRemoveTags($commentary);
                $this->Flash->success(__('The commentary has been saved.'));

                return null;
            }
            $this->Flash->error(__('The commentary could not be saved. Please, try again.'));
        }

        return null;
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $commentary = $this->Commentaries->find()
            ->where(['is_published' => 1])
            ->andWhere(['published_date <=' => date('Y-m-d')])
            ->contain(['Tags', 'Users'])
            ->order(['published_date' => 'DESC'])
            ->first();

        $this->set([
            'commentary' => $commentary,
            'newest' => true,
            'titleForLayout' => ''
        ]);
    }

    /**
     * newsmediaIndex method
     *
     * @return void
     */
    public function newsmediaIndex()
    {
        $this->set([
            'commentary' => $this->Commentaries->getNextForNewsmedia(),
            'titleForLayout' => 'Next Article to Publish'
        ]);
    }

    /**
     * rss method
     *
     * @return void
     */
    public function rss()
    {
        $commentaries = $this->Commentaries->find()
            ->select(['id', 'title', 'summary', 'body', 'slug', 'published_date'])
            ->where(['is_published' => 1])
            ->order(['published_date' => 'DESC'])
            ->limit(10)
            ->toArray();

        $this->set([
            'commentaries' => $commentaries,
            'titleForLayout' => 'Weekly Commentary with Michael Hicks'
        ]);

        $this->viewbuilder()->setLayout('rss');
    }

    /**
     * tagged method
     *
     * @param null $tagId of tag to group by
     * @return \Cake\Http\Response|null
     */
    public function tagged($tagId = null)
    {
        $tag = $this->Tags->find()
            ->contain([
                'Commentaries' => [
                    'strategy' => 'select',
                    'queryBuilder' => function ($q) {
                        return $q->distinct('Commentaries.id')->order(['Commentaries.published_date' => 'DESC']);
                    }
                ]
            ])
            ->where(['id' => $tagId])
            ->toArray();

        $this->set([
            'tagName' => $tag[0]->name,
            'commentaries' => $tag[0]->commentaries,
            'titleForLayout' => ucwords($tag[0]->name)
        ]);

        if (!is_numeric($tagId) || !isset($tag) || !$tag || !$tag[0]->name) {
            $this->Flash->error('Tag not found.');

            return $this->redirect([
                'controller' => 'commentaries',
                'action' => 'tags'
            ]);
        }

        return null;
    }

    /**
     * tags method
     *
     * @return void
     */
    public function tags()
    {
        $tagCloud = $this->TagManager->getCloud('Commentaries');
        $occurrences = [];
        foreach ($tagCloud as $tag) {
            $occurrences[] = $tag['occurrences'];
        }
        $maxOccurrences = max($occurrences);
        $this->set([
            'tagCloud' => $tagCloud,
            'titleForLayout' => 'Tags',
            'minFontSize' => 10,
            'maxFontSize' => 60,
            'maxOccurrences' => $maxOccurrences
        ]);
    }

    /**
     * View method
     *
     * @param string|null $id Commentary id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $commentary = $this->Commentaries->get($id, [
            'contain' => ['Users', 'Tags']
        ]);

        $this->set('commentary', $commentary);
        $this->set('_serialize', ['commentary']);
    }

    /**
     *
     * alertNewsmedia private method
     *
     * @return null
     */
    private function __alertNewsmedia()
    {
        $commentary = $this->Commentaries->getNextForNewsmedia();
        $msg = '';
        $msgB = '';
        $msgC = '';
        $msgD = '';

        if (empty($commentary)) {
            $msg = 'No commentary available to alert newsmedia to.';
            $this->Flash->error($msg);
            $this->__sendNewsmediaAlertReport($msg);

            return null;
        }

        $newsmedia = $this->Users->find()
            ->where(['nm_email_alerts' => 1])
            ->andWhere(['group_id' => 3])
            ->andWhere([
                'last_alert_article_id' => null,
                'OR' => [
                    'last_alert_article_id <>' => $commentary['id']
                ]
            ])
            ->toArray();

        $count = count($newsmedia);
        if ($count == 0) {
            $msg = 'Newsmedia not alerted. No applicable newsmedia members (opted in to alerts and not yet alerted) found in database.';
            $this->Flash->error($msg);

            return null;
        }

        // Impose limit on how many emails are sent out in one batch
        $limit = 50;
        if ($count > $limit) {
            $newsmedia = array_slice($newsmedia, 0, $limit);
        }

        // Send emails
        $errorRecipients = [];
        $successRecipients = [];
        foreach ($newsmedia as $user) {
            if ($this->Users->sendNewsmediaAlertEmail($user, $commentary)) {
                $successRecipients[] = $user['email'];
            } else {
                $errorRecipients[] = $user['email'];
            }
        }

        // Output results
        if (empty($successRecipients)) {
            $msg = 'No newsmedia alerts were sent';
            $this->Flash->success($msg);
        } else {
            $emailList = implode(', ', $successRecipients);
            $msg = "Newsmedia alerted: $emailList";
            $this->Flash->success($msg);
            if ($count > $limit) {
                $difference = $count - $limit;
                $msgB = $difference . ' more ' . __n('user', 'users', $difference) . ' left to alert';
                $this->Flash->success($msgB);
            } else {
                $msgB = 'All newsmedia members have now been alerted';
                $this->Flash->success($msgB);
            }
        }
        if (! empty($errorRecipients)) {
            $msgC = 'Error sending newsmedia alerts to the following: ' . implode(', ', $errorRecipients);
            $this->Flash->error($msgC);
        }
        $msgD = 'Total time spent: ' . DebugTimer::requestTime();
        $this->Flash->success($msgD);
        $this->__sendNewsmediaAlertReport($msg, $msgB, $msgC, $msgD);

        return null;
    }

    /**
     * sendNewsmediaAlertReport to be Slacked
     *
     * @param string|null $msg of alert
     * @param string|null $msgB of alert
     * @param string|null $msgC of alert
     * @param string|null $msgD of alert
     * @return null
     */
    private function __sendNewsmediaAlertReport($msg = '', $msgB = '', $msgC = '', $msgD = '')
    {
        $msgs = [$msg, $msgB, $msgC, $msgD];
        foreach ($msgs as $msg) {
            $this->Slack->addLine($msg);
        }
        if ($this->Slack->send()) {
            $this->Flash->success('Confirmed on Slack');
        } else {
            $this->Flash->error('Messages could not be sent on Slack');
        }

        return null;
    }

    /**
     * sendTimedAlert
     *
     * @param string $cronJobPassword to do the alerts
     * @return null
     */
    public function sendTimedAlert($cronJobPassword)
    {
        $password = php_sapi_name() == 'cli' ? 'fakepassword' : Configure::read('cron_job_password');
        $alertDay = 'Wednesday';
        if (date('l') != $alertDay) {
            $this->Flash->error('Alerts are only sent out on ' . $alertDay . 's');
        } elseif (date('Hi') < '1400') {
            $this->Flash->error('Alerts are only sent out after 2pm on ' . $alertDay);
        } elseif ($cronJobPassword == $password) {
            $this->__alertNewsmedia();
        } else {
            $this->Flash->error('Password incorrect');
        }
        $this->render('DataCenter.Common/blank');

        return null;
    }
}
