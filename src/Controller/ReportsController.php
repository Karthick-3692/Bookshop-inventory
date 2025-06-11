<?php
namespace App\Controller;

use Cake\Datasource\ConnectionManager;
use Cake\Utility\Text;
use Cake\Pdf\Pdf; // If using dompdf plugin or custom PDF logic
use Cake\Filesystem\File;

class ReportsController extends AppController
{
    public ?\App\Model\Table\PurchaseOrdersTable $PurchaseOrders = null;
    public function salesReport()
    {
        if ($this->request->is('post')) {
            $from = $this->request->getData('from_date');
            $to = $this->request->getData('to_date');

            $sales = $this->fetchTable('Sales')->find()
                ->contain(['Users']) // If related
                ->where([
                    'Sales.created >=' => $from,
                    'Sales.created <=' => $to
                ])->all();

            $this->set(compact('sales', 'from', 'to'));

            if ($this->request->getData('download') === 'pdf') {
                $this->viewBuilder()->disableAutoLayout();
                $this->viewBuilder()->setTemplatePath('Reports/pdf');
                $this->viewBuilder()->setTemplate('sales_pdf');

                
                $this->response = $this->response->withType('application/pdf');
                $this->response = $this->response->withDownload("sales_report_{$from}_to_{$to}.pdf");
            }
        }
    }

    
public function purchaseReport()
{
    $fromDate = $this->request->getQuery('from_date') ?? date('Y-m-01');
    $toDate = $this->request->getQuery('to_date') ?? date('Y-m-d');

    $this->loadModel('PurchaseOrders');

    $query = $this->PurchaseOrders->find()
        ->contain(['Suppliers', 'PurchaseOrderItems.Books'])
        ->where(function ($exp, $q) use ($fromDate, $toDate) {
            $conditions = [];

            if (!empty($fromDate)) {
                $conditions[] = $exp->gte('PurchaseOrders.po_date', $fromDate);
            }
            if (!empty($toDate)) {
                $conditions[] = $exp->lte('PurchaseOrders.po_date', $toDate);
            }

            return empty($conditions)
                ? $exp->notEq('PurchaseOrders.id', 0) // Prevent empty WHERE
                : $exp->and($conditions);
        });

    $purchaseOrders = $query->all();

    $this->set(compact('purchaseOrders', 'fromDate', 'toDate'));
}



public function index()
{
    
    $this->set('title', 'Reports Dashboard');
}


}

