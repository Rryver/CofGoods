<?php


use yii\helpers\Url;
use yii\widgets\Menu;


$linkTemplate = '<a class="menu__link" href="{url}">{label}</a>'
?>


<header class="header">
  <div class="header__container">
    <nav class="header__menu menu menu_pull-left">
        <?php
        echo Menu::widget([
            'options' => [
                'class' => 'menu__list',
            ],
            'itemOptions' => [
                'class' => 'menu__item',
            ],
            'linkTemplate' => $linkTemplate,
            'items' => [
                //['label' => 'Home', 'url' => ['site/index']],
                ['label' => 'Catalog', 'url' => ['admin/catalog'], 'visible' => !Yii::$app->user->isGuest],
                ['label' => 'Add new product', 'url' => ['admin/product-create'], 'visible' => !Yii::$app->user->isGuest],
            ],
            'activeCssClass' => 'menu__item_active',
        ]);
        ?>
    </nav>

    <a class="header__logo" href="<?= Url::to('site/index') ?>">CofGoods</a>

    <nav class="header__menu menu menu_pull-right">
          <?php
          echo Menu::widget([
              'options' => [
                  'class' => 'menu__list',
              ],
              'itemOptions' => [
                  'class' => 'menu__item',
              ],
              'linkTemplate' => $linkTemplate,
              'items' => [
                  Yii::$app->user->isGuest ? (
                  ['label' => 'login', 'url' => ['site/login']]
                  ) : ['label' => 'logout',
                      'url' => ['site/logout'],
                      'template' => '<a class="menu__link" href="{url}" data-method="post">{label}</a>'
                  ],
              ],
              'activeCssClass' => 'menu__item_active',
          ]);
          ?>
    </nav>
  </div>
</header>
