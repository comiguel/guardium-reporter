<?php

use yii\db\Migration;

/**
 * Handles the creation of table `report`.
 */
class m171122_173043_create_reporte_table extends Migration
{
    public function tableName()
    {
        return 'reporte';
    }
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tableName(), [
            'id' => $this->primaryKey(),
            'nombre' => $this->string(250)->notNull(),
            'descripcion' => $this->text()->notNull(),
            'auditado' => $this->boolean()->defaultValue(false),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->delete($this->tableName());
        $this->dropTable($this->tableName());
    }
}
