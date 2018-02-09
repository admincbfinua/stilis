<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\Menu */
/* @var $form yii\widgets\ActiveForm */
$lng = ArrayHelper::map($lang,'id','name');
$parents = ArrayHelper::map($parent,'id','name');
//print_r($parents); 
?>

<div class="menu-form">

    <?php $form = ActiveForm::begin(); ?>
	
	<?php if($parents): ?>
		<?= $form->field($model, 'parent_id')->dropDownList($parents) ?>
	<?php else :?>
		<?= $form->field($model, 'parent_id')->textInput() ?>
	<?php endif; ?>
	
	<?php if($lng): ?>
		<?= $form->field($model, 'language_id')->dropDownList($lng) ?>
	<?php else: ?>
		<?= $form->field($model, 'language_id')->textInput() ?>
	<?php endif;?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <?= $form->field($model, 'route_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->DropDownList([1=>'Видим на сайте',0=>'Не видим на сайте']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
