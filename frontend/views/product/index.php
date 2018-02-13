<?php

use yii\helpers\Html;
use yii\helpers\Url;
$this->title = $model->name .' '. \Yii::t('/yii','Dance shoes');

//$this->registerJsFile(Yii::getAlias('@web') . '/js/imagezoom.js', ['depends' => [yii\web\JqueryAsset::className()]]);
//$this->registerJsFile(Yii::getAlias('@web') . '/js/jquery.flexslider.js', ['depends' => [yii\web\JqueryAsset::className()]]);
//$this->registerJsFile(Yii::getAlias('@web') . '/js/productPage.js', ['depends' => [yii\web\JqueryAsset::className()]]);
//echo '<pre>';
//print_r($model->image);
//echo '</pre>';

if($model->image)
{
	foreach($model->image as $key=>$image)
	{
		//echo $image['name'];
	}
	//echo count($model->image);
	/*for($i=0; count($model->image)>$i; $i++)
	{
		echo $model->image[$i]['name'].'<br>';
	}
	*/
}	
//echo $model['image'][0]['name'];
//$model->character here all character of this goods
//$model->image['name'] here all images 

?>
<?php if($model):?>			
<div class="showcase-grid">
            <div class="container">
                <div class="col-md-8 showcase">
                    <div class="flexslider">
						<?php if($model->image):?>
                          <ul class="slides">
						  <?php foreach($model->image as $key=>$image): ?>
                            <li data-thumb="/frontend/web/uploads/photos/1/<?php echo  $image['name'];?>">
                                <div class="thumb-image"> <img src="/frontend/web/uploads/photos/1/<?php echo $image['name'];?>" data-imagezoom="true" class="img-responsive"> </div>
                            </li>
                           
							<?php endforeach;?>
                          </ul> 
						 <?php endif; ?>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-md-4 showcase">
                    <div class="showcase-rt-top">
                        <div class="pull-left shoe-name">
                            <h3><?php echo $model->name;?></h3>
                            <p><?php echo $model['character'][0]['price'];?> грн</p>
                            <h4></h4>
                        </div>
                        <div class="pull-left rating-stars">
                            <ul>
    <li><a href="#" class="active"><span class="glyphicon glyphicon-star star-stn" aria-hidden="true"></span></a></li>
    <li><a href="#" class="active"><span class="glyphicon glyphicon-star star-stn" aria-hidden="true"></span></a></li>
    <li><a href="#" class="active"><span class="glyphicon glyphicon-star star-stn" aria-hidden="true"></span></a></li>
    <li><a href="#" class="active"><span class="glyphicon glyphicon-star star-stn" aria-hidden="true"></span></a></li>
    <li><a href="#" class="active"><span class="glyphicon glyphicon-star star-stn" aria-hidden="true"></span></a></li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <hr class="featurette-divider">
                    <div class="shocase-rt-bot">
                        <div class="float-qty-chart">
                        <ul>
							<?php if($model['character'][0]['size']):?>
							<?php $size = json_decode($model['character'][0]['size']);?>
                            <li class="qty">
                                <h3>Размер</h3>
								
                                <select class="form-control siz-chrt">
								<?php if($size):?>
                                  <?php foreach($size as $val):?>
									<option><?php echo $val;?></option>
                                  <?php endforeach;?>
								  <?php else:?>
									<option>уточните у продавца</option>
								  <?php endif;?>
                                </select>
                            </li>
							<?php endif;?>
							<?php if($model['character'][0]['color']):?>
							<?php $color = json_decode($model['character'][0]['color']);?>
                            <li class="qty">
                                <h4>Цвет</h4>
                                <select class="form-control qnty-chrt">
                                 <?php if($color):?>
                                  <?php foreach($color as $col):?>
									<option><?php echo $col;?></option>
                                  <?php endforeach;?>
								  <?php else:?>
									<option>уточните у продавца</option>
								  <?php endif;?>
                                </select>
                            </li>
							<?php endif;?>
                        </ul>
                        <div class="clearfix"></div>
                        </div>
                        <ul>
                            <li class="ad-2-crt simpleCart_shelfItem">
								<?php if($model['character'][0]['discount']):?>
                                <a class="btn item_add" href="javascript:void(0);" role="button">Действует скидка <?php echo $model['character'][0]['discount'];?> %</a>
								<a class="btn" href="javascript:void(0);" role="button"><?php echo 'Цена со скидкой '.($model['character'][0]['price']-($model['character'][0]['price']*$model['character'][0]['discount']/100));?> грн</a>
								<?php endif;?>
                               <!-- <a class="btn" href="#" role="button">Buy Now</a>-->
                            </li>
                        </ul>
                    </div>
                    <div class="showcase-last">
                        <h3>Характеристики</h3>
                        <ul>
                            <?php if($model->shortdesc):?>
								<li><?php echo $model->shortdesc;?></li>
							<?php endif;?>
							<?php if($model['character'][0]['material']):?>
								<li><?php echo $model['character'][0]['material'];?></li>
							<?php endif;?>
                            <?php if($model['character'][0]['brand']):?>
								<li><?php echo $model['character'][0]['brand'];?></li>
							<?php endif;?>
							<?php if($model['character'][0]['type']):?>
								<li><?php echo $model['character'][0]['type'];?></li>
							<?php endif;?>
                        </ul>
                    </div>
                </div>
        <div class="clearfix"></div>
            </div>
</div>
<div class="specifications">
            <div class="container">
              <h3>Детальное описание</h3> 
                <div class="detai-tabs">
                    <!-- Nav tabs -->
                    <ul class="nav nav-pills tab-nike" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Детальное описание</a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Особенности</a></li>
                    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Отзывы</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                    <?php if($model->fulldesc):?>
						<?php echo $model->fulldesc;?>
					<?php else:?>
						данных нет	
					<?php endif;?>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="profile">
                    <?php if($model->specialcharac):?>
						<?php echo $model->specialcharac;?>
					<?php else:?>
						данных нет
					<?php endif;?>  
                    </div>
                    <div role="tabpanel" class="tab-pane" id="messages">
                        ждем Ваших отзывов    
                    </div>
                    </div>
                </div>
            </div>
</div>
<div class="you-might-like">
            <div class="container">
                <h3 class="you-might">Вас может заинтересовать</h3>
                <div class="col-md-4 grid-stn simpleCart_shelfItem">
                     <!-- normal -->
                        <div class="ih-item square effect3 bottom_to_top">
                            <div class="bottom-2-top">
                    <div class="img"><img src="images/grid4.jpg" alt="/" class="img-responsive gri-wid"></div>
                            <div class="info">
                                <div class="pull-left styl-hdn">
                                    <h3>style 01</h3>
                                </div>
                                <div class="pull-right styl-price">
                                    <p><a  href="#" class="item_add"><span class="glyphicon glyphicon-shopping-cart grid-cart" aria-hidden="true"></span> <span class=" item_price">$190</span></a></p>
                                </div>
                                <div class="clearfix"></div>
                            </div></div>
                        </div>
                    <!-- end normal -->
                    <div class="quick-view">
                        <a href="single.html">Quick view</a>
                    </div>
                </div>
                <div class="col-md-4 grid-stn simpleCart_shelfItem">
                    <!-- normal -->
                        <div class="ih-item square effect3 bottom_to_top">
                            <div class="bottom-2-top">
                    <div class="img"><img src="images/grid6.jpg" alt="/" class="img-responsive gri-wid"></div>
                            <div class="info">
                                <div class="pull-left styl-hdn">
                                    <h3>style 01</h3>
                                </div>
                                <div class="pull-right styl-price">
    <p><a  href="#" class="item_add"><span class="glyphicon glyphicon-shopping-cart grid-cart" aria-hidden="true"></span> <span class=" item_price">$190</span></a></p>
                                </div>
                                <div class="clearfix"></div>
                            </div></div>
                        </div>
                    <!-- end normal -->
                    <div class="quick-view">
                        <a href="single.html">Quick view</a>
                    </div>
                </div>
                <div class="col-md-4 grid-stn simpleCart_shelfItem">
                    <!-- normal -->
                        <div class="ih-item square effect3 bottom_to_top">
                            <div class="bottom-2-top">
                    <div class="img"><img src="images/grid3.jpg" alt="/" class="img-responsive gri-wid"></div>
                            <div class="info">
                                <div class="pull-left styl-hdn">
                                    <h3>style 01</h3>
                                </div>
                                <div class="pull-right styl-price">
    <p><a  href="#" class="item_add"><span class="glyphicon glyphicon-shopping-cart grid-cart" aria-hidden="true"></span> <span class=" item_price">$190</span></a></p>
                                </div>
                                <div class="clearfix"></div>
                            </div></div>
                        </div>
                    <!-- end normal -->
                    <div class="quick-view">
                        <a href="single.html">Quick view</a>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
</div>
<?php else:?>
	<div class="you-might-like">
        <div class="container">
		 нет в наличии 
		</div>
	</div>
<?php endif;?> 