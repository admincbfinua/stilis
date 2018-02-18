<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\Product;
use common\models\ProductImage;
use common\models\ProductCharacter;
use common\models\Language;
use common\models\Menu;
use common\models\Lang;

/**
 * Site controller
 */
class ProductController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

   
    public function actionIndex($id)
    {
        $model='';
		$prCharPrIndex=array();
		if((int) $id>0)
		{	
			$model = Product::find()->where(['id'=>(int) $id])->one();
		}
		$lang = Lang::getCurrent()->id;
		$q = Product::find()->where(['status' => 1,'landuage_id'=>$lang])->andwhere('product.id!=:id',['id'=>$id])->joinWith(['character', 'image'])->indexBy('id')->orderBy(['sort'=>SORT_ASC])->limit(3)->all();
		//echo '<pre>';
		//print_r($q);
		//echo '</pre>';
		if($q)
	    {
			foreach($q as $key)
			{
					$prCharPrIndex[$key['id']]=array('id'=>$key['id'],'image'=>$key['image'][0]['name'],'name'=>$key['name'],'price'=>$key['character'][0]['price']);
				
			}
	    }
		return $this->render('index',[ 'model' => $model,'prCharPrIndex'=>$prCharPrIndex,]);
    }
	public function actionProducts($id)
    {
        $prCharCatIndex=array();
		$menu=array();
		$lang = Lang::getCurrent()->id;
		
		if((int) $id > 0)
		{
			$menu = Menu::find('name')->where(['id'=>$id,'language_id'=>$lang])->one();
			$q = Product::find()->where(['status' => 1,'landuage_id'=>$lang,'menuId'=>$id])->joinWith(['character', 'image'])->indexBy('id')->orderBy(['sort'=>SORT_ASC])->all();
		}
		/*echo '<pre>';
		print_r($q);
		echo '</pre>';
		*/
		if($q)
	    {
			foreach($q as $key)
			{
					$prCharCatIndex[$key['id']]=array('id'=>$key['id'],'image'=>$key['image'][0]['name'],'name'=>$key['name'],'price'=>$key['character'][0]['price'],'disc'=>$key['character'][0]['discount']);
				
			}
	    }
		return $this->render('products',['prCharCatIndex'=>$prCharCatIndex,'menu'=>$menu]);
    }
    
}
