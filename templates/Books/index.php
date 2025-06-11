<div class="books index content">
    <?= $this->Html->link(__('New Book'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h1>Browse Books</h1>

<?= $this->Form->create(null, ['type' => 'get']) ?>
    <?= $this->Form->control('keyword', [
        'label' => false,
        'placeholder' => 'Search by title, author, or category',
        'value' => $keyword ?? ''
    ]) ?>
    <?= $this->Form->button('Search') ?>
<?= $this->Form->end() ?>
<br>

    <h3><?= __('Books') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <!-- <th><?= $this->Paginator->sort('id') ?></th> -->
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('author') ?></th>
                    <th><?= $this->Paginator->sort('publisher') ?></th>
                    <th><?= $this->Paginator->sort('isbn') ?></th>
                    <th><?= $this->Paginator->sort('edition') ?></th>
                    <th><?= $this->Paginator->sort('genre') ?></th>
                    <!-- <th><?= $this->Paginator->sort('cost') ?></th> -->
                    <th><?= $this->Paginator->sort('price') ?></th>
                    <th><?= $this->Paginator->sort('quantity') ?></th>
                    <!-- <th><?= $this->Paginator->sort('cover_image') ?></th> -->
                    <th><?= $this->Paginator->sort('language') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                    <th><?= __('Add to Cart') ?></th> <!-- NEW COLUMN FOR ADD TO CART -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book): ?>
                <tr>
                    <!-- <td><?= $this->Number->format($book->id) ?></td> -->
                    <td><?= h($book->title) ?></td>
                    <td><?= h($book->author) ?></td>
                    <td><?= h($book->publisher) ?></td>
                    <td><?= h($book->isbn) ?></td>
                    <td><?= h($book->edition) ?></td>
                    <td><?= h($book->genre) ?></td>
                    <!-- <td><?= $book->cost === null ? '' : $this->Number->format($book->cost) ?></td> -->
                    <td><?= $book->price === null ? '' : $this->Number->format($book->price) ?></td>
                    <td><?= $book->quantity === null ? '' : $this->Number->format($book->quantity) ?></td>
                    <!-- <td><?= h($book->cover_image) ?></td> -->
                    <td><?= h($book->language) ?></td>
                    <td><?= h($book->created) ?></td>
                    <td><?= h($book->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $book->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $book->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $book->id], ['confirm' => __('Are you sure you want to delete # {0}?', $book->id)]) ?>
                    </td>
                    <td>
                        <?= $this->Html->link(
                            'Add to Cart',
                            ['action' => 'addToCart', $book->id],
                            ['class' => 'btn btn-primary']
                        ) ?>
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

    <p>
        <?= $this->Html->link('View Cart', ['controller' => 'Sales', 'action' => 'create']) ?>
    </p>
</div>
