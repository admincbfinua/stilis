<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "productCharacter".
 *
 * @property int $id
 * @property int $productId
 * @property string $color
 * @property string $size
 * @property string $material
 * @property string $brand
 * @property string $type
 * @property double $price
 * @property int $discount
 * @property string $dop1
 *
 * @property Product $product
 */
class ProductCharacter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'productCharacter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['productId', 'color', 'size', 'material', 'brand', 'type', 'price', 'discount', 'dop1'], 'required'],
            [['productId', 'discount'], 'integer'],
            [['price'], 'number'],
            [['color', 'size', 'material', 'brand', 'type', 'dop1'], 'string', 'max' => 255],
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
            'productId' => 'Product ID',
            'color' => 'Color',
            'size' => 'Size',
            'material' => 'Material',
            'brand' => 'Brand',
            'type' => 'Type',
            'price' => 'Price',
            'discount' => 'Discount',
            'dop1' => 'Dop1',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'productId']);
    }
	public function getProductList()
    {
      return ArrayHelper::map($this->product, 'id', 'name');
    }
	public function getAssociatedArray()
	{
		return $this->getProduct()->select('id')->column();
	}
}
