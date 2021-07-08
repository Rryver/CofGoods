<?php


namespace app\models;


use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * Class Image
 * @package app\models
 *
 * @property integer $id
 * @property string $name
 * @property string $extension
 */
class Image extends ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $imageFile;


    public static function tableName()
    {
        return 'image';
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'path' => 'Path to image',
            'extension' => 'Extension',
        ];
    }

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

    public function getUploadDirectory()
    {
        //return Yii::getAlias('@app') . '/uploads/product-images/';
        return Yii::$app->params['image.uploadPath'];
    }

    public static function getOneById($id)
    {
        return static::findOne(['id' => $id]);
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        if (!isset($this->imageFile)) {
            return false;
        }

        $this->name = $this->imageFile->baseName . '_id=' . time();
        $this->extension = $this->imageFile->extension;
        if ($this->upload()) {

            if (parent::save(true, ['id', 'name', 'extension'])) {
                return true;
            }
        }

        return false;
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs($this->getUploadDirectory() . $this->name . '.' . $this->extension);
            return true;
        } else {
            return false;
        }
    }

    public function getPathToImage()
    {
        return $this->getUploadDirectory() . $this->name . '.' . $this->extension;
    }

    public function deleteImageById($id)
    {
        if (self::deleteAll(['id' => $id])) {
            return true;
        }

        return false;
    }
}