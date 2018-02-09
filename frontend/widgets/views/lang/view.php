<?php use yii\helpers\Html; ?>
<div style="margin-left:20px;" class="btn-group">
	<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $current->name;?> <span class="caret"></span></button>
	<ul class="dropdown-menu">
	   <?php foreach ($langs as $lang):?><li><?php echo Html::a($lang->name, '/'.$lang->url. (new \frontend\components\LangRequest())->getLangUrl()); ?></li><?php endforeach;?>
	</ul>
</div>