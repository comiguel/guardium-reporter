<?php

use yii\db\Migration;
use yii\models\Functions;

/**
 * Handles the creation of table `credencial`.
 */
class m171123_194110_create_credencial_table extends Migration
{
    public static function tableName() {
        return 'credencial';
    }
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), [
            'id' => $this->primaryKey(),
            'usuario' => $this->string(200),
            'contrasena' => $this->string(200)
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName());
    }
}
