<?php

use yii\helpers\Html;
use yii\helpers\Url;
$this->title = \Yii::t('/yii','Dance shoes');
/*echo '<pre>';
print_r($prCharSlider);
echo '</pre>';
die;
*/
?>
<?php if($model):?>
<?php $data_slide=0;$act_slide=0;$_top=0;?>
<div class="header-end">
            <div class="container">
				
                <div style="height:600px !important;" id="myCarousel" class="carousel slide" data-ride="carousel">
                  
				  <?php if($prCharSlider):?>
				  <?php $count_Sliders=count($prCharSlider);?>
				  <!-- Indicators -->
                  <ol class="carousel-indicators">
				  <?php for($data_slide=0;$count_Sliders>$data_slide;$data_slide++):?>
                    <li data-target="#myCarousel" data-slide-to="<?php echo $data_slide;?>" <?php if($data_slide==0):?>class="active" <?php endif;?>></li>
                  <?php endfor;?>	
                  </ol>

                  <!-- Wrapper for slides -->
                  <div class="carousel-inner" role="listbox">
				    <?php foreach($prCharSlider as $prId):?>
					<?php $_act =($act_slide==0)?'item active':'item'; ?>
				  
                    <div class="<?php echo $_act;?>">
                        <a href="<?php echo Url::to(['/product/index','id'=>$prId['id']]);?>"><img src="<?php echo Yii::$app->request->hostInfo . '/frontend/web/uploads/photos/1/'.$prId['image'];?>" alt="<?php echo $prId['name'];?>" width="650" height="408"></a>
                        <div class="carousel-caption car-re-posn">
                            <h3></h3>
                            <h4><?php echo $prId['name'];?></h4>
                            <span class="color-bar"></span>
                        </div>
                    </div>
                    
					
						<?php $act_slide++;?>
					  <?php endforeach;?>
                  </div>

                  <!-- Controls -->
                  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left car-icn" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right car-icn" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
				  <?php endif;?>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
		
		
		<?php if($prCharTop):?>
		<?php $count_top=count($prCharTop);?>
        <div class="feel-fall">
            <div class="container">
				<?php foreach($prCharTop as $prId):?>
				<?php if($_top<2):?>
				<?php $_top_class =($_top==0)?'pull-left fal-box':'pull-right fel-box'; ?>
				<?php $_top_class1 =($_top==0)?'fall-left':'feel-right'; ?>
				<?php $_top_class2 =($_top==0)?'fel-fal-bar':'fel-fal-bar2'; ?>
                <div class="<?php echo $_top_class;?>">
                    <div class="<?php echo $_top_class1;?>">
                        <h3><?php echo $prId['name'];?></h3>
                        <a href="<?php echo Url::to(['/product/index','id'=>$prId['id']]);?>"><img src="<?php echo Yii::$app->request->hostInfo . '/frontend/web/uploads/photos/1/'.$prId['image'];?>" alt="<?php echo $prId['name'];?>" class="img-responsive fl-img-wid" width="300" height="400"></a>
                        <p><?php echo $prId['shortdesc'];?></p>
                        <span class="<?php echo $_top_class2;?>"></span>
                    </div>
                </div>
				<?php $_top++;?>
				<?php endif;?>
				<?php endforeach;?>
               
            <div class="clearfix"></div>
            </div>
        </div>
		 <?php endif;?>
        <div class="shop-grid">
            <div class="container">
				<?php if($prCharIndex):?>
				<?php foreach($prCharIndex as $prId):?>
					<div class="col-md-4 grid-stn simpleCart_shelfItem">
						 <!-- normal -->
							<div class="ih-item square effect3 bottom_to_top">
								<div class="bottom-2-top">
									<div class="img"><img src="<?php echo Yii::$app->request->hostInfo . '/frontend/web/uploads/photos/1/'.$prId['image'];?>" alt="<?php echo $prId['name'];?>" class="img-responsive gri-wid" width="300" height="200">
									</div>
									<div class="info">
										<div class="pull-left styl-hdn">
											<h3><?php echo $prId['name'];?></h3>
										</div>
										<div class="pull-right styl-price">
											<p><a  href="javascript:void(0);" class="item_add"><span class="glyphicon grid-cart" aria-hidden="true"></span> <span class=" item_price">грн <?php echo $prId['price'];?></span></a></p>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						<!-- end normal -->
						<div class="quick-view">
							<a href="<?php echo Url::to(['/product/index','id'=>$prId['id']]);?>"><?php echo \Yii::t('/yii','Quick view');?></a>
						</div>
					</div>
				<?php endforeach;?>
				<?php endif;?>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="sub-news">
            <div class="container">
                <form>
                    <h3>NewsLetter</h3>
                <input type="text" class="sub-email" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}">
                <a class="btn btn-default subs-btn" href="#" role="button">SUBSCRIBE</a>
                </form>
            </div>
        </div>
<?php else:?>
nothing add		
<?php endif;?>		