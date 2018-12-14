<?php

namespace powerkernel\yiiappintro\models;
use powerkernel\yiicommon\behaviors\DefaultDateTimeBehavior;
use powerkernel\yiiuser\models\User;
use Yii;
class AppIntro extends \yii\mongodb\ActiveRecord
{

    public static function collectionName()
    {
        return 'appintro_db';
    }

    /**
     * @inheritdoc
     * @return array
     */
    public function attributes()
    {
        return [
            '_id',
            'title',
            'description',
            'image',
            'order',
            'created_at',
            'updated_at'
        ];
    }
    public function fields()
    {
        $fields = parent::fields();      
        return $fields;
    }
    public function rules()
    {
        return [
            [['title','description','image','order'], 'required'],
            [['description'], 'string', 'max' => 140],
            [['title'], 'string', 'max' => 40],
            [['order'], 'integer'],
            [['image'],'url', 'defaultScheme' => 'http'],
        ];
    }
    public function behaviors()
    {
        return [
            DefaultDateTimeBehavior::class,
        ];
    }
}
