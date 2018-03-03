<?php
namespace frontend\components;
use Yii;
use common\models\Menu;

class GetMenuRecurs  
{
    public function getMenu()
    {
    	$data=Menu::find()->where(['status'=>1])->orderBy(['sort'=>SORT_ASC])->all();
		return $this->buildTree($data);
		
	}
	
	public function getFooter()
    {
    	return Menu::find()->where(['not',['childs'=>'']])->all();
	}
	
	protected function buildTree(&$data, $rootID = 0) 
	{
        $tree = array();
        foreach ($data as $id => $node) {
            if ($node->parent_id == $rootID) {
                //unset($data[$id]);
                $node->childs = $this->buildTree($data, $node->id);
                $tree[] = $node;
            }
        }
        return $tree;
    } 
	
    
   
}
