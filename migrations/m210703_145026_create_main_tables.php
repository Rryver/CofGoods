<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m210703_145026_create_main_tables
 */
class m210703_145026_create_main_tables extends Migration
{


    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'image_id' => $this->integer(11)->defaultValue(null),
            'sku_id' => $this->integer()->defaultValue(null),
            'title' => $this->string(255)->notNull(),
            'count' => $this->integer()->defaultValue(0),
            'type_id' => $this->integer()->defaultValue(null),
            'created_at' => Schema::TYPE_DATETIME,
            'updated_at' => Schema::TYPE_DATETIME,
        ], $tableOptions);

        $this->createTable('sku', [
            'id' => $this->primaryKey(),
            'name' => $this->text()->notNull()->unique(),
        ], $tableOptions);

        $this->createTable('product_type', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()->unique(),
        ], $tableOptions);

        $this->createTable('image', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'extension' => $this->string(50)->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('product');
        $this->dropTable('sku');
        $this->dropTable('product_type');
        $this->dropTable('image');
    }
}
