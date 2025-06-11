<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SaleItem Entity
 *
 * @property int $id
 * @property int|null $sale_id
 * @property int|null $book_id
 * @property int|null $quantity
 * @property string|null $price
 *
 * @property \App\Model\Entity\Sale $sale
 * @property \App\Model\Entity\Book $book
 */
class SaleItem extends Entity
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
        'sale_id' => true,
        'book_id' => true,
        'quantity' => true,
        'price' => true,
        'sale' => true,
        'book' => true,
    ];
}
