<?php

/**
 * @var $this \yii\web\View
 * @var $dataProvider \yii\data\ActiveDataProvider
 * @var $product Product
 */

use app\models\Image;
use app\models\Product;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;


?>

<div class="admin-catalog">
  <section class="products">
    <div class="container-admin">
        <?php Pjax::begin() ?>

        <?php $searchForm = ActiveForm::begin([
            'options' => ['class' => 'products__search-form search-form form-common'],
            'action' => ['admin/product-search'],
            'method' => 'post',
        ]); ?>



        <?php ActiveForm::end(); ?>

      <label class="form-edit__label">Search by name or sku</label>
      <div class="products__search search">
        <input class="form-edit__input form-edit__input_small" type="text">
        <button class="btn-common">Search</button>
      </div>

        <?php $form = ActiveForm::begin([
            'action' => ['admin/delete-product'],
            'method' => 'post',
        ]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'options' => ['class' => 'products__gridview'],
            'pager' => [
                'options' => ['class' => 'pagination-widget__list'],
                'pageCssClass' => 'pagination-widget__item',
                'prevPageCssClass' => 'pagination-widget__item pagination-widget__item-prev',
                'nextPageCssClass' => 'pagination-widget__item pagination-widget__item-next',
                'activePageCssClass' => 'pagination-widget__item_active',
                'linkOptions' => ['class' => 'pagination-widget__link'],
            ],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'title',
                [
                    'label' => 'Image',
                    'format' => 'raw',
                    'value' => function ($product) {
                        return Html::img(
                            $product->getPathToImage(),
                            [
                                'alt' => 'qwe',
                                'style' => 'max-width: 200px; height: auto;',
                            ]
                        );
                    }
                ],
                [
                    'label' => 'SKU',
                    'attribute' => 'sku_id',
                    'value' => function ($product) {
                        return \app\models\Sku::getNameById($product->sku_id);
                    }
                ],
                'count',
                [
                    'label' => 'type',
                    'attribute' => 'type_id',
                    'value' => function ($product) {
                        return \app\models\ProductType::getNmeById($product->type_id);
                    }
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
                    'template' => '{update} {delete}',
                    'buttons' => [
                        'update' => function ($url, $product) {
                            return Html::a(
                                'Edit',
                                ['admin/product-edit', 'id' => $product->id],
                                ['class' => 'admin-gridview__btn btn-common']);
                        },
                        'delete' => function ($url, $product) {
                            return Html::a(
                                'Delete',
                                ['admin/product-delete', 'id' => $product->id],
                                [
                                    'class' => 'admin-gridview__btn btn-common_danger',
                                    'data' => ['confirm' => 'Are you sure you want to delete this product?'],
                                ]);
                        },
                    ],
                    'contentOptions' => ['style' => 'width: 100px; text-align: center'],
                ],
                [
                    'class' => \app\models\CheckBoxColumn::className(),
                    'headerOptions' => ['class' => 'products__checkbox-column', 'style' => 'max-width: 200px; width: 200px'],
                ],
            ],
        ]) ?>

        <?php ActiveForm::end(); ?>

        <?php Pjax::end() ?>
    </div>
  </section>
</div>
