<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "participation".
 *
 * @property int $Event_idEvent
 * @property int $Person_idPerson
 * @property string $time
 * @property int|null $points
 * @property int|null $position
 * @property string|null $note
 *
 * @property Event $eventIdEvent
 * @property Person $personIdPerson
 */
class Participation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'participation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Event_idEvent', 'Person_idPerson', 'time'], 'required'],
            [['Event_idEvent', 'Person_idPerson', 'points', 'position'], 'integer'],
            [['time'], 'safe'],
            [['note'], 'string', 'max' => 400],
            [['Event_idEvent', 'Person_idPerson'], 'unique', 'targetAttribute' => ['Event_idEvent', 'Person_idPerson']],
            [['Event_idEvent'], 'exist', 'skipOnError' => true, 'targetClass' => Event::class, 'targetAttribute' => ['Event_idEvent' => 'idEvent']],
            [['Person_idPerson'], 'exist', 'skipOnError' => true, 'targetClass' => Person::class, 'targetAttribute' => ['Person_idPerson' => 'idPerson']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Event_idEvent' => 'Event Id Event',
            'Person_idPerson' => 'Person Id Person',
            'time' => 'Time',
            'points' => 'Points',
            'position' => 'Position',
            'note' => 'Note',
        ];
    }

    /**
     * Gets query for [[EventIdEvent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEventIdEvent()
    {
        return $this->hasOne(Event::class, ['idEvent' => 'Event_idEvent']);
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
