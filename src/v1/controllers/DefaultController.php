<?php
/**
 * @author Harry Tang <harry@powerkernel.com>
 * @link https://powerkernel.com
 * @copyright Copyright (c) 2018 Power Kernel
 */

namespace powerkernel\yiiappintro\v1\controllers;
use powerkernel\yiicommon\controllers\RestController;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;
use powerkernel\yiiappintro\models\AppIntro;
/**
 * Class DefaultController
 * @package powerkernel\yiipage\v1\controllers
 */
class DefaultController extends RestController
{
    
    public function actionIndex()
    {
        
        $query = AppIntro::find()->select(['title','description','image','order'])->orderBy([
            'order'=>SORT_ASC
        ]);;
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
       return $dataProvider;
    }
}