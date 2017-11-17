<?php
namespace App\Controller;

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

    public function initialize()
    {
        parent::initialize();

        // deny methods for non-users
        $this->Auth->deny(['add', 'delete', 'drafts', 'edit', 'newsmediaIndex']);
    }

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

    public function newsmediaIndex()
    {
        $this->set([
            'commentary' => $this->Commentaries->getNextForNewsmedia(),
            'titleForLayout' => 'Next Article to Publish'
        ]);
    }

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

    public function tagged($tagId = null)
    {
        $tag = $this->Tags->find()
            ->contain([
                'Commentaries' => [
                    'strategy' => 'select',
                    'queryBuilder' => function ($q) {
                        return $q->distinct('Commentaries.id')->order(['Commentaries.published_date' =>'DESC']);
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

    private function __addTags($commentary)
    {
        foreach ($this->request->getData('data')['Tag'] as $id) {
            $tag = $this->Tags->get(intval($id));
            $this->Commentaries->Tags->link($commentary, [$tag]);
        }
    }

    private function __dateFormat($date)
    {
        return date('Y-m-d', strtotime($date['year'].'-'.$date['month'].'-'.$date['day']));
    }

    // If publishing to a future date, save to drafts and auto-publish on the appropriate day
    private function __setupAutopublish($commentary)
    {
        $publish = $this->request->getData('is_published');
        $publishingDate = $this->request->getData('published_date');
        $publishingDate = $publishingDate['year'].$publishingDate['month'].$publishingDate['day'];
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
     * @return void
     */
    public function add()
    {
        $authors = $this->Commentaries->Users->find('list', [
            'limit' => 200
        ])->where(['author' => 1]);
        $tags = $this->Commentaries->Tags->find('list', ['limit' => 200]);
        $this->TagManager->prepareEditor($this);

        if ($this->Auth->user('group_id') == 3) {
            return $this->Flash->error(__('You are not authorized for this.'));
        }

        $commentary = $this->Commentaries->newEntity();

        $this->set(compact('commentary', 'authors', 'tags'));
        $this->set('_serialize', ['commentary']);
        $this->set(['titleForLayout' => 'Add a Commentary']);

        if ($this->request->is('post')) {
            $commentary = $this->Commentaries->patchEntity($commentary, $this->request->getData());
            $commentary->published_date = $this->__dateFormat($this->request->data['published_date']);
            $this->__setupAutopublish($commentary);
            if ($this->Commentaries->save($commentary)) {
                $this->__addTags($commentary);

                return $this->Flash->success(__('The commentary has been saved.'));
            }
            $this->Flash->error(__('The commentary could not be saved. Please, try again.'));
        }
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
            return $this->Flash->error(__('You are not authorized for this.'));
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
            $commentary->published_date = $this->__dateFormat($this->request->data['published_date']);
            $this->__setupAutopublish($commentary);
            if ($this->Commentaries->save($commentary)) {
                $this->__addTags($commentary);

                return $this->Flash->success(__('The commentary has been saved.'));
            }
            $this->Flash->error(__('The commentary could not be saved. Please, try again.'));
        }
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
        if ($this->Auth->user('group_id') == 3) {
            return $this->Flash->error(__('You are not authorized for this.'));
        }
        $this->request->allowMethod(['post', 'delete']);
        $commentary = $this->Commentaries->get($id);
        if ($this->Commentaries->delete($commentary)) {
            $this->Flash->success(__('The commentary has been deleted.'));
        } else {
            $this->Flash->error(__('The commentary could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

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
    }
}
