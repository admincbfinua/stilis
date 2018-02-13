<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Product'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            
            [ 'attribute' => 'menuId',
					'label' => 'category',
					'content'=>function($data)
					{
						$categ = (new \yii\db\Query())->select('name,parent_id')->from('menu')->where(['id' => $data->menuId])->one();
						if($categ)
						{
							$categ_topLevel = (new \yii\db\Query())->select('name,parent_id')->from('menu')->where(['id' => $categ['parent_id']])->one();
						}
						$_cat =($categ_topLevel) ?$categ['name'].'('.$categ_topLevel['name'].')':$data->menuId;
						return $_cat;
					}	
			],
			[ 'attribute' => 'landuage_id',
					'label' => 'language',
					'content'=>function($data)
					{
						$_lng =($data->landuage_id==1) ?'russian':'ukrainian';
						return $_lng;
					}	
			],
            
            [ 'attribute' => 'status',
					'label' => 'show in front',
					'content'=>function($data)
					{
						$_status =($data->status==1) ?'<span class="text-success">yes</span>':'<span class="text-danger">no</span>';
						return $_status;
					}	
			],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
