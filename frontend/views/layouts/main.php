<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;
use frontend\widgets\WLang;
use common\models\Lang;

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

	<?php $menus = new \frontend\components\GetMenuRecurs(); $menu = $menus->getMenu();?>
		
		<div class="header">
            <div class="container">
                <div class="header-top">
                    <div class="logo">
                        <a href="/">Stilis</a>
                    </div>
                    <div class="login-bars">
							<?= WLang::widget();?>
							
							<a class="btn btn-default log-bar" href="<?php echo Url::to(['/site/contact']);?>" role="button"><?php echo \Yii::t('/yii','Contacts');?></a>
						<?php if(Yii::$app->user->isGuest):?>
							<!--<a class="btn btn-default log-bar" href="<?php //echo Url::to(['/site/signup']);?>" role="button"><?php //echo \Yii::t('/yii','Signup');?></a>-->
							<a class="btn btn-default log-bar" href="<?php echo Url::to(['/site/login']);?>" role="button"><?php echo \Yii::t('/yii','Login');?></a>
						<?php else:?>
							<?= Html::beginForm(['/site/logout', 'id' => $id], 'post') ?>
							<?= Html::submitButton('Logout (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link log-bar']) ?>
							<?= Html::endForm() ?>
						<?php endif; ?>
                       
                    </div>
        <div class="clearfix"></div>
                </div>
                <!---menu-----bar--->
                <div class="header-botom">
                    <div class="content white">
                    <nav class="navbar navbar-default nav-menu" role="navigation">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="clearfix"></div>
                        <!--/.navbar-header-->
						
						<!-- new menu -->
						<?php if($menu):?>
						  <div class="collapse navbar-collapse collapse-pdng" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav nav-font">
								<?php $_imgArr = array(1=>array('yW2PBpEyL035PUwjU2cI0jDCYZd2V-L4.JPG','VZ0TbYQIgYsBKiSFQ06ER_g5Si4a1zQL.JPG'),
													   2=>array('2FensmQGnP1NeqPW6coeA9inz1fzbL5T.JPG','I5uaqAcjfbCU7rELvGAudW26gL1TeQ1I.JPG'),
													   3=>array('JVAqlcp-dhl3pg8gZYFAbfmXo0fMMSfi.JPG','WCB0Ir-F8JKH-lEgqNDd3FHQox4qTZHL.JPG'),
													   4=>array('6F_SpeRVe23cOkFXPTlBQAsXAaTrXV7l.JPG','ZVMHVJTlPrd7-dTOseeP-B3Ol6tFJT-h.JPG'),
													   5=>array('6wM269gTdMXObQCV1E-7dinvtqS_IEoB.JPG','X-AHB6f0y2ODLA-ggJqcYL2K0oh3vZhd.JPG'),
								); ?>
								<?php foreach ($menu as $item) :?>
									
								<?php if (count($item->childs)):?>
								<?php $j=0;?>
								<?php foreach ($item->childs as $child) :?>
								
								<?php if ($child->language_id == Lang::getCurrent()->id):?>
								<li class="dropdown">
									
									<a href="<?php echo($child->route_url)? Url::to([$child->route_url]): null; ?>" class="<?php if (count($child->childs)):?>dropdown-toggle<?php endif;?>" <?php if (count($child->childs)):?>data-toggle="dropdown"<?php endif;?>><?php echo $child->name;?> <?php if (count($child->childs)):?><b class="caret"></b><?php endif;?></a>
									<?php if (count($child->childs)):?>
 									<ul class="dropdown-menu multi-column columns-3">
                                        <div class="row">
										
                                            <div class="col-sm-4 menu-img-pad">
                                                <ul class="multi-column-dropdown">
												<?php foreach ($child->childs as $sec_child) :?>
													<li><a href="<?php echo($child->route_url)? Url::to(['/'.Lang::getCurrent()->url.$sec_child->route_url,'id'=>$sec_child->id]): null; ?>"><?php echo $sec_child->name;?></a></li>
                                                   <!-- <li class="divider"></li>-->
                                                   
                                                <?php endforeach; ?>   
                                                </ul>
                                            </div>
											
                                            <div class="col-sm-4 menu-img-pad">
											<?php //echo '$j='.$j;?>
												<a href="/"><img src="<?php echo Yii::$app->request->hostInfo; ?>/frontend/web/uploads/photos/1/<?php if(isset($_imgArr[$j][0])){echo $_imgArr[$j][0];}?>" alt="" class="img-rsponsive men-img-wid" /></a>
                                            </div>
                                            <div class="col-sm-4 menu-img-pad">
												<a href="/"><img src="<?php echo Yii::$app->request->hostInfo; ?>/frontend/web/uploads/photos/1/<?php if(isset($_imgArr[$j][1])){echo $_imgArr[$j][1];}?>" alt="" class="img-rsponsive men-img-wid" /></a>
                                            </div>
											
                                        </div>
										<?php endif;?>	
                                    </ul>
									
												
								</li>
								<?php endif;?>
								<?php $j++;?>
								<?php endforeach; ?>
								<?php endif;?>
							<?php endforeach; ?>
							</ul>
							<div class="clearfix"></div>
						</div>
					<?php endif;?>
						<!-- end new menu -->
						
						
						
						
						
						
						<!-- origin -->
						<?php if(false):?>
                        <div class="collapse navbar-collapse collapse-pdng" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav nav-font">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Новинки<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo Url::to(['/product/products','category'=>100]);?>">Женская</a></li>
                                        <li class="divider"></li>
                                        <li><a href="<?php echo Url::to(['/product/products','category'=>100]);?>">Мужская</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Женская<b class="caret"></b></a>
                                    <ul class="dropdown-menu multi-column columns-3">
                                        <div class="row">
                                            <div class="col-sm-4 menu-img-pad">
                                                <ul class="multi-column-dropdown">
                                                    <li><a href="<?php echo Url::to(['/product/products','category'=>100]);?>">Латина</a></li>
                                                    <li><a href="<?php echo Url::to(['/product/products','category'=>100]);?>">Стандарт</a></li>
                                                    <li class="divider"></li>
                                                    <li><a href="<?php echo Url::to(['/product/products','category'=>100]);?>">Практика</a></li>
                                                    
                                                </ul>
                                            </div>
                                            <div class="col-sm-4 menu-img-pad">
                        <a href="#"><img src="images/menu1.jpg" alt="/" class="img-rsponsive men-img-wid" /></a>
                                            </div>
                                            <div class="col-sm-4 menu-img-pad">
                        <a href="#"><img src="images/menu2.jpg" alt="/" class="img-rsponsive men-img-wid" /></a>
                                            </div>
                                        </div>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Мужская<b class="caret"></b></a>
                                    <ul class="dropdown-menu multi-column columns-2">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <ul class="multi-column-dropdown">
                                                    <li><a href="<?php echo Url::to(['/product/products','category'=>100]);?>">Латина</a></li>
                                                    <li><a href="<?php echo Url::to(['/product/products','category'=>100]);?>">Стандарт</a></li>
                                                    <li class="divider"></li>
                                                    <li><a href="<?php echo Url::to(['/product/products','category'=>100]);?>">Практика</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-6">
                        <a href="#"><img src="images/menu3.jpg" alt="/" class="img-rsponsive men-img-wid" /></a>
                                            </div>
                                        </div>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Детская<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo Url::to(['/product/products','category'=>100]);?>">Стандарт</a></li>
                                       
                                    </ul>
                                </li>
                                <li><a href="<?php echo Url::to(['/site/contact']);?>"><?php echo \Yii::t('/yii','Contacts');?></a></li>
                                <div class="clearfix"></div>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
						<?php endif;?>
						<!-- end origin -->
						
						
						
						
						
						
                        <!--/.navbar-collapse-->
                        <div class="clearfix"></div>
                    </nav>
                    <!--/.navbar-->   
                        <div class="clearfix"></div>
                    </div>
                    <!--/.content--->
                </div>
                    <!--header-bottom-->
            </div>
        </div>
		<div class="container">
		 <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
		<?= Alert::widget() ?>
		</div>
		<!--  main content goes here -->
		<?= $content ?>
		
		<!-- footer -->
		<?php $menuFooter = $menus->getFooter();?>
        <div class="footer-grid">
            <div class="container">
                <div class="col-md-2 re-ft-grd">
				<?php if($menuFooter):?>
                    <h3>Categories</h3>
                    <ul class="categories">
					<?php foreach ($menuFooter as $item) :?>
						<?php $_arrFoot =array(); ?>
						<?php if ($item->language_id == Lang::getCurrent()->id):?>
							<li><a href="<?php echo($item->route_url)? Url::to(['/'.Lang::getCurrent()->url.$item->route_url,'id'=>$item->id]): null; ?>">
							<?php if($item->childs)
							{
								$_arrFoot = explode('/',$item->childs);
								if(isset($_arrFoot[0]) && isset($_arrFoot[1]))
								{
									echo $_arrFoot[0].' '.$_arrFoot[1];
								}
							}; ?>
							</a></li>
					    <?php endif;?>
					<?php endforeach; ?>	
                    </ul>
					<?php endif;?>
                </div>
                <div class="col-md-2 re-ft-grd">
                    <h3>Short links</h3>
                    <ul class="shot-links">
                        <li><a href="<?php echo Url::to(['/site/contact']);?>"><?php echo \Yii::t('/yii','Contacts');?></a></li>
                        <li><a href="<?php echo Url::to(['/site/about']);?>"><?php echo \Yii::t('/yii','About');?></a></li>
                        <li><a href="/"><?php echo \Yii::t('/yii','Delivery');?></a></li>
                        <li><a href="/"><?php echo \Yii::t('/yii','Return Policy');?></a></li>
                        <li><a href="/"><?php echo \Yii::t('/yii','Terms & conditions');?></a></li>
                        <li><a href="/"><?php echo \Yii::t('/yii','Sitemap');?></a></li>
                    </ul>
                </div>
                <div class="col-md-6 re-ft-grd">
                    <h3>On map</h3>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d171337.31696603037!2d35.035271697973464!3d47.856143803937655!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40d1d9c87be1cfb1%3A0x428c5fd38ffb8591!2sIntourist+hotel!5e0!3m2!1sru!2sua!4v1519736095886" width="550" height="200" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
                <div class="col-md-2 re-ft-grd">
                     <h3>Pnone</h3>
					 <h4>0958222183</h4>
					 <h3>Email</h3>
					 <h4>admin@stilis.com.ua</h4>
                </div>
        <div class="clearfix"></div>
            </div>
            <div class="copy-rt">
                <div class="container">
            <p>&copy;   2015  Dance showes. Powered by <a href="mailto:mischenkoa@ukr.net">mischenko@ukr.net</a></p>
                </div>
            </div>
        </div>
		<!-- end footer -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
