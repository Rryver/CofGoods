<?php


namespace app\models;


use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;


/**
 * Class Sku
 * @package app\models
 *
 * @property integer $id
 * @property string $name
 */
class Sku extends ActiveRecord
{
    public static function tableName()
    {
        return 'sku';
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Sku name',
        ];
    }

    public static function getAllAsMap()
    {
        return ArrayHelper::map(static::find()->all(), 'id', 'name');
    }

    public static function getNameById($id)
    {
        return static::findOne(['id' => $id])->name;
    }
}