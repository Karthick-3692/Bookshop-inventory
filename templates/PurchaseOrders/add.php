<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PurchaseOrder $purchaseOrder
 * @var \Cake\Collection\CollectionInterface|string[] $suppliers
 */

?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Purchase Orders'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="purchaseOrders form content">
            <?= $this->Form->create($purchaseOrder) ?>
            <fieldset>
                <legend><?= __('Add Purchase Order') ?></legend>
                
                <?php
                    echo $this->Form->control('po_number');
                    echo $this->Form->control('supplier_id', ['options' => $suppliers, 'empty' => true]);
                    echo $this->Form->control('po_date', ['empty' => true]);
                    echo $this->Form->control('expected_delivery_date', ['empty' => true]);
                    echo $this->Form->control('status');
                    $suppliers = $this->fetchTable('Suppliers')->find('list')->toArray();
                    $this->set(compact('suppliers'));

                    
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

