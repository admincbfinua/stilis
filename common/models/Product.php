<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property int $menuId
 * @property int $landuage_id
 * @property int $status show or not
 * @property int $sort
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'menuId','shortdesc','fulldesc'], 'required'],
            [['menuId', 'landuage_id', 'status', 'sort'], 'integer'],
            [['name','shortdesc'], 'string', 'max' => 255],
			[['specialcharac'],'string']
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
            'menuId' => 'Menu ID',
            'landuage_id' => 'Landuage ID',
            'status' => 'Status',
            'sort' => 'Sort',
			'shortdesc' => 'Short description',
			'fulldesc' => 'Full product description',
			'specialcharac' => 'Product special character'
			
        ];
    }
	
	public function getCharacter()
    {
        return $this->hasMany(ProductCharacter::className(), ['productId' => 'id']);
    }
	
	public function getImage()
    {
        return $this->hasMany(ProductImage::className(), ['productId' => 'id']);
    }
	
}
