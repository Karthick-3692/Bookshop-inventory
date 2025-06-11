<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * 
 *
 * @property \App\Model\Table\SaleItemsTable $SaleItems
 * @method \App\Model\Entity\SaleItem[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SaleItemsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Sales', 'Books'],
        ];
        $saleItems = $this->paginate($this->SaleItems);

        $this->set(compact('saleItems'));
    }

    /**
     * View method
     *
     * @param string|null $id Sale Item id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $saleItem = $this->SaleItems->get($id, [
            'contain' => ['Sales', 'Books'],
        ]);

        $this->set(compact('saleItem'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $saleItem = $this->SaleItems->newEmptyEntity();
        if ($this->request->is('post')) {
            $saleItem = $this->SaleItems->patchEntity($saleItem, $this->request->getData());
            if ($this->SaleItems->save($saleItem)) {
                $this->Flash->success(__('The sale item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sale item could not be saved. Please, try again.'));
        }
        $sales = $this->SaleItems->Sales->find('list', ['limit' => 200])->all();
        $books = $this->SaleItems->Books->find('list', ['limit' => 200])->all();
        $this->set(compact('saleItem', 'sales', 'books'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Sale Item id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $saleItem = $this->SaleItems->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $saleItem = $this->SaleItems->patchEntity($saleItem, $this->request->getData());
            if ($this->SaleItems->save($saleItem)) {
                $this->Flash->success(__('The sale item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sale item could not be saved. Please, try again.'));
        }
        $sales = $this->SaleItems->Sales->find('list', ['limit' => 200])->all();
        $books = $this->SaleItems->Books->find('list', ['limit' => 200])->all();
        $this->set(compact('saleItem', 'sales', 'books'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sale Item id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $saleItem = $this->SaleItems->get($id);
        if ($this->SaleItems->delete($saleItem)) {
            $this->Flash->success(__('The sale item has been deleted.'));
        } else {
            $this->Flash->error(__('The sale item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
