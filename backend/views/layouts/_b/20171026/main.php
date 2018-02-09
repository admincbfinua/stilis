<?php

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?php if (Yii::$app->user->isGuest) :?>
	<div class="wrap">
		<div class="container">
			<?= $content ?>
		</div>
	</div>
<?php else :?>


	<div class="wrap">
	<?php
		NavBar::begin([
			'brandLabel' => Yii::$app->request->hostInfo,
			'brandUrl' => Yii::$app->homeUrl,
			'options' => [
				'class' => 'navbar-inverse navbar-fixed-top',
			],
		]);
		$menuItems = [
			['label' => 'Home', 'url' => ['/site/index']],
		];
		if (Yii::$app->user->isGuest) {
			$menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
		} else {
			$menuItems[] = '<li>'
				. Html::beginForm(['/site/logout'], 'post')
				. Html::submitButton(
					'Logout (' . Yii::$app->user->identity->username . ')',
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
		<div class="container">
		  <div class="row">
			<!-- left sidebar -->
			<div class="col-md-4">
				<ul class="nav nav-pills nav-stacked">
				  <li role="presentation" class="active"><a href="#">Home</a></li>
				  <li role="presentation"><a href="#">Profile</a></li>
				  <li role="presentation"><a href="#">Messages</a></li>
				</ul>
			</div>
			<!-- end left sidebar -->
			
			<!-- right sidebar-central -->
			<div class="col-md-8">
				<!-- page content -->
				<div class="container">
					<?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],]) ?>
					<?= Alert::widget() ?>
					<?= $content ?>
				</div>
				<!-- /page content -->
			</div>
			<!-- end right sidebar-central -->
		  </div>
		</div>
		
		
	</div>	
	<footer class="footer">
		<div class="container">
			<p class="pull-left">&copy; My Company <?= Yii::$app->request->hostInfo; ?></p>

			<p class="pull-right"><?= Yii::powered() ?></p>
		</div>
	</footer>
<?php endif;?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
