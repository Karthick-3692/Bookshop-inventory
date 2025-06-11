 <h1>Register</h1>
<?php
echo $this->Form->create($user);
echo $this->Form->control('username');
echo $this->Form->control('password', ['type' => 'password']);
echo $this->Form->control('role', [
    'type' => 'select',
    'options' => ['cashier' => 'Cashier', 'manager' => 'Manager', 'admin' => 'Admin']
]);
echo $this->Form->button('Register');
echo $this->Form->end();
?>
<p>Already have an account? <?= $this->Html->link('Login here', ['action' => 'login']) ?></p>
