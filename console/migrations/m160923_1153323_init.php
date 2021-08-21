<?php
/**
 * Created by PhpStorm.
 * User: WyTcorp
 * Date: 22.03.2020
 * Time: 14:07
 * Email: wild.savedo@gmail.com
 * Site : http://lockit.com.ua/
 */

use yiidbMigration;

class m160923_1153323_init extends Migration
{
    public function up()
    {
        $this->createTable('message', [
            'id' => $this->primaryKey(),
            'from' => $this->integer()->notNull(),
            'to' => $this->integer()->notNull(),
            'text' => $this->text()->notNull()
        ]);
    }

    public function down()
    {
        $this->dropTable('message');
    }
}
