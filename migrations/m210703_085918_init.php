<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m210703_085918_init
 */
class m210703_085918_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => Schema::TYPE_DATETIME,
            'updated_at' => Schema::TYPE_DATETIME,
            'verification_token' => $this->string()->defaultValue(null),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{user}}');
    }
}
