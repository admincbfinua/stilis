<?php

namespace backend\controllers;

use Yii;
use common\models\Product;
use common\models\ProductImage;
use common\models\ProductCharacter;
use common\models\Language;
use common\models\Menu;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use yii\helpers\Url;

class ProductController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

  
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

   
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

   
    public function actionCreate()
    {
        $model = new Product();
		$lang = Language::find()->all();
		$prPhotos = new ProductImage();
		$menu = Menu::find()->where('id >:id',[':id'=>1])->all();
		//$prChar = ProductCharacter::find()->all();
		$prChar = new ProductCharacter();
        if ($model->load(Yii::$app->request->post()) && $prChar->load(Yii::$app->request->post()))
		{
            
			//echo '<pre>';print_r(Yii::$app->request->post('ProductCharacter'));echo '</pre>';
			//echo 'showinslider'.Yii::$app->request->post('showinslider');
			
			$model->save();
			
			$prChar->productId = $model->id;	
			$prChar->color = json_encode($prChar->color);
			$prChar->size = json_encode($prChar->size);
			$prChar->discount= ($prChar->discount)?$prChar->discount:0;
			
			$prChar->save();
			$images = FileHelper::findFiles(Yii::getAlias('@frontend') . '/web/uploads/temp/1');
			
                if (!empty($images)) {
                    foreach ($images as $image) {
                       
						$prPhotos = new ProductImage();
                        $prPhotos->productId = $model->id;
                        $prPhotos->name = basename($image);
					    if ($prPhotos->save()) {
                            // move image from temporary directory
                            $path = $prPhotos->getImageFile(1);
                            rename($image, $path);
                        }
                    }
                }
			
			return $this->actionIndex();
        }

        return $this->render('create', [
            'model' => $model,
			'prPhotos'=>$prPhotos,
			'menu'=>$menu,
			'lang'=>$lang,
			'prChar'=>$prChar,
        ]);
    }

  
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$lang = Language::find()->all();
		$prPhotos = new ProductImage();
		
		$_photos = ProductImage::find()->where(['productId'=>$id])->all();
		$existingPhotos = [];
		$initPrevConfAsArr =[];
		if($_photos)
		{
			foreach ($_photos as $photo)
			{
              $existingPhotos[] = Yii::$app->request->hostInfo . '/frontend/web/uploads/photos/1/'.$photo->name;
			  $initPrevConfAsArr[]= ['url' => Url::to(['/product/delete-images','key' => $photo->name]),'key' => $photo->name];
			}
		}
		$menu = Menu::find()->where('id >:id',[':id'=>1])->all();
		$prChar = ProductCharacter::find()->where(['productId'=>$id])->one();
        if ($model->load(Yii::$app->request->post()) && $prChar->load(Yii::$app->request->post())) 
		{
         	$model->save();
			$prChar->productId = $model->id;
			$prChar->color = json_encode($prChar->color);
			$prChar->size = json_encode($prChar->size);
			$prChar->discount= ($prChar->discount)?$prChar->discount:0;
			$prChar->save();
			$images = FileHelper::findFiles(Yii::getAlias('@frontend') . '/web/uploads/temp/1');
			
                if (!empty($images))
				{
                    foreach ($images as $image) {
                       
						$prPhotos = new ProductImage();
                        $prPhotos->productId = $model->id;
                        $prPhotos->name = basename($image);
					    if ($prPhotos->save()) 
						{
                            $path = $prPhotos->getImageFile(1);
                            rename($image, $path);
                        }
                    }
                }
			return $this->actionIndex();
        }

        return $this->render('update', [
            'model' => $model,
			'prPhotos'=>$prPhotos,
			'menu'=>$menu,
			'lang'=>$lang,
			'prChar'=>$prChar,
			'existingPhotos'=>$existingPhotos,
			'initPrevConfAsArr'=>$initPrevConfAsArr,
        ]);
    }

   
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
	
	public function actionUploadImages()
    {
        //echo Yii::getAlias('@frontend');die;
		// get the files posted
		$pr = new Product();
        $prPhotos = new ProductImage();
	    $images = UploadedFile::getInstances($prPhotos, 'name');
        // 'images' refers to your file input name attribute
        if (empty($images)) {
            echo json_encode(['error' => 'No files found for upload.']);
            return; // terminate
        }
        // a flag to see if everything is ok
        $success = null;
        // file paths to store
        $paths = [];
        // loop and process files
        foreach ($images as $image) {
            $imageNameParts = explode(".", $image->name);
            $extension = end($imageNameParts);
            $src = Yii::$app->security->generateRandomString().".{$extension}";
            $imageResource = imagecreatefromjpeg($image->tempName);
            $imageResource = imagerotate($imageResource, array_values([0, 0, 0, 180, 0, 0, -90, 0, 90])[@exif_read_data($image->tempName)['Orientation'] ?: 0
], 0);
            //redifined path to write image 
			FileHelper::createDirectory(Yii::getAlias('@frontend') . '/web/uploads/temp/1');
			$target = Yii::getAlias('@frontend') . '/web/uploads/temp/1/' . $src;
			
			//FileHelper::createDirectory(Yii::$app->basePath . '/web/uploads/temp/1');
            //$target = Yii::$app->basePath . '/web/uploads/temp/1/' . $src;
            if(imagejpeg($imageResource, $target)) {
                $success = true;
                $paths[] = $target;
            } else {
                $success = false;
                break;
            }
        }
        // check and process based on successful status
        if ($success === true) {
            // store a successful response (default at least an empty array). You
            // could return any additional response info you need to the plugin for
            // advanced implementations.
            $output = [];
        } elseif ($success === false) {
            $output = ['error' => 'Error while uploading images. Contact the system administrator'];
            // delete any uploaded files
            foreach ($paths as $file) {
                unlink($file);
            }
        } else {
            $output = ['error' => 'No files were processed.'];
        }
        // return a json encoded response for plugin to process successfully
        echo json_encode($output);
    }
	public function actionDeleteImages()
    {
     	$src = Yii::$app->request->post('key');
		$success = false;
		if($src)
		{
			$target = Yii::getAlias('@frontend') . '/web/uploads/photos/1/' . $src;
			if (file_exists($target)) 
			{
				unlink($target);
				$model = ProductImage::find()->where(['name' => $src])->one();
				$model->delete();
				$success = true;
				$output=['success' => 'Delete processed.'];
			}
			else
			{
				$output=['error' => 'No files '];
			}
		}
			echo json_encode($output);
    }
	public function makeimage($filename,$source,$w,$height,$fname,$big)
    {
       		 
			if(preg_match('/[.](jpg)$/', $filename)) 
			{
			  $im = imagecreatefromjpeg($source);
				 
			} 
			elseif (preg_match('/[.](gif)$/', $filename))
			{
			  $im = imagecreatefromgif($source);
			}
			elseif (preg_match('/[.](png)$/', $filename))
			{
			  $im = imagecreatefrompng($source);
			}
			else
			{
				$im = imagecreatefromjpeg($source);
			}	
			//echo Yii::getAlias('@frontimages');die;
			$ox = imagesx($im);
			$oy = imagesy($im);
			$rgb = 0xffffff; //цвет заливки несоответствия 0xFFFFFF - белый
			
			$x_ratio = $w / $ox; //пропорция ширины будущего превью
			$y_ratio = $height / $oy; //пропорция высоты будущего превью
			$ratio       = min($x_ratio, $y_ratio);
			$use_x_ratio = ($x_ratio == $ratio); //соотношения ширины к высоте
			$new_width   = $use_x_ratio  ? $w  : floor($ox * $ratio); //ширина превью 
			$new_height  = !$use_x_ratio ? $height : floor($oy * $ratio); //высота превью
			//расхождение с заданными параметрами по ширине
			$new_left    = $use_x_ratio  ? 0 : floor(($w - $new_width) / 2);
			//расхождение с заданными параметрами по высоте
			$new_top     = !$use_x_ratio ? 0 : floor(($height - $new_height) / 2);
			//создаем вспомогательное изображение пропорциональное превью
			$nm = imagecreatetruecolor($w,$height);
			imagefill($nm, 0, 0, $rgb); //заливаем его…
			imagecopyresampled($nm, $im, $new_left, $new_top, 0, 0, $new_width, $new_height, $ox, $oy); //копируем на него нашу превью с учетом расхождений       
			//imagecopyresized($nm, $im, 0, 0, 0, 0, $new_width, $new_height, $ox, $oy); //копируем на него нашу превью с учетом расхождений       
			if($big)
			{
				imagejpeg($nm, Yii::getAlias('@frontimages').'/big/'.$fname.'.jpg');
			}
			else
			{
				imagejpeg($nm, Yii::getAlias('@frontimages').'/'.$fname.'.jpg');
			}
			
    }
	
	
}
