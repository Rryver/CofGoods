<?php


namespace app\models;


use yii\base\Model;

class ProductSearch extends Product
{
    public $searchData;

    public function rules()
    {
        return [
            ['searchData', 'trim', 'string'],
            [[''], string]
        ];
    }


}