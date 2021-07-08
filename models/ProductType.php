<?php


namespace app\models;


use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;


/**
 * Class ProductType
 * @package app\models
 *
 * @property integer $id
 * @property string $name
 */
class ProductType extends ActiveRecord
{
    public static function tableName()
    {
        return 'product_type';
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Type name',
        ];
    }

    public function rules()
    {
        return [
            ['name' => 'string'],
            ['name' => 'unique', 'message' => 'This type name has already been taken'],
        ];
    }

    public static function getAllAsMap()
    {
        return ArrayHelper::map(static::find()->all(), 'id', 'name');
    }

    public static function getNmeById($type_id)
    {
        return static::findOne(['id' => $type_id])->name;
    }
}