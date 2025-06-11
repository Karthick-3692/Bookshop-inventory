<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PurchaseOrder Entity
 *
 * @property int $id
 * @property string|null $po_number
 * @property int|null $supplier_id
 * @property \Cake\I18n\FrozenDate|null $po_date
 * @property \Cake\I18n\FrozenDate|null $expected_delivery_date
 * @property string|null $status
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Supplier $supplier
 * @property \App\Model\Entity\PurchaseOrderItem[] $purchase_order_items
 */
class PurchaseOrder extends Entity
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
        'po_number' => true,
        'supplier_id' => true,
        'po_date' => true,
        'expected_delivery_date' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'supplier' => true,
        'purchase_order_items' => true,
    ];
}
