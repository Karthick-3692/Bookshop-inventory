<?php
namespace App\Controller;

class CartController extends AppController
{
    public function index()
    {
        $session = $this->getRequest()->getSession();
        $cart = $session->read('cart') ?? [];
        $this->set(compact('cart'));
    }

    public function update()
    {
        $session = $this->getRequest()->getSession();
        $cart = $session->read('cart') ?? [];

        if ($this->request->is('post')) {
            $quantities = $this->request->getData('quantity');
            foreach ($quantities as $id => $qty) {
                if ($qty <= 0) {
                    unset($cart[$id]);
                } else {
                    $cart[$id]['quantity'] = (int)$qty;
                }
            }
            $session->write('cart', $cart);
            $this->Flash->success('Cart updated.');
        }
        return $this->redirect(['action' => 'index']);
    }

    public function checkout()
    {
        $session = $this->getRequest()->getSession();
        $cart = $session->read('cart') ?? [];

        if (empty($cart)) {
            $this->Flash->error('Your cart is empty.');
            return $this->redirect(['action' => 'index']);
        }

        

        $session->delete('cart');
        $this->Flash->success('Sale completed successfully!');

        return $this->redirect(['controller' => 'Books', 'action' => 'index']);
    }
}
