<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sport".
 *
 * @property int $idSport
 * @property string $name
 *
 * @property Club[] $clubs
 */
class Sport extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sport';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idSport', 'name'], 'required'],
            [['idSport'], 'integer'],
            [['name'], 'string', 'max' => 45],
            [['idSport'], 'unique'],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idSport' => 'Id Sport',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Clubs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClubs()
    {
        return $this->hasMany(Club::class, ['Sport_idSport' => 'idSport']);
    }
}
