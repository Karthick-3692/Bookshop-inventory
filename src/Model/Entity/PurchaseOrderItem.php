<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PurchaseOrderItem Entity
 *
 * @property int $id
 * @property int|null $purchase_order_id
 * @property int|null $book_id
 * @property int|null $quantity
 * @property string|null $cost
 *
 * @property \App\Model\Entity\PurchaseOrder $purchase_order
 * @property \App\Model\Entity\Book $book
 */
class PurchaseOrderItem extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'purchase_order_id' => true,
        'book_id' => true,
        'quantity' => true,
        'cost' => true,
        'purchase_order' => true,
        'book' => true,
    ];
}
