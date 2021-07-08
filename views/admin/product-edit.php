<?php

/**
 * @var $this \yii\web\View
 * @var $product \app\models\Product
 * @var $image \app\models\Image
 */


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Sku;
use app\models\ProductType;


$isEditMode = isset($product->id) ? true : false;
$this->title = $isEditMode ? 'Edit product' : 'New product';
?>


<div class="admin-product-edit">
  <div class="container">
    <h3 class="font-heading-1"><?= $this->title ?></h3>
    <h3 class="font-heading-2"><?= $product->title ?></h3>


      <?php $form = ActiveForm::begin([
          'options' => ['class' => 'product-editor__form-product form-product'],
      ]); ?>

      <?= $form->field($product, 'title')
          ->textInput([/*'class' => 'form-product__input',*/ 'placeholder' => 'Product name'])
          ->label($product->attributeLabels()['title']/*, ['class' => 'form-product__label']*/) ?>

      <?= $form->field($product, 'sku_id')->dropDownList(Sku::getAllAsMap()/*, ['class' => 'form-product__input']*/) ?>

      <?= $form->field($product, 'type_id')->dropDownList(ProductType::getAllAsMap()) ?>

      <?= $form->field($product, 'count')->input('number') ?>

      <?= $form->field($image, 'imageFile')->fileInput() ?>

      <?= Html::submitButton('Save', ['class' => 'btn-common form-product__btn']) ?>
      <?php ActiveForm::end(); ?>
  </div>
</div>
