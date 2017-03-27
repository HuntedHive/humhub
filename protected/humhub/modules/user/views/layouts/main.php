<?php

use yii\helpers\Html;
use humhub\assets\AppAsset;
use humhub\models\Setting;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- start: Meta -->
        <meta charset="utf-8">
        <title><?php echo Html::encode($this->pageTitle); ?></title>
        <!-- end: Meta -->

        <!-- start: Mobile Specific -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <!-- end: Mobile Specific -->
        <?= Html::csrfMetaTags() ?>
        <?php $this->head() ?>

        <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="<?php echo Yii::getAlias("@web"); ?>/js/html5shiv.js"></script>
        <link id="ie-style" href="<?php echo Yii::getAlias("@web"); ?>/css/ie.css" rel="stylesheet">
        <![endif]-->

        <!--[if IE 9]>
        <link id="ie9style" href="<?php echo Yii::getAlias("@web"); ?>/css/ie9.css" rel="stylesheet">
        <![endif]-->

        <!-- start: render additional head (css and js files) -->
        <?php echo $this->render('@humhub/views/layouts/head'); ?>
        <!-- end: render additional head -->

        <!-- start: Favicon and Touch Icons -->
        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo Yii::getAlias("@web"); ?>/ico/apple-touch-icon-57x57.png?v=47rn3AYd0y">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo Yii::getAlias("@web"); ?>/ico/apple-touch-icon-60x60.png?v=47rn3AYd0y">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo Yii::getAlias("@web"); ?>/ico/apple-touch-icon-72x72.png?v=47rn3AYd0y">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo Yii::getAlias("@web"); ?>/ico/apple-touch-icon-76x76.png?v=47rn3AYd0y">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo Yii::getAlias("@web"); ?>/ico/apple-touch-icon-114x114.png?v=47rn3AYd0y">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo Yii::getAlias("@web"); ?>/ico/apple-touch-icon-120x120.png?v=47rn3AYd0y">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo Yii::getAlias("@web"); ?>/ico/apple-touch-icon-144x144.png?v=47rn3AYd0y">
        <link rel="apple-touch-icon" sizes="152x152" href="/<?php echo Yii::getAlias("@web"); ?>ico/apple-touch-icon-152x152.png?v=47rn3AYd0y">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo Yii::getAlias("@web"); ?>/ico/apple-touch-icon-180x180.png?v=47rn3AYd0y">
        <link rel="icon" type="image/png" href="<?php echo Yii::getAlias("@web"); ?>/ico/favicon-32x32.png?v=47rn3AYd0y" sizes="32x32">
        <link rel="icon" type="image/png" href="<?php echo Yii::getAlias("@web"); ?>/ico/android-chrome-192x192.png?v=47rn3AYd0y" sizes="192x192">
        <link rel="icon" type="image/png" href="<?php echo Yii::getAlias("@web"); ?>/ico/favicon-16x16.png?v=47rn3AYd0y" sizes="16x16">
        <link rel="manifest" href="<?php echo Yii::getAlias("@web"); ?>/ico/manifest.json?v=47rn3AYd0y">
        <link rel="mask-icon" href="<?php echo Yii::getAlias("@web"); ?>/ico/safari-pinned-tab.svg?v=47rn3AYd0y" color="#5bbad5">
        <link rel="shortcut icon" href="<?php echo Yii::getAlias("@web"); ?>/ico/favicon.ico?v=47rn3AYd0y">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="msapplication-TileImage" content="<?php echo Yii::getAlias("@web"); ?>/ico/mstile-144x144.png?v=47rn3AYd0y">
        <meta name="msapplication-config" content="<?php echo Yii::getAlias("@web"); ?>/ico/browserconfig.xml?v=47rn3AYd0y">
        <meta name="theme-color" content="#ffffff">
        <meta charset="<?= Yii::$app->charset ?>">
        <!-- end: Favicon and Touch Icons -->

    </head>

    <body class="login-container">
        <?php $this->beginBody() ?>

        <!-- start: show content (and check, if exists a sublayout -->
        <?php if (isset($this->subLayout) && $this->subLayout != "") : ?>
            <?php echo $this->renderPartial($this->subLayout, array('content' => $content)); ?>
        <?php else: ?>
            <?php echo $content; ?>
        <?php endif; ?>
        <!-- end: show content -->

        <script type="text/javascript">
            // Replace the standard checkbox and radio buttons
            $('body').find(':checkbox, :radio').flatelements();
        </script>

        <?php echo Setting::GetText('trackingHtmlCode'); ?>
        <?php $this->endBody() ?>
        <div class="text text-center powered">
            Powered by <a href="http://www.humhub.org" target="_blank">HumHub</a>
        </div>
    </body>

</html>
<?php $this->endPage() ?>
