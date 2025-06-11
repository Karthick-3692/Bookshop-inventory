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
            <?= $this->Html->link(__('List Books'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="books form content">
            <?= $this->Form->create($book) ?>
            <fieldset>
                <legend><?= __('Add Book') ?></legend>
                <?php
                    echo $this->Form->control('title', ['required' => true]);
                    echo $this->Form->control('author', ['required' => true]);
                    echo $this->Form->control('publisher');
                    echo $this->Form->control('isbn');
                    echo $this->Form->control('edition');
                    echo $this->Form->control('genre');
                    echo $this->Form->control('price', ['required' => true]);
                    echo $this->Form->control('quantity', ['required' => true]);
                    
                    echo $this->Form->control('language');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
