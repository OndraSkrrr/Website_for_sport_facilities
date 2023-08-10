<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Participation;


use yii\db\Query;

/**
 * ParticipationSearch represents the model behind the search form of `app\models\Participation`.
 */
class ParticipationSearch extends Participation
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Event_idEvent', 'Person_idPerson', 'points', 'position'], 'integer'],
            [['time', 'note'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Participation::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'Event_idEvent' => $this->Event_idEvent,
            'Person_idPerson' => $this->Person_idPerson,
            'time' => $this->time,
            'points' => $this->points,
            'position' => $this->position,
        ]);

        $query->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }


    public function searchAttend($params)
    {
        //$query = Participation::find();
        $query = (new Query());
        $query->from('Participation');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->join('LEFT JOIN', 'person', 'person.idPerson = Person_idPerson');
        $query->join('LEFT JOIN', 'event', 'event.idEvent = Event_idEvent');

        $idPerson = $_GET['idPerson'];
        $query->andWhere(['Person_idPerson' => $idPerson]);

        // grid filtering conditions
        $query->andFilterWhere([
            'Event_idEvent' => $this->Event_idEvent,
            'Person_idPerson' => $this->Person_idPerson,
            'time' => $this->time,
            'points' => $this->points,
            'position' => $this->position,
        ]);

        $query->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }

}
