<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "productImage".
 *
 * @property int $id
 * @property int $name
 * @property int $productId
 *
 * @property Product $product
 */
class ProductImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'productImage';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['productId'], 'required'],
            [['productId'], 'integer'],
			[['name'], 'string'],
            [['productId'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['productId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'productId' => 'Product ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'productId']);
    }
	
	public function getImageFile($dirId)
    {
        $pathToPhotos = Yii::getAlias('@frontend') . '/web/uploads/photos/' . $dirId;
        if (!is_dir($pathToPhotos)) {
            FileHelper::createDirectory(Yii::getAlias('@frontend') . '/web/uploads/photos/' . $dirId);
        }
        return isset($this->name) ? $pathToPhotos . '/' . $this->name : null;
    }

    /**
     * Process upload of image
     */
    public function uploadImage($image)
    {
        if (empty($image)) {
            return false;
        }
        $imageNameParts = explode(".", $image->name);
        $extension = end($imageNameParts);
        $this->name = Yii::$app->security->generateRandomString().".{$extension}";

        $imageResource = imagecreatefromjpeg($image->tempName);
        $imageResource = imagerotate($imageResource, array_values([0, 0, 0, 180, 0, 0, -90, 0, 90])[@exif_read_data($image->tempName)['Orientation'] ?: 0], 0);

        return $imageResource;
    }
	
}
