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
		if((int) $id>0)
		{	
			$model = Product::find()->where(['id'=>(int) $id])->one();
		}
		//$lang = Language::find()->all();
		//$prPhotos = new ProductImage();
		//$prChar = ProductCharacter::find()->all();
		return $this->render('index',[ 'model' => $model,]);
    }
	public function actionProducts()
    {
        return $this->render('products');
    }
    
}
