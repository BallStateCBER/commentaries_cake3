<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Commentaries Controller
 *
 * @property \App\Model\Table\CommentariesTable $Commentaries
 *
 * @method \App\Model\Entity\Commentary[] paginate($object = null, array $settings = [])
 */
class CommentariesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $commentary = $this->Commentaries->find()
            ->where(['is_published' => 1])
            ->contain(['Tags', 'Users'])
            ->order(['published_date' => 'DESC'])
            ->first();

        $this->set([
            'commentary' => $commentary,
            'newest' => true,
            'titleForLayout' => ''
        ]);
    }

    public function tags()
    {
        $tagCloud = $this->TagManager->getCloud('Commentary');
        $occurrances = Set::extract('/occurrences', $tagCloud);
        $this->set([
            'tagCloud' => $tagCloud,
            'title_for_layout' => 'Tags',
            'min_font_size' => 10,
            'max_font_size' => 60,
            'max_occurrances' => max($occurrances)
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
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $commentary = $this->Commentaries->newEntity();
        if ($this->request->is('post')) {
            $commentary = $this->Commentaries->patchEntity($commentary, $this->request->getData());
            if ($this->Commentaries->save($commentary)) {
                $this->Flash->success(__('The commentary has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The commentary could not be saved. Please, try again.'));
        }
        $users = $this->Commentaries->Users->find('list', ['limit' => 200]);
        $tags = $this->Commentaries->Tags->find('list', ['limit' => 200]);
        $this->set(compact('commentary', 'users', 'tags'));
        $this->set('_serialize', ['commentary']);
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
        $commentary = $this->Commentaries->get($id, [
            'contain' => ['Tags']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $commentary = $this->Commentaries->patchEntity($commentary, $this->request->getData());
            if ($this->Commentaries->save($commentary)) {
                $this->Flash->success(__('The commentary has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The commentary could not be saved. Please, try again.'));
        }
        $users = $this->Commentaries->Users->find('list', ['limit' => 200]);
        $tags = $this->Commentaries->Tags->find('list', ['limit' => 200]);
        $this->set(compact('commentary', 'users', 'tags'));
        $this->set('_serialize', ['commentary']);
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
        $this->request->allowMethod(['post', 'delete']);
        $commentary = $this->Commentaries->get($id);
        if ($this->Commentaries->delete($commentary)) {
            $this->Flash->success(__('The commentary has been deleted.'));
        } else {
            $this->Flash->error(__('The commentary could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
