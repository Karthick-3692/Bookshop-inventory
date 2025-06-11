<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Dompdf\Dompdf;
use Dompdf\Options;
use Cake\Datasource\Exception\RecordNotFoundException;

class SalesController extends AppController
{
    public $Books;
    public $Sales;
    public $SaleItems;

    public function initialize(): void
    {
        parent::initialize();
        $this->loadModel('Books');
        $this->loadModel('Sales');
        $this->loadModel('SaleItems');
        $this->loadComponent('Flash');
    }

    public function create()
    {
        $books = $this->Books->find()->where(['quantity >' => 0])->all();

        if (!$this->request->getSession()->check('cart')) {
            $this->request->getSession()->write('cart', []);
        }

        if ($this->request->is('post') && $this->request->getData('add_to_cart')) {
            $bookId = $this->request->getData('add_to_cart');
            $qty = $this->request->getData('qty')[$bookId] ?? 1;
            $qty = max(1, (int)$qty);

            try {
                $book = $this->Books->get($bookId);
                $cart = $this->request->getSession()->read('cart');

                if (isset($cart[$bookId])) {
                    $cart[$bookId]['quantity'] += $qty;
                } else {
                    $cart[$bookId] = [
                        'id' => $bookId,
                        'title' => $book->title,
                        'price' => $book->price,
                        'quantity' => $qty
                    ];
                }

                $this->request->getSession()->write('cart', $cart);
                $this->Flash->success("Added '{$book->title}' to cart.");
            } catch (RecordNotFoundException $e) {
                $this->Flash->error("Book not found.");
            }

            return $this->redirect(['action' => 'create']);
        }

        $cart = $this->request->getSession()->read('cart');
        $this->set(compact('books', 'cart'));
    }

    public function checkout()
    {
        $cart = $this->request->getSession()->read('cart');
        if (empty($cart)) {
            $this->Flash->error('Cart is empty.');
            return $this->redirect(['action' => 'create']);
        }

        $sale = $this->Sales->newEmptyEntity();
        $customerName = $this->request->getData('customer_name');
$sale->customer_name = $customerName;
        $sale->date_of_sale = date('Y-m-d H:i:s');
        $sale->total_amount = array_reduce($cart, fn($total, $item) => $total + ($item['price'] * $item['quantity']), 0);
        $sale = $this->Sales->patchEntity($sale, $this->request->getData(), [
    'associated' => ['SaleItems']
]);
$this->Sales->save($sale);

        if ($this->Sales->save($sale)) {
            foreach ($cart as $bookId => $item) {
                $saleItem = $this->SaleItems->newEmptyEntity();
                $saleItem->sale_id = $sale->id;
                $saleItem->book_id = $bookId;
                $saleItem->quantity = $item['quantity'];
                $saleItem->price = $item['price'];
                $this->SaleItems->save($saleItem);

                $book = $this->Books->get($bookId);
                $book->quantity -= $item['quantity'];
                $this->Books->save($book);
            }

            $this->request->getSession()->delete('cart');
            $this->Flash->success('Sale completed successfully.');
            return $this->redirect(['action' => 'view', $sale->id]);
        } else {
            $this->Flash->error('Sale could not be completed.');
            return $this->redirect(['action' => 'create']);
        }
        
        
    }

    public function view($id = null)
    {
        $sale = $this->Sales->get($id, [
            'contain' => ['SaleItems' => ['Books']]
        ]);
        $this->set(compact('sale'));
    }

    public function index()
    {
        $sales = $this->paginate($this->Sales->find()->contain(['SaleItems.Books']));
        $this->set(compact('sales'));
    }

    public function add()
    {
        $sale = $this->Sales->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['invoice_number'] = uniqid('INV');
            $sale = $this->Sales->patchEntity($sale, $data, [
                'associated' => ['SaleItems']
            ]);
            if ($this->Sales->save($sale)) {
                foreach ($sale->sale_items as $item) {
                    $book = $this->Sales->SaleItems->Books->get($item->book_id);
                    $book->quantity -= $item->quantity;
                    $this->Sales->SaleItems->Books->save($book);
                }
                $this->Flash->success('Sale completed.');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('Unable to complete the sale. Please try again.');
        }
        $books = $this->Sales->SaleItems->Books->find('list');
        $this->set(compact('sale', 'books'));
    }

    public function edit($id = null)
    {
        $sale = $this->Sales->get($id, ['contain' => ['SaleItems']]);
        if ($this->request->is(['post', 'put'])) {
            $sale = $this->Sales->patchEntity($sale, $this->request->getData(), [
                'associated' => ['SaleItems']
            ]);
            if ($this->Sales->save($sale)) {
                $this->Flash->success('Sale updated.');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('Unable to update the sale.');
        }
        $books = $this->Sales->SaleItems->Books->find('list');
        $this->set(compact('sale', 'books'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $sale = $this->Sales->get($id);
        if ($this->Sales->delete($sale)) {
            $this->Flash->success('Sale deleted.');
        } else {
            $this->Flash->error('Unable to delete the sale.');
        }
        return $this->redirect(['action' => 'index']);
    }

    public function salesReportPdf()
    {
        $from = $this->request->getQuery('from');
        $to = $this->request->getQuery('to');

        $sales = $this->Sales->find()
            ->where(["date_of_sale BETWEEN :from AND :to"])
            ->bind(':from', $from, 'datetime')
            ->bind(':to', $to, 'datetime')
            ->contain(['SaleItems' => ['Books']])
            ->all();

        $this->viewBuilder()->enableAutoLayout(false);
        $this->viewBuilder()->setClassName('Cake\View\View');
        $this->set(compact('sales'));
        $html = $this->render('/Reports/sales_pdf')->getBody();

        $options = new Options();
        $options->set('defaultFont', 'DejaVu Sans');
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $dompdf->stream("SalesReport.pdf", ["Attachment" => false]);
        exit;
    }

    public function removeItem($bookId = null)
    {
        $cart = $this->getRequest()->getSession()->read('cart') ?? [];

        if ($bookId !== null && isset($cart[$bookId])) {
            unset($cart[$bookId]);
            $this->getRequest()->getSession()->write('cart', $cart);
            $this->Flash->success('Item removed from cart.');
        } else {
            $this->Flash->error('Item not found in cart.');
        }

        return $this->redirect(['action' => 'cart']);
    }

    public function updateCart()
    {
        $this->request->allowMethod(['post']);
        $cart = $this->getRequest()->getSession()->read('cart') ?? [];
        $quantities = $this->request->getData('quantity');

        foreach ($quantities as $bookId => $qty) {
            if (isset($cart[$bookId])) {
                $qty = (int)$qty;
                if ($qty > 0) {
                    $cart[$bookId]['quantity'] = $qty;
                } else {
                    unset($cart[$bookId]);
                }
            }
        }

        $this->getRequest()->getSession()->write('cart', $cart);
        $this->Flash->success('Cart updated successfully.');
        return $this->redirect(['action' => 'cart']);
    }

 public function removeFromCart($bookId = null)
{
    $this->request->allowMethod(['post', 'delete']);

    $cart = $this->request->getSession()->read('cart') ?? [];

    if ($bookId !== null && isset($cart[$bookId])) {
        unset($cart[$bookId]);
        $this->request->getSession()->write('cart', $cart);
        $this->Flash->success('Item removed from cart.');
    } else {
        $this->Flash->error('Item not found in cart.');
    }

    return $this->redirect(['action' => 'create']);
}



public function viewInvoice($id)
{
    $sale = $this->Sales->get($id, [
        'contain' => ['Users', 'SaleItems' => ['Books']],
    ]);

    $this->set(compact('sale'));
}


    public function invoicePdf($id = null)
{
    if (!$id) {
        $this->Flash->error('Invalid sale ID.');
        return $this->redirect(['action' => 'index']);
    }

    
     $sale = $this->Sales->get($id, [
        'contain' => ['Users', 'SaleItems' => ['Books']],
    ]);

    
    $this->viewBuilder()->setLayout(null);
    $this->viewBuilder()->setClassName('Cake\View\View');
    $this->set(compact('sale'));

    $html = $this->render('invoice_pdf')->getBody();

    
    $options = new Options();
    $options->set('defaultFont', 'DejaVu Sans'); // Support UTF-8
    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    
    $dompdf->stream("Invoice_{$sale->id}.pdf", ['Attachment' => false]);

    
    return $this->response->withType('application/pdf');
}
}

