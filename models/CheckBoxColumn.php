<?php


namespace app\models;


use yii\helpers\Html;

class CheckBoxColumn extends \yii\grid\CheckboxColumn
{
    protected function renderHeaderCellContent()
    {
        return parent::renderHeaderCellContent() . ' '
            . Html::submitButton('Delete selected', [
                'class' => 'admin-gridview__btn admin-gridview__btn_inline-block btn-common_danger btn-common_disable',
                'data' => ['confirm' => 'Delete selectted products?'],
            ]);
    }
}