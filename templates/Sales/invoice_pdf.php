<h2>Invoice #<?= h($sale->id) ?></h2>
<p>Customer Name: <?= h($sale->customer_name) ?></p>

<p><strong>Date of Sale:</strong>  <?= $sale->date_of_sale ? h($sale->date_of_sale->format('d-m-Y H:i A')) : 'N/A' ?></p>


<table>
    <tr>
        <th>Book Name</th>
        <th>Quantity</th>
        <th>Unit Price</th>
        <th>Total</th>
    </tr>
    <?php foreach ($sale->sale_items as $item): ?>
    <tr>
        <td><?= h($item->book->title) ?></td>
        <td><?= $item->quantity ?></td>
        <td>$<?= number_format($item->price, 2) ?></td>
        <td>$<?= number_format($item->price * $item->quantity, 2) ?></td>

    </tr>
    <?php endforeach; ?>
</table>
