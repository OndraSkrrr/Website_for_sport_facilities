<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "event".
 *
 * @property int $idEvent
 * @property string|null $name
 * @property string $time
 * @property int $private
 * @property int $Club_idClub
 * @property string $address
 *
 * @property Club $clubIdClub
 * @property Participation[] $participations
 * @property Person[] $personIdPeople
 */
class Event extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idEvent', 'time', 'private', 'Club_idClub', 'address'], 'required'],
            [['idEvent', 'private', 'Club_idClub'], 'integer'],
            [['time'], 'safe'],
            [['name', 'address'], 'string', 'max' => 45],
            [['idEvent'], 'unique'],
            [['Club_idClub'], 'exist', 'skipOnError' => true, 'targetClass' => Club::class, 'targetAttribute' => ['Club_idClub' => 'idClub']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idEvent' => 'Id Event',
            'name' => 'Name',
            'time' => 'Time',
            'private' => 'Private',
            'Club_idClub' => 'Club Id Club',
            'address' => 'Address',
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
     * Gets query for [[Participations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParticipations()
    {
        return $this->hasMany(Participation::class, ['Event_idEvent' => 'idEvent']);
    }

    /**
     * Gets query for [[PersonIdPeople]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonIdPeople()
    {
        return $this->hasMany(Person::class, ['idPerson' => 'Person_idPerson'])->viaTable('participation', ['Event_idEvent' => 'idEvent']);
    }
}
