<h2>Purchase History Report</h2>
<p>From: <?= h($from) ?> | To: <?= h($to) ?></p>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Supplier</th>
        <th>Date</th>
        <th>Total</th>
    </tr>
    <?php foreach ($purchases as $purchase): ?>
    <tr>
        <td>#<?= h($purchase->id) ?></td>
        <td><?= h($purchase->supplier_name ?? '-') ?></td>
        <td><?= h($purchase->created) ?></td>
        <td>$<?= h($purchase->total_amount ?? '0.00') ?></td>
    </tr>
    <?php endforeach; ?>
</table>
