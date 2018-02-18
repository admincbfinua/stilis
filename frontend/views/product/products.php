<?php

use yii\helpers\Html;
use yii\helpers\Url;
if($menu)
{
	$this->params['breadcrumbs'][] = $menu->name;
	$this->title = $menu->name .' '.\Yii::t('/yii','Dance shoes');
}
else
{
	$this->title = 'Купить '.\Yii::t('/yii','Dance shoes');
}
?>
			
<div class="products-gallery">
           <div class="container">
               <div class="col-md-9 grid-gallery">
                    <?php if($prCharCatIndex):?>
						<?php foreach($prCharCatIndex as $prId):?>
						<div class="col-md-4 grid-stn simpleCart_shelfItem">
							 <!-- normal -->
								<div class="ih-item square effect3 bottom_to_top">
									<div class="bottom-2-top">
										<div class="img"><img src="<?php echo Yii::$app->request->hostInfo . '/frontend/web/uploads/photos/1/'.$prId['image'];?>" alt="<?php echo $prId['name'];?>" class="img-responsive gri-wid" width="300" height="200">
										</div>
										<div class="info">
											
											<div class="pull-left styl-hdn">
												<h4><?php echo $prId['name'];?></h4>
											</div>
											<div class="pull-right styl-price">
												<p><a  href="javascript:void(0);" class="item_add"><span class="glyphicon grid-cart" aria-hidden="true"></span> <span class="text-danger"> <?php if($prId['disc']){echo '-'.$prId['disc'].'%OFF';}?></span></a></p>
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
				
				
               <div class="col-md-3 grid-details">
                    <div class="grid-addon">
                        <section  class="sky-form">
					 <div class="product_right">
						 <h4 class="m_2"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>Categories</h4>
						 <div class="tab1">
							 <ul class="place">								
								 <li class="sort">Shoes</li>
								 <li class="by"><img src="images/do.png" alt=""></li>
									<div class="clearfix"> </div>
							  </ul>
							 <div class="single-bottom">						
									<a href="#"><p>Running</p></a>
									<a href="#"><p>Foot ball</p></a>
									<a href="#"><p>Daily</p></a>
									<a href="#"><p>Sneakers</p></a>
						     </div>
					      </div>						  
						  <div class="tab2">
							 <ul class="place">								
								 <li class="sort">Clothing</li>
								 <li class="by"><img src="images/do.png" alt=""></li>
									<div class="clearfix"> </div>
							  </ul>
							 <div class="single-bottom">						
									<a href="#"><p>Tracks</p></a>
									<a href="#"><p>Tees</p></a>
									<a href="#"><p>Hair bands</p></a>
									<a href="#"><p>Wrist bands</p></a>
						     </div>
					      </div>
						  <div class="tab3">
							 <ul class="place">								
								 <li class="sort">Gear</li>
								 <li class="by"><img src="images/do.png" alt=""></li>
									<div class="clearfix"> </div>
							  </ul>
							 <div class="single-bottom">						
									<a href="#"><p>Running app</p></a>
									<a href="#"><p>Training club</p></a>
									<a href="#"><p>Nike Fuel+Band se</p></a>
						     </div>
					      </div>						  
							 
				 </section>
				 <section  class="sky-form">
					 <h4><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>DISCOUNTS</h4>
					 <div class="row row1 scroll-pane">
						 <div class="col col-4">
								<label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>Upto - 10% (20)</label>
						 </div>
						 <div class="col col-4">
								<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>40% - 50% (5)</label>
								<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>30% - 20% (7)</label>
								<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>10% - 5% (2)</label>
								<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Other(50)</label>
						 </div>
					 </div>
				 </section> 				 
				   <!---->
					 
					
					<section  class="sky-form">
						<h4><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>Type</h4>
							<div class="row row1 scroll-pane">
								<div class="col col-4">
<label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>Air Max (30)</label>
								</div>
								<div class="col col-4">
<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Armagadon   (30)</label>
<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Helium (30)</label>
<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Kyron     (30)</label>
<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Napolean  (30)</label>
<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Foot Rock   (30)</label>
<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Radiated  (30)</label>
<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Spiked  (30)</label>
								</div>
							</div>
				   </section>
				 <section  class="sky-form">
						<h4><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>Brand</h4>
							<div class="row row1 scroll-pane">
								<div class="col col-4">
									<label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>Roadstar</label>
								</div>
								<div class="col col-4">
									<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Tornado</label>
									<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Kissan</label>
									<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Oakley</label>
									<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Manga</label>
									<label class="checkbox"><input type="checkbox" name="checkbox" ><i></i>Wega</label>
									<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Kings</label>
									<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Zumba</label>
								</div>
							</div>
				   </section>		
                    </div>
               </div>
            <div class="clearfix"></div>
            </div> 
        </div>