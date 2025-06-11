<h2>Available Books</h2>
<form method="post">
    <table border="1" cellpadding="6">
        <tr>
            <th>Title</th><th>Price</th><th>Available</th><th>Qty</th><th>Add</th>
        </tr>
        <?php foreach ($books as $book): ?>
        <tr>
            <td><?= h($book->title) ?></td>
            <td>$<?= h($book->price) ?></td>
            <td><?= h($book->quantity) ?></td>
            
            <td>
                <input type="number" name="qty[<?= $book->id ?>]" value="1" min="1" max="<?= $book->quantity ?>">
            </td>
            <td>
                <button type="submit" name="add_to_cart" value="<?= $book->id ?>">Add to Cart</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</form>

<?php if (!empty($cart)): ?>
    <h3>🛒 Cart</h3>
    <form method="post" action="<?= $this->Url->build(['action' => 'checkout']) ?>">
        <table border="1" cellpadding="6">
            <tr>
                <th>Title</th><th>Qty</th><th>Price</th><th>Subtotal</th><th>Action</th>
            </tr>
            <?php $total = 0; foreach ($cart as $bookId => $item): ?>
            <tr>
                <td><?= h($item['title']) ?></td>
                <td><?= h($item['quantity']) ?></td>
                <td>$<?= h($item['price']) ?></td>
                <td>$<?= number_format($item['quantity'] * $item['price'], 2) ?></td>
                <td>
                    <?= $this->Form->postLink(
                        'Delete',
                        ['action' => 'removeFromCart', $bookId],
                        ['confirm' => 'Are you sure?', 'class' => 'btn btn-danger btn-sm']
                    ) ?>
                </td>
            </tr>
            <?php $total += $item['quantity'] * $item['price']; endforeach; ?>
            <tr>
                <td colspan="3"><strong>Total</strong></td>
                <td>$<?= number_format($total, 2) ?></td>
                <td></td>
            </tr>
        </table>

        <br>
        <?= $this->Form->create(null, ['url' => ['action' => 'checkout']]) ?>
<?= $this->Form->control('customer_name', ['label' => 'Customer Name', 'required' => true]) ?>
<?= $this->Form->button('✅ Checkout', ['class' => 'btn btn-success']) ?>
<?= $this->Form->end() ?>




         
    </form>
<?php endif; ?>

