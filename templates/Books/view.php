<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Book $book
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Book'), ['action' => 'edit', $book->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Book'), ['action' => 'delete', $book->id], ['confirm' => __('Are you sure you want to delete # {0}?', $book->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Books'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Book'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="books view content">
            <h3><?= h($book->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($book->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Author') ?></th>
                    <td><?= h($book->author) ?></td>
                </tr>
                <tr>
                    <th><?= __('Publisher') ?></th>
                    <td><?= h($book->publisher) ?></td>
                </tr>
                <tr>
                    <th><?= __('Isbn') ?></th>
                    <td><?= h($book->isbn) ?></td>
                </tr>
                <tr>
                    <th><?= __('Edition') ?></th>
                    <td><?= h($book->edition) ?></td>
                </tr>
                <tr>
                    <th><?= __('Genre') ?></th>
                    <td><?= h($book->genre) ?></td>
                </tr>
                <tr>
                    <th><?= __('Cover Image') ?></th>
                    <td><?= h($book->cover_image) ?></td>
                </tr>
                <tr>
                    <th><?= __('Language') ?></th>
                    <td><?= h($book->language) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($book->id) ?></td>
                </tr>
                <!-- <tr>
                    <th><?= __('Cost') ?></th>
                    <td><?= $book->cost === null ? '' : $this->Number->format($book->cost) ?></td>
                </tr> -->
                <tr>
                    <th><?= __('Price') ?></th>
                    <td><?= $book->price === null ? '' : $this->Number->format($book->price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Quantity') ?></th>
                    <td><?= $book->quantity === null ? '' : $this->Number->format($book->quantity) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($book->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($book->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Purchase Order Items') ?></h4>
                <?php if (!empty($book->purchase_order_items)) : ?>
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
                        <?php foreach ($book->purchase_order_items as $purchaseOrderItems) : ?>
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
            <div class="related">
                <h4><?= __('Related Sale Items') ?></h4>
                <?php if (!empty($book->sale_items)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Sale Id') ?></th>
                            <th><?= __('Book Id') ?></th>
                            <th><?= __('Quantity') ?></th>
                            <th><?= __('Price') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($book->sale_items as $saleItems) : ?>
                        <tr>
                            <td><?= h($saleItems->id) ?></td>
                            <td><?= h($saleItems->sale_id) ?></td>
                            <td><?= h($saleItems->book_id) ?></td>
                            <td><?= h($saleItems->quantity) ?></td>
                            <td><?= h($saleItems->price) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'SaleItems', 'action' => 'view', $saleItems->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'SaleItems', 'action' => 'edit', $saleItems->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'SaleItems', 'action' => 'delete', $saleItems->id], ['confirm' => __('Are you sure you want to delete # {0}?', $saleItems->id)]) ?>
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
