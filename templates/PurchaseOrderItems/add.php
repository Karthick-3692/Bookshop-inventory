<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PurchaseOrderItem $purchaseOrderItem
 * @var \Cake\Collection\CollectionInterface|string[] $purchaseOrders
 * @var \Cake\Collection\CollectionInterface|string[] $books
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Purchase Order Items'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="purchaseOrderItems form content">
            <?= $this->Form->create($purchaseOrderItem) ?>
            <fieldset>
                <legend><?= __('Add Purchase Order Item') ?></legend>
                <?php
                    echo $this->Form->control('purchase_order_id', ['options' => $purchaseOrders, 'empty' => true]);
                    echo $this->Form->control('book_id', ['options' => $books, 'empty' => true]);
                    echo $this->Form->control('quantity');
                    echo $this->Form->control('cost');
                    
                ?>
                <h4>Purchase Items</h4>
<table>
    <tr>
        <th>Book</th>
        <th>Quantity</th>
        <th>Cost</th>
    </tr>
    <?php $i = 0; ?>
    <?php foreach ($books as $book): ?>
        <tr>
            <td>
                <?= h($book->title) ?>
                <?= $this->Form->hidden("purchase_order_items.$i.book_id", ['value' => $book->id]) ?>
            </td>
            <td><?= $this->Form->control("purchase_order_items.$i.quantity", ['label' => false]) ?></td>
            <td><?= $this->Form->control("purchase_order_items.$i.cost", ['label' => false]) ?></td>
        </tr>
        <?php $i++; ?>
    <?php endforeach; ?>
</table>

            </fieldset>
            
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
