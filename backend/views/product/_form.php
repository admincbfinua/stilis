<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use mihaildev\ckeditor\CKEditor;
//use dosamigos\tinymce\TinyMce;


//echo '<pre>';
//print_r($model->character);
//print_r($existingPhotos);

//echo '</pre>';

$lng = ArrayHelper::map($lang,'id','name');
$menus = ArrayHelper::map($menu,'id','name');
$arrMenus = array();
if($menu)
{
	foreach($menu as $item)
	{
		$lngThis = ($item->language_id==1)?'(lng rus)':'(lng ua)';
		$arrMenus[$item->id]= $item->name . ' '.$lngThis;//$item->name . '('.($item->language_id==1)?'рус':'укр'.')';
	}
}
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
	
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

   
	<?php if($arrMenus): ?>
		<?= $form->field($model, 'menuId')->dropDownList($arrMenus) ?>
	<?php else: ?>
		 <?= $form->field($model, 'menuId')->textInput() ?>
	<?php endif;?>
    
	<?php if($lng): ?>
		<?= $form->field($model, 'landuage_id')->dropDownList($lng) ?>
	<?php else: ?>
		<?= $form->field($model, 'landuage_id')->textInput() ?>
	<?php endif;?>

    <?= $form->field($model, 'status')->DropDownList([1=>'show in front',0=>'not active(dont show in front)']) ?>

    <?= $form->field($model, 'sort')->textInput() ?>
	<?php if(isset($existingPhotos) && $existingPhotos): ?>
		<?php 
						echo  $form->field($prPhotos, 'name[]')->widget(FileInput::classname(), [
							'options'=>['accept'=>'image/*', 'multiple' => true],
							'pluginOptions' => [
								'uploadUrl' => Url::to(['/product/upload-images']),
                                'uploadAsync' => false,
								'initialPreview'=>$existingPhotos,
								'initialPreviewAsData'=>true,
								'initialCaption'=>"Uploaded photo",
								'initialPreviewConfig' => $initPrevConfAsArr,
								'overwriteInitial'=>false,
								'maxFileSize'=>2800
							],
							
						 ])->label(false); 
						?>
	<?php else:?>
		<?php echo $form->field($prPhotos, 'name[]')->widget(FileInput::classname(), [
							   'options' => ['accept'=>'image/*', 'multiple' => true],
							   'pluginOptions' => [
									'uploadUrl' => Url::to(['/product/upload-images']),
									'uploadAsync' => false,
									'allowedFileExtensions' => ['jpg'],
								   'showUpload' => true,
									'maxFileCount' => 10,                             
								],
							])->label(false) 
		?>
	<?php endif;?>
	<?= $form->field($model, 'shortdesc')->textInput() ?>
	
	<?php 
	echo $form->field($model, 'fulldesc')->widget(CKEditor::className(),[
		'editorOptions' => [
			'preset' => 'short', 
			'inline' => false, 
		],
	]);
	?>
	<?php 
	echo $form->field($model, 'specialcharac')->widget(CKEditor::className(),[
		'editorOptions' => [
			'preset' => 'short', 
			'inline' => false, 
		],
	]);
	?>
	
	<?php if(isset($prChar['color']) && $prChar['color']): ?>
		 <?php $prChar['color']=json_decode($prChar['color']);?>
	 <?= $form->field($prChar, 'color')->checkboxList(['gold'=>'gold','silver'=>'silver','white'=>'white','black'=>'black','broun'=>'broun','color mix'=>'clor mix']) ?>
	<?php else: ?>	
		<?= $form->field($prChar, 'color')->checkboxList(['gold'=>'gold','silver'=>'silver','white'=>'white','black'=>'black','broun'=>'broun','color mix'=>'clor mix']) ?>
	 <?php endif;?>
	 
	 <?php if(isset($prChar['size']) && $prChar['size']): ?>
		 <?php $prChar['size']=json_decode($prChar['size']);?>
	 <?= $form->field($prChar, 'size')->checkboxList([26=>26,27=>27,28=>28,29=>29,30=>30,36=>36,37=>37,38=>38,39=>39,40=>40,41=>41,42=>42,43=>43,44=>44,45=>45]) ?>
	<?php else: ?>	
		<?= $form->field($prChar, 'size')->checkboxList([26=>26,27=>27,28=>28,29=>29,30=>30,36=>36,37=>37,38=>38,39=>39,40=>40,41=>41,42=>42,43=>43,44=>44,45=>45]) ?>
	 <?php endif;?>
	 
	 <?= $form->field($prChar, 'price')->textInput() ?>
	 <?= $form->field($prChar, 'discount')->textInput() ?>
	 <?= $form->field($prChar, 'material')->textInput() ?>
	 <?= $form->field($prChar, 'brand')->textInput() ?>
	 <?= $form->field($prChar, 'type')->textInput() ?>
	 <?= $form->field($prChar, 'showinslider')->DropDownList([0=>'dont show',1=>'show']) ?>
	 <?= $form->field($prChar, 'twotopgoods')->DropDownList([0=>'dont show',1=>'show']) ?>
	 <?= $form->field($prChar, 'goodsonindex')->DropDownList([0=>'dont show',1=>'show']) ?>
	
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
