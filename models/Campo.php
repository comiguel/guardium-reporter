<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "campo".
 *
 * @property int $id
 * @property string $nombre_parametro
 * @property string $etiqueta
 * @property int $id_reporte
 *
 * @property Reporte $id0
 */
class Campo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'campo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_reporte'], 'integer'],
            [['nombre_parametro', 'etiqueta'], 'string', 'max' => 100],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Reporte::className(), 'targetAttribute' => ['id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre_parametro' => 'Nombre Parametro',
            'etiqueta' => 'Etiqueta',
            'id_reporte' => 'Id Reporte',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(Reporte::className(), ['id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return CampoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CampoQuery(get_called_class());
    }
}
