<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use mihaildev\ckeditor\CKEditor;
use dosamigos\tinymce\TinyMce;


echo '<pre>';
print_r($model->character);
echo '</pre>';

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

	<?php /*echo $form->field($prPhotos, 'name[]')->widget(FileInput::classname(), [
                           'options' => ['accept'=>'image/*', 'multiple' => true],
                           'pluginOptions' => [
                                'uploadUrl' => Url::to(['/product/upload-images']),
                                'uploadAsync' => false,
                                'allowedFileExtensions' => ['jpg'],
                               'showUpload' => true,
                                'maxFileCount' => 10,                             
                               
                            ],
                           
                        ])->label(false) 
			*/
			
	?>
	
	<?= Html::label('Short description', 'Shortdesc', ['style' => 'width:100%']) ?>
	<?= Html::input('text', 'dop1', '', ['class' => '']) ?>
	<?= Html::label('Full description', 'Fulldesc', ['style' => 'width:100%']) ?>
	<?php 
	/*echo $form->field($prChar, 'fulldesc')->widget(CKEditor::className(),[
		'editorOptions' => [
			'preset' => 'full', 
			'inline' => false, 
		],
	]);
	*/
	?>
	<?php 
	/*echo $form->field($model->character, 'fulldesc')->widget(TinyMce::className(), [
    'options' => ['rows' => 6],
    'language' => 'es',
    'clientOptions' => [
        'plugins' => [
            "advlist autolink lists link charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
        ],
        'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    ]
]);
*/
?>
	<?//= Html::input('text', 'fulldesc', '', ['class' => '']) ?>
	<?= Html::label('Product specaility', 'Specaility', ['style' => 'width:100%']) ?>
	<?= Html::input('text', 'special', '', ['class' => '']) ?>
	<?= Html::label('Select or multi select product color', 'Productcolor', ['style' => 'width:100%']) ?>
	<?= Html::checkboxList('color', '', ['gold'=>'gold','silver'=>'silver','white'=>'white','black'=>'black','broun'=>'broun','color mix'=>'clor mix']) ?>	
	<?= Html::label('Select or multi select product size', 'Productsize', ['class' => '']) ?>
	<?= Html::checkboxList('size', '',[26=>26,27=>27,28=>28,29=>29,30=>30,36=>36,37=>37,38=>38,39=>39,40=>40,41=>41,42=>42,43=>43,44=>44,45=>45]) ?>
	<?= Html::label('Input product price(grn)', 'Productprice', ['style' => 'width:100%']) ?>
	<?= Html::input('text', 'price', '', ['class' => '']) ?>
	<?= Html::label('Input product discount(%), if it need', 'Productdiscount', ['style' => 'width:100%']) ?>
	<?= Html::input('text', 'discount', '', ['class' => '']) ?>
	<?= Html::label('Input product material, if it need', 'Productmaterial', ['style' => 'width:100%']) ?>
	<?= Html::input('text', 'material', '', ['class' => '']) ?>
	<?= Html::label('Input product brand, if it need', 'Productmaterial', ['style' => 'width:100%']) ?>
	<?= Html::input('text', 'brand', '', ['class' => '']) ?>
	<?= Html::label('Input product type, if it need', 'Productmaterial', ['style' => 'width:100%']) ?>
	<?= Html::input('text', 'type', '', ['class' => '']) ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
