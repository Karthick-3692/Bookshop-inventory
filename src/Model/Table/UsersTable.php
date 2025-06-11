<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Event\EventInterface;
use Authentication\PasswordHasher\DefaultPasswordHasher;
use ArrayObject;

class UsersTable extends Table
{
    public function beforeSave(EventInterface $event, $entity, ArrayObject $options)
    {
        if ($entity->isNew() && $entity->password) {
            $hasher = new DefaultPasswordHasher();
            $entity->password = $hasher->hash($entity->password);
        }
    }
}
