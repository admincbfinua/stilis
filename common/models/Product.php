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
            [['name', 'menuId'], 'required'],
            [['menuId', 'landuage_id', 'status', 'sort'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
        ];
    }
	
	public function getCharacter()
    {
        return $this->hasMany(productCharacter::className(), ['productId' => 'id']);
    }
	
	public function getImage()
    {
        return $this->hasMany(productImage::className(), ['productId' => 'id']);
    }
	
}
