<?php


namespace app\models;


use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * Class Product
 * @package app\models
 *
 * @property integer $id
 * @property integer $image_id
 * @property integer $sku_id
 * @property string $title
 * @property integer $count
 * @property integer $type_id
 * @property integer $created_at
 * @property integer $updated_at
 */
class Product extends ActiveRecord
{
    public static function tableName()
    {
        return 'product';
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image_id' => 'Preview image for product',
            'sku_id' => 'SKU',
            'title' => 'Name of product',
            'type_id' => 'Product type',
            'created_at' => 'Creation time',
            'updated_at' => 'Update time',
        ];
    }

    public function rules()
    {
        return [
            ['title', 'required', 'message' => 'Product name should be filled'],
            ['title', 'unique', 'message' => 'Product with this name already exist'],
            ['title', 'string', 'min' => 3, 'max' => 255],
            [['sku_id', 'type_id', 'count'], 'integer'],

        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public static function getProductById($id)
    {
        return static::findOne(['id' => $id]);
    }

    public static function getAll()
    {
        return static::find()->all();
    }

    public function delete($id = null)
    {


        return parent::delete();
    }
}