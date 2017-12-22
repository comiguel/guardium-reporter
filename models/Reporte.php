<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reporte".
 *
 * @property int $id
 * @property string $nombre
 * @property string $descripcion
 * @property int $auditado
 *
 * @property Campo[] $campos
 */
class Reporte extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reporte';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion'], 'required'],
            [['descripcion'], 'string'],
            [['auditado'], 'integer'],
            [['nombre'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'auditado' => 'Auditado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampos()
    {
        return $this->hasMany(Campo::className(), ['id_reporte' => 'id']);
    }
}
