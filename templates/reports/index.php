<h2><?= h($title ?? 'Reports') ?></h2>

<ul>
    <li><?= $this->Html->link('Sales Report', ['action' => 'salesReport']) ?></li>
    <li><?= $this->Html->link('Purchase Report', ['action' => 'purchaseReport']) ?></li>
</ul>
