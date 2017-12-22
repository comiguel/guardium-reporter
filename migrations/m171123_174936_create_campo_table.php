<?php

use yii\db\Migration;

/**
 * Handles the creation of table `field`.
 */
class m171123_174936_create_campo_table extends Migration
{
    public function tableName()
    {
        return 'campo';
    }
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), [
            'id' => $this->primaryKey(),
            'nombre_parametro' => $this->string(100),
            'etiqueta' => $this->string(100),
            'id_reporte' => $this->integer()
        ]);
        $this->addForeignKey('campo_reporte', $this->tableName(), 'id_reporte', 'reporte', 'id', 'NO ACTION', 'NO ACTION');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->delete($this->tableName());
        $this->dropForeignKey('campo_reporte', $this->tableName());
        $this->dropTable($this->tableName());
    }
}
