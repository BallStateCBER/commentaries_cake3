<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Acos Controller
 *
 * @property \App\Model\Table\AcosTable $Acos
 *
 * @method \App\Model\Entity\Aco[] paginate($object = null, array $settings = [])
 */
class AcosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['ParentAcos']
        ];
        $acos = $this->paginate($this->Acos);

        $this->set(compact('acos'));
        $this->set('_serialize', ['acos']);
    }

    /**
     * View method
     *
     * @param string|null $id Aco id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $aco = $this->Acos->get($id, [
            'contain' => ['ParentAcos', 'Aros', 'ChildAcos']
        ]);

        $this->set('aco', $aco);
        $this->set('_serialize', ['aco']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $aco = $this->Acos->newEntity();
        if ($this->request->is('post')) {
            $aco = $this->Acos->patchEntity($aco, $this->request->getData());
            if ($this->Acos->save($aco)) {
                $this->Flash->success(__('The aco has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The aco could not be saved. Please, try again.'));
        }
        $parentAcos = $this->Acos->ParentAcos->find('list', ['limit' => 200]);
        $aros = $this->Acos->Aros->find('list', ['limit' => 200]);
        $this->set(compact('aco', 'parentAcos', 'aros'));
        $this->set('_serialize', ['aco']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Aco id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $aco = $this->Acos->get($id, [
            'contain' => ['Aros']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $aco = $this->Acos->patchEntity($aco, $this->request->getData());
            if ($this->Acos->save($aco)) {
                $this->Flash->success(__('The aco has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The aco could not be saved. Please, try again.'));
        }
        $parentAcos = $this->Acos->ParentAcos->find('list', ['limit' => 200]);
        $aros = $this->Acos->Aros->find('list', ['limit' => 200]);
        $this->set(compact('aco', 'parentAcos', 'aros'));
        $this->set('_serialize', ['aco']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Aco id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $aco = $this->Acos->get($id);
        if ($this->Acos->delete($aco)) {
            $this->Flash->success(__('The aco has been deleted.'));
        } else {
            $this->Flash->error(__('The aco could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
