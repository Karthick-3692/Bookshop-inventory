<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PurchaseOrder $purchaseOrder
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Purchase Order'), ['action' => 'edit', $purchaseOrder->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Purchase Order'), ['action' => 'delete', $purchaseOrder->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseOrder->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Purchase Orders'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Purchase Order'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="purchaseOrders view content">
            <h3><?= h($purchaseOrder->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Po Number') ?></th>
                    <td><?= h($purchaseOrder->po_number) ?></td>
                </tr>
                <tr>
                    <th><?= __('Supplier') ?></th>
                    <td><?= $purchaseOrder->has('supplier') ? $this->Html->link($purchaseOrder->supplier->name, ['controller' => 'Suppliers', 'action' => 'view', $purchaseOrder->supplier->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= h($purchaseOrder->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($purchaseOrder->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Po Date') ?></th>
                    <td><?= h($purchaseOrder->po_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Expected Delivery Date') ?></th>
                    <td><?= h($purchaseOrder->expected_delivery_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($purchaseOrder->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($purchaseOrder->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Purchase Order Items') ?></h4>
                <?php if (!empty($purchaseOrder->purchase_order_items)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Purchase Order Id') ?></th>
                            <th><?= __('Book Id') ?></th>
                            <th><?= __('Quantity') ?></th>
                            <th><?= __('Cost') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($purchaseOrder->purchase_order_items as $purchaseOrderItems) : ?>
                        <tr>
                            <td><?= h($purchaseOrderItems->id) ?></td>
                            <td><?= h($purchaseOrderItems->purchase_order_id) ?></td>
                            <td><?= h($purchaseOrderItems->book_id) ?></td>
                            <td><?= h($purchaseOrderItems->quantity) ?></td>
                            <td><?= h($purchaseOrderItems->cost) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'PurchaseOrderItems', 'action' => 'view', $purchaseOrderItems->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'PurchaseOrderItems', 'action' => 'edit', $purchaseOrderItems->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'PurchaseOrderItems', 'action' => 'delete', $purchaseOrderItems->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseOrderItems->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
