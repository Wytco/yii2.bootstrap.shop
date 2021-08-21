<?php

use yii\db\Migration;

/**
 * Class m200322_120801_init
 */
class m200322_120801_init extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200322_120801_init cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200322_120801_init cannot be reverted.\n";

        return false;
    }
    */
}
