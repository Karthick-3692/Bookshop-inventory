<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SaleItem $saleItem
 * @var \Cake\Collection\CollectionInterface|string[] $sales
 * @var \Cake\Collection\CollectionInterface|string[] $books
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Sale Items'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="saleItems form content">
            <?= $this->Form->create($saleItem) ?>
            <fieldset>
                <legend><?= __('Add Sale Item') ?></legend>
                <?php
                    echo $this->Form->control('sale_id', ['options' => $sales, 'empty' => true]);
                    echo $this->Form->control('book_id', ['options' => $books, 'empty' => true]);
                    echo $this->Form->control('quantity');
                    echo $this->Form->control('price');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
