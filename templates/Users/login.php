<h1>Login</h1>
<?php
echo $this->Form->create();
echo $this->Form->control('username');
echo $this->Form->control('password');
echo $this->Form->button('Login');
echo $this->Form->end();

?>

<p>Don't have an account? <?= $this->Html->link('Register', ['controller' => 'Users', 'action' => 'register']) ?></p>