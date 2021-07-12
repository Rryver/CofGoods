<?php

use yii\db\Migration;

/**
 * Class m210712_063455_add_rows_into_tables_sku_and_product_type
 */
class m210712_063455_add_rows_into_tables_sku_and_product_type extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('sku', [
            'id' => '1',
            'name' => 'sku_01',
        ]);
        $this->insert('sku', [
            'id' => '2',
            'name' => 'sku_02',
        ]);
        $this->insert('sku', [
            'id' => '3',
            'name' => 'sku_03',
        ]);

        $this->insert('product_type', [
            'id' => '1',
            'name' => 'type_01',
        ]);
        $this->insert('product_type', [
            'id' => '2',
            'name' => 'type_02',
        ]);
        $this->insert('product_type', [
            'id' => '3',
            'name' => 'type_03',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('sku', [
            'id' => '1',
            'name' => 'sku_01',
        ]);
        $this->delete('sku', [
            'id' => '2',
            'name' => 'sku_02',
        ]);
        $this->delete('sku', [
            'id' => '3',
            'name' => 'sku_03',
        ]);

        $this->delete('product_type', [
            'id' => '1',
            'name' => 'type_01',
        ]);
        $this->delete('product_type', [
            'id' => '2',
            'name' => 'type_02',
        ]);
        $this->delete('product_type', [
            'id' => '3',
            'name' => 'type_03',
        ]);
    }
}
