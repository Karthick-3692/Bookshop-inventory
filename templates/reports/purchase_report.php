<h3>Purchase Report</h3>
<p>From: <?= h($fromDate) ?> To: <?= h($toDate) ?></p>

<table>
    <thead>
        <tr>
            <th>PO ID</th>
            <th>Supplier</th>
            <th>PO Date</th>
            <th>Expected Delivery</th>
            <th>Status</th>
            <th>Items</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($purchaseOrders as $po): ?>
            <tr>
                <td><?= h($po->id) ?></td>
                <td><?= h($po->supplier->name ?? 'N/A') ?></td>
                <td><?= h($po->po_date) ?></td>
                <td><?= h($po->expected_delivery_date) ?></td>
                <td><?= h($po->status) ?></td>
                <td>
                    <ul>
                        <?php foreach ($po->purchase_order_items as $item): ?>
                            <li>
                                <?= h($item->book->title ?? 'N/A') ?> - 
                                Qty: <?= h($item->quantity) ?> - 
                                ₹<?= h(number_format($item->cost, 2)) ?> each
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
