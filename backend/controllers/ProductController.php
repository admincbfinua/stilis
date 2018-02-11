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

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    /**
     * @inheritdoc
     */
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

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
		$lang = Language::find()->all();
		$prPhotos = new ProductImage();
		$menu = Menu::find()->where('id >:id',[':id'=>1])->all();
		$prChar = ProductCharacter::find()->all();
        if ($model->load(Yii::$app->request->post()))//$prPhotos->load(Yii::$app->request->post())
		{
            
			//echo '<pre>';print_r(Yii::$app->request->post());echo '</pre>';
			
			$model->save();
			
			
			$images = FileHelper::findFiles(Yii::$app->basePath . '/web/uploads/temp/1');
                if (!empty($images)) {
                    foreach ($images as $image) {
                        //echo '$model->id='.$model->id."<br>";
						
						$prPhotos = new ProductImage();
                        $prPhotos->productId = $model->id;
                       
                        $prPhotos->name = basename($image);
						//echo '$prPhotos->name='.$prPhotos->name;
                        if ($prPhotos->save()) {
                            // move image from temporary directory
                            $path = $prPhotos->getImageFile(1);
                            rename($image, $path);
                        }
                    }
                }
			
			
			
			return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
			'prPhotos'=>$prPhotos,
			'menu'=>$menu,
			'lang'=>$lang,
			'prChar'=>$prChar,
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
	
	public function actionUploadImages()
    {
        // get the files posted
		$pr = new Product();
        $prPhotos = new ProductImage();
		//print_r(UploadedFile::getInstances($prPhotos,'name'));
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
            FileHelper::createDirectory(Yii::$app->basePath . '/web/uploads/temp/1');
            $target = Yii::$app->basePath . '/web/uploads/temp/1/' . $src;
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
	
	
	
}
