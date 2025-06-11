<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SaleItem $saleItem
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Sale Item'), ['action' => 'edit', $saleItem->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Sale Item'), ['action' => 'delete', $saleItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $saleItem->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Sale Items'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Sale Item'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="saleItems view content">
            <h3><?= h($saleItem->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Sale') ?></th>
                    <td><?= $saleItem->has('sale') ? $this->Html->link($saleItem->sale->id, ['controller' => 'Sales', 'action' => 'view', $saleItem->sale->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Book') ?></th>
                    <td><?= $saleItem->has('book') ? $this->Html->link($saleItem->book->title, ['controller' => 'Books', 'action' => 'view', $saleItem->book->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($saleItem->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Quantity') ?></th>
                    <td><?= $saleItem->quantity === null ? '' : $this->Number->format($saleItem->quantity) ?></td>
                </tr>
                <tr>
                    <th><?= __('Price') ?></th>
                    <td><?= $saleItem->price === null ? '' : $this->Number->format($saleItem->price) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
