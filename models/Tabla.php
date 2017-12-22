<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tabla".
 *
 * @property int $id
 * @property string $nombre_tabla
 * @property int $id_reporte
 *
 * @property Reporte $reporte
 */
class Tabla extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tabla';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_reporte'], 'integer'],
            [['nombre_tabla'], 'string', 'max' => 200],
            [['id_reporte'], 'exist', 'skipOnError' => true, 'targetClass' => Reporte::className(), 'targetAttribute' => ['id_reporte' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre_tabla' => 'Nombre Tabla',
            'id_reporte' => 'Id Reporte',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReporte()
    {
        return $this->hasOne(Reporte::className(), ['id' => 'id_reporte']);
    }
}
