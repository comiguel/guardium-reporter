<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tabla`.
 */
class m171221_125818_create_tabla_table extends Migration
{
    public static function tableName() {
        return 'tabla';
    }
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), [
            'id' => $this->primaryKey(),
            'nombre_tabla' => $this->string(200),
            'id_reporte' => $this->integer()
        ]);
        $this->addForeignKey('tabla_reporte', $this->tableName(), 'id_reporte', 'reporte', 'id', 'NO ACTION', 'NO ACTION');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->delete($this->tableName());
        $this->dropForeignKey('tabla_reporte', $this->tableName());
        $this->dropTable($this->tableName());
    }
}
