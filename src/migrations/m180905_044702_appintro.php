<?php

class m180905_044702_appintro extends \yii\mongodb\Migration
{
    public function up()
    {
        $col = Yii::$app->mongodb->getCollection('appintro_db');
        $col->init();
    }

    public function down()
    {
        echo "m180905_044702_appintro cannot be reverted.\n";

        return false;
    }
}
