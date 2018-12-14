<?php
namespace powerkernel\yiiappintro\controllers;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use powerkernel\yiiappintro\models\AppIntro;
/**
 * Class ManageController
 */
class ManageController extends \powerkernel\yiicommon\controllers\ActiveController
{
    public $modelClass = 'powerkernel\yiiappintro\models\AppIntro';

    /**
     * @inheritdoc
     * @return array
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['access'] = [
            '__class' => AccessControl::class,
            'only' => ['update','create', 'delete','view','image-upload','index'],
            'rules' => [
                [
                    'verbs' => ['OPTIONS'],
                    'allow' => true,
                ],
                [
                    'actions' => [ 'update', 'create', 'delete','view','image-upload','index'],
                    'roles' => ['admin'],
                    'allow' => true,
                ],
            ],
        ];
        return $behaviors;
    }

    protected function verbs()
    {
        $parents = parent::verbs();
        return array_merge(
            $parents,
            [
                'index' => ['GET'],
                'create' => ['POST'],
                'update' => ['POST'],
                'delete' => ['POST'],
                'view' => ['POST'],
                'image-upload' => ['POST'],
            ]
        );
    }
    public function actions()
    {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];        
        return $actions;
    }
    public function prepareDataProvider()
    {
       
        $query = AppIntro::find()->orderBy([
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
    public function actionImageUpload(){
        $data = \Yii::$app->getRequest()->getParsedBody();
        $array_thumb = array( 
            "eager" => array(
                array("width" => 200, "height" => 200, "crop" => "fit")));
        $image = \Yii::$app->cloudinary->upload($data['image'],$array_thumb);
        if(isset($image['eager'])){
            $image['secure_url'] = $image['eager'][0]['url'];
        }
        return $image;
    } 
}
