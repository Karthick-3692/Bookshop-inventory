<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sale $sale
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Sale'), ['action' => 'edit', $sale->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Sale'), ['action' => 'delete', $sale->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sale->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Sales'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Sale'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="sales view content">
            <h3><?= h($sale->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Invoice Number') ?></th>
                    <td><?= h($sale->invoice_number) ?></td>
                </tr>
                <tr>
                    <th><?= __('Customer Name') ?></th>
                    <td><?= h($sale->customer_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($sale->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Total Amount') ?></th>
                    <td><?= $sale->total_amount === null ? '' : $this->Number->format($sale->total_amount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Sale Date') ?></th>
                    <td><?= h($sale->sale_date) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Sale Items') ?></h4>
                <?php if (!empty($sale->sale_items)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Sale Id') ?></th>
                            <th><?= __('Book Id') ?></th>
                            <th><?= __('Quantity') ?></th>
                            <th><?= __('Price') ?></th>
                            <!-- <th class="actions"><?= __('Actions') ?></th> -->
                        </tr>
                        <?php foreach ($sale->sale_items as $saleItems) : ?>
                        <tr>
                            <td><?= h($saleItems->id) ?></td>
                            <td><?= h($saleItems->sale_id) ?></td>
                            <td><?= h($saleItems->book_id) ?></td>
                            <td><?= h($saleItems->quantity) ?></td>
                            <td><?= h($saleItems->price) ?></td>
                            <!-- <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'SaleItems', 'action' => 'view', $saleItems->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'SaleItems', 'action' => 'edit', $saleItems->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'SaleItems', 'action' => 'delete', $saleItems->id], ['confirm' => __('Are you sure you want to delete # {0}?', $saleItems->id)]) ?>
                            </td> -->
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->Html->link('Download Invoice PDF', ['action' => 'invoicePdf', $sale->id], ['target' => '_blank']) ?>
