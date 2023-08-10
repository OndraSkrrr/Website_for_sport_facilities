<?php

namespace app\models;

use Yii;
use amnah\yii2\user\models\User;

/**
 * This is the model class for table "person".
 *
 * @property int $idPerson
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property string|null $phone
 * @property string $personal_number
 * @property string $password
 * @property int $user_id
 *
 * @property Club[] $clubIdClubs
 * @property Event[] $eventIdEvents
 * @property Membership[] $memberships
 * @property Participation[] $participations
 * @property User $user
 */
class Person extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'person';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idPerson', 'name', 'surname', 'email', 'personal_number', 'password', 'user_id'], 'required'],
            [['idPerson', 'user_id'], 'integer'],
            [['name', 'surname', 'email', 'phone', 'personal_number', 'password'], 'string', 'max' => 45],
            [['idPerson'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idPerson' => 'Id Person',
            'name' => 'Name',
            'surname' => 'Surname',
            'email' => 'Email',
            'phone' => 'Phone',
            'personal_number' => 'Personal Number',
            'password' => 'Password',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[ClubIdClubs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClubIdClubs()
    {
        return $this->hasMany(Club::class, ['idClub' => 'Club_idClub'])->viaTable('membership', ['Person_idPerson' => 'idPerson']);
    }

    /**
     * Gets query for [[EventIdEvents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEventIdEvents()
    {
        return $this->hasMany(Event::class, ['idEvent' => 'Event_idEvent'])->viaTable('participation', ['Person_idPerson' => 'idPerson']);
    }

    /**
     * Gets query for [[Memberships]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMemberships()
    {
        return $this->hasMany(Membership::class, ['Person_idPerson' => 'idPerson']);
    }

    /**
     * Gets query for [[Participations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParticipations()
    {
        return $this->hasMany(Participation::class, ['Person_idPerson' => 'idPerson']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
