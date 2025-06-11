<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\SaleItem> $saleItems
 */
?>
<div class="salesItems index content">
    <?= $this->Html->link(__('New Sale Item'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Sale Items') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('sale_id') ?></th>
                    <th><?= $this->Paginator->sort('book_id') ?></th>
                    <th><?= $this->Paginator->sort('quantity') ?></th>
                    <th><?= $this->Paginator->sort('price') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($saleItems as $saleItem): ?>
                <tr>
                    <td><?= $this->Number->format($saleItem->id) ?></td>
                    <td><?= $saleItem->has('sale') ? $this->Html->link($saleItem->sale->id, ['controller' => 'Sales', 'action' => 'view', $saleItem->sale->id]) : '' ?></td>
                    <td><?= $saleItem->has('book') ? $this->Html->link($saleItem->book->title, ['controller' => 'Books', 'action' => 'view', $saleItem->book->id]) : '' ?></td>
                    <td><?= $saleItem->quantity === null ? '' : $this->Number->format($saleItem->quantity) ?></td>
                    <td><?= $saleItem->price === null ? '' : $this->Number->format($saleItem->price) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $saleItem->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $saleItem->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $saleItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $saleItem->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>

<?= $this->Form->create(null, ['url' => ['controller' => 'Cart', 'action' => 'update']]) ?>
<table>
    <tr><th>Title</th><th>Price</th><th>Quantity</th><th>Subtotal</th></tr>
    <?php
    $total = 0;
    foreach ($cart as $item):
        $subtotal = $item['price'] * $item['quantity'];
        $total += $subtotal;
    ?>
    <tr>
        <td><?= h($item['title']) ?></td>
        <td>$<?= h($item['price']) ?></td>
        <td>
            <?= $this->Form->number('quantity[' . $item['id'] . ']', ['value' => $item['quantity'], 'min' => 0]) ?>
        </td>
        <td>$<?= $subtotal ?></td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="3"><strong>Total</strong></td>
        <td><strong>$<?= $total ?></strong></td>
    </tr>
</table>
<?= $this->Form->button('Update Cart') ?>
<?= $this->Form->end() ?>
