<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CommentariesTags Controller
 *
 * @property \App\Model\Table\CommentariesTagsTable $CommentariesTags
 *
 * @method \App\Model\Entity\CommentariesTag[] paginate($object = null, array $settings = [])
 */
class CommentariesTagsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Commentaries', 'Tags']
        ];
        $commentariesTags = $this->paginate($this->CommentariesTags);

        $this->set(compact('commentariesTags'));
        $this->set('_serialize', ['commentariesTags']);
    }

    /**
     * View method
     *
     * @param string|null $id Commentaries Tag id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $commentariesTag = $this->CommentariesTags->get($id, [
            'contain' => ['Commentaries', 'Tags']
        ]);

        $this->set('commentariesTag', $commentariesTag);
        $this->set('_serialize', ['commentariesTag']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $commentariesTag = $this->CommentariesTags->newEntity();
        if ($this->request->is('post')) {
            $commentariesTag = $this->CommentariesTags->patchEntity($commentariesTag, $this->request->getData());
            if ($this->CommentariesTags->save($commentariesTag)) {
                $this->Flash->success(__('The commentaries tag has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The commentaries tag could not be saved. Please, try again.'));
        }
        $commentaries = $this->CommentariesTags->Commentaries->find('list', ['limit' => 200]);
        $tags = $this->CommentariesTags->Tags->find('list', ['limit' => 200]);
        $this->set(compact('commentariesTag', 'commentaries', 'tags'));
        $this->set('_serialize', ['commentariesTag']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Commentaries Tag id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $commentariesTag = $this->CommentariesTags->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $commentariesTag = $this->CommentariesTags->patchEntity($commentariesTag, $this->request->getData());
            if ($this->CommentariesTags->save($commentariesTag)) {
                $this->Flash->success(__('The commentaries tag has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The commentaries tag could not be saved. Please, try again.'));
        }
        $commentaries = $this->CommentariesTags->Commentaries->find('list', ['limit' => 200]);
        $tags = $this->CommentariesTags->Tags->find('list', ['limit' => 200]);
        $this->set(compact('commentariesTag', 'commentaries', 'tags'));
        $this->set('_serialize', ['commentariesTag']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Commentaries Tag id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $commentariesTag = $this->CommentariesTags->get($id);
        if ($this->CommentariesTags->delete($commentariesTag)) {
            $this->Flash->success(__('The commentaries tag has been deleted.'));
        } else {
            $this->Flash->error(__('The commentaries tag could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
