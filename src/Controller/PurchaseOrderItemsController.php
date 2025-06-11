<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * 
 *
 * @property \App\Model\Table\PurchaseOrderItemsTable $PurchaseOrderItems
 * @method \App\Model\Entity\PurchaseOrderItem[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PurchaseOrderItemsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['PurchaseOrders', 'Books'],
        ];
        $purchaseOrderItems = $this->paginate($this->PurchaseOrderItems);

        $this->set(compact('purchaseOrderItems'));
    }

    /**
     * View method
     *
     * @param string|null $id Purchase Order Item id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $purchaseOrderItem = $this->PurchaseOrderItems->get($id, [
            'contain' => ['PurchaseOrders', 'Books'],
        ]);

        $this->set(compact('purchaseOrderItem'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $purchaseOrderItem = $this->PurchaseOrderItems->newEmptyEntity();
        if ($this->request->is('post')) {
            $purchaseOrderItem = $this->PurchaseOrderItems->patchEntity($purchaseOrderItem, $this->request->getData());
            if ($this->PurchaseOrderItems->save($purchaseOrderItem)) {
                $this->Flash->success(__('The purchase order item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase order item could not be saved. Please, try again.'));
        }
        $purchaseOrders = $this->PurchaseOrderItems->PurchaseOrders->find('list', ['limit' => 200])->all();
        $books = $this->PurchaseOrderItems->Books->find('list', ['limit' => 200])->all();
        $this->set(compact('purchaseOrderItem', 'purchaseOrders', 'books'));
    }

    /**
     * 
     *
     * @param string|null $id Purchase Order Item id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $purchaseOrderItem = $this->PurchaseOrderItems->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $purchaseOrderItem = $this->PurchaseOrderItems->patchEntity($purchaseOrderItem, $this->request->getData());
            if ($this->PurchaseOrderItems->save($purchaseOrderItem)) {
                $this->Flash->success(__('The purchase order item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase order item could not be saved. Please, try again.'));
        }
        $purchaseOrders = $this->PurchaseOrderItems->PurchaseOrders->find('list', ['limit' => 200])->all();
        $books = $this->PurchaseOrderItems->Books->find('list', ['limit' => 200])->all();
        $this->set(compact('purchaseOrderItem', 'purchaseOrders', 'books'));
    }

    /**
     * 
     *
     * @param string|null $id Purchase Order Item id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $purchaseOrderItem = $this->PurchaseOrderItems->get($id);
        if ($this->PurchaseOrderItems->delete($purchaseOrderItem)) {
            $this->Flash->success(__('The purchase order item has been deleted.'));
        } else {
            $this->Flash->error(__('The purchase order item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
