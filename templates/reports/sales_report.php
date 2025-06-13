<h3>Sales Report</h3>

<?= $this->Form->create() ?>
    <label>From:</label>
    <?= $this->Form->control('from_date', ['type' => 'date']) ?>

    <label>To:</label>
    <?= $this->Form->control('to_date', ['type' => 'date']) ?>

    <button type="submit">View</button>
    <button type="submit" name="download" value="pdf">Download PDF</button>
     <?= $this->Form->end() ?>

<?php if (!empty($sales)): ?>
    <table>
        <tr>
            <th>Invoice</th>
            <th>User</th>
            <th>Date</th>
            <th>Total</th>
        </tr>
        <?php foreach ($sales as $sale): ?>
        <tr>
            <td>#<?= h($sale->id) ?></td>
            <td><?= h($sale->customer_name ?? ' ') ?></td>
            <td><?= $sale->date_of_sale ? h($sale->date_of_sale->format('d-m-Y H:i A')) : 'N/A' ?></td>
            <td>$<?= h($sale->total_amount) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
