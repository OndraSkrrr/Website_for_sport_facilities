<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "membership".
 *
 * @property int $Club_idClub
 * @property int $Person_idPerson
 * @property int $Coach
 *
 * @property Club $clubIdClub
 * @property Person $personIdPerson
 */
class Membership extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'membership';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Club_idClub', 'Person_idPerson', 'Coach'], 'required'],
            [['Club_idClub', 'Person_idPerson', 'Coach'], 'integer'],
            [['Club_idClub', 'Person_idPerson'], 'unique', 'targetAttribute' => ['Club_idClub', 'Person_idPerson']],
            [['Club_idClub'], 'exist', 'skipOnError' => true, 'targetClass' => Club::class, 'targetAttribute' => ['Club_idClub' => 'idClub']],
            [['Person_idPerson'], 'exist', 'skipOnError' => true, 'targetClass' => Person::class, 'targetAttribute' => ['Person_idPerson' => 'idPerson']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Club_idClub' => 'Club Id Club',
            'Person_idPerson' => 'Person Id Person',
            'Coach' => 'Coach',
        ];
    }

    /**
     * Gets query for [[ClubIdClub]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClubIdClub()
    {
        return $this->hasOne(Club::class, ['idClub' => 'Club_idClub']);
    }

    /**
     * Gets query for [[PersonIdPerson]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonIdPerson()
    {
        return $this->hasOne(Person::class, ['idPerson' => 'Person_idPerson']);
    }
}
