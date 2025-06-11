<h2>Search Books</h2>

<?= $this->Form->create(null, ['type' => 'get']) ?>
<?= $this->Form->control('q', ['label' => false, 'value' => $search, 'placeholder' => 'Enter book title...']) ?>
<?= $this->Form->submit('Search') ?>
<?= $this->Form->end() ?>

<?php if (!empty($books->count())): ?>
    <table border="1">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Price</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($books as $book): ?>
            <tr>
                <td><?= h($book->title) ?></td>
                <td><?= h($book->author) ?></td>
                <td>$<?= h($book->price) ?></td>
                <td><?= h($book->stock) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No books found.</p>
<?php endif; ?>
