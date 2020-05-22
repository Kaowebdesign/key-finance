<?php

use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Html;
?>
<header class="header">
    <?php
        NavBar::begin([
            'brandImage'=>'@web/img/key_logo.svg',
            'brandUrl'=> Yii::$app->homeUrl,
            'options' => [
                'class' => 'nav navbar navbar-expand-md',
            ],
            'innerContainerOptions'=>[
                    'class'=>'nav__container'
            ]
        ]);
        $menuItems = [
            ['label' => 'Главная', 'url' => ['/site/index']],
            ['label' => 'О проекте', 'url' => ['/site/about']],
            ['label' => 'Написать нам', 'url' => ['/site/contact']],
        ];
        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'Регистрация', 'url' => ['/site/signup']];
            $menuItems[] = ['label' => 'Вход', 'url' => ['/site/login']];
        } else {
            $menuItems[] = ['label' => 'Доходы', 'url' => ['/income']];
            $menuItems[] = '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Выйти (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>';
        }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $menuItems,
        ]);
        NavBar::end();
    ?>
</header>