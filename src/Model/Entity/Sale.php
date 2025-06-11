<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Sale Entity
 *
 * @property int $id
 * @property string|null $invoice_number
 * @property string|null $customer_name
 * @property \Cake\I18n\FrozenTime|null $sale_date
 * @property string|null $total_amount
 *
 * @property \App\Model\Entity\SaleItem[] $sale_items
 */
class Sale extends Entity
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
        'invoice_number' => true,
        'customer_name' => true,
        'date_of_sale' => true,
        'total_amount' => true,
        'sale_items' => true,
    ];
}
