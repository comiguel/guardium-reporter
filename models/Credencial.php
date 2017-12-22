<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "credencial".
 *
 * @property int $id
 * @property string $usuario
 * @property string $contrasena
 */
class Credencial extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'credencial';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuario', 'contrasena'], 'string', 'max' => 250],
            ['usuario', 'required'],
            ['contrasena', 'required', 'on' => 'creando'],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['creando'] = ['usuario', 'contrasena'];
        $scenarios['actualizando'] = ['usuario', 'contrasena'];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'usuario' => 'Usuario',
            'contrasena' => 'Contraseña',
        ];
    }
}
