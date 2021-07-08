<?php

/**
 * @var $this \yii\web\View
 * @var $dataProvider \yii\data\ActiveDataProvider
 */

use app\models\Product;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;


?>

<div class="admin-catalog">
  <section class="products">
    <div class="container">
        <?php Pjax::begin() ?>
      <!--      ul.products__list>li.products__item*2>div.products__card-product.card-product>h3.card-product__title+img.card-product__image+div.card-product__-->

        <?php $form = ActiveForm::begin([
            'action' => ['admin/delete-product'],
            'method' => 'post',
        ]); ?>



        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'options' => ['class' => 'products__gridview'],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'title',
                [
                    'label' => 'SKU',
                    'attribute' => 'sku_id',
//                    'value' => function($product) {
//                        return \app\models\Sku::getSkuNameById($product->sku_id);
//                    }
                ],
                'count',
                [
                    'label' => 'type',
                    'attribute' => 'type_id',
                ],
                [
                    'label' => 'Created at',
                    'attribute' => 'created_at',
                    'contentOptions' => ['style' => 'width: 130px; text-align: center'],
                ],
                [
                    'label' => 'Updated at',
                    'attribute' => 'updated_at',
                    'contentOptions' => ['style' => 'width: 130px; text-align: center'],
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    //'template' => '{update delete}',
                    'contentOptions' => ['style' => 'width: 100px; text-align: center'],
                ],
                [
                    'class' => 'yii\grid\CheckboxColumn',
                ],
            ],
        ]) ?>


        <?= Html::submitButton('Delete selected products', [
            'class' => 'products__btn btn-common_danger',
            'data' => ['confirm' => 'Delete?'],
        ]) ?>
        <?php ActiveForm::end(); ?>

        <?php Pjax::end() ?>
    </div>
  </section>
</div>
