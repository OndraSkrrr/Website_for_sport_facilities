<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "club".
 *
 * @property int $idClub
 * @property string $name
 * @property int $Sport_idSport
 * @property string|null $web
 * @property string $email
 * @property string|null $phone
 * @property string $address
 *
 * @property Event[] $events
 * @property Membership[] $memberships
 * @property Person[] $personIdPeople
 * @property Sport $sportIdSport
 */
class Club extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'club';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idClub', 'name', 'Sport_idSport', 'email', 'address'], 'required'],
            [['idClub', 'Sport_idSport'], 'integer'],
            [['name', 'web', 'email', 'phone', 'address'], 'string', 'max' => 45],
            [['idClub'], 'unique'],
            [['name'], 'unique'],
            [['Sport_idSport'], 'exist', 'skipOnError' => true, 'targetClass' => Sport::class, 'targetAttribute' => ['Sport_idSport' => 'idSport']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idClub' => 'Id Club',
            'name' => 'Name',
            'Sport_idSport' => 'Sport Id Sport',
            'web' => 'Web',
            'email' => 'Email',
            'phone' => 'Phone',
            'address' => 'Address',
        ];
    }

    /**
     * Gets query for [[Events]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::class, ['Club_idClub' => 'idClub']);
    }

    /**
     * Gets query for [[Memberships]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMemberships()
    {
        return $this->hasMany(Membership::class, ['Club_idClub' => 'idClub']);
    }

    /**
     * Gets query for [[PersonIdPeople]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonIdPeople()
    {
        return $this->hasMany(Person::class, ['idPerson' => 'Person_idPerson'])->viaTable('membership', ['Club_idClub' => 'idClub']);
    }

    /**
     * Gets query for [[SportIdSport]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSportIdSport()
    {
        return $this->hasOne(Sport::class, ['idSport' => 'Sport_idSport']);
    }
}
