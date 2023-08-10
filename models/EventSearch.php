<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Event;
use yii;  //should be chaged!!

use yii\db\Query;


/**
 * EventSearch represents the model behind the search form of `app\models\Event`.
 */
class EventSearch extends Event
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idEvent', 'private', 'Club_idClub'], 'integer'],
            [['name', 'time', 'address'], 'safe'],
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
        $query = Event::find();

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
            'idEvent' => $this->idEvent,
            'time' => $this->time,
            'private' => $this->private,
            'Club_idClub' => $this->Club_idClub,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'address', $this->address]);

        return $dataProvider;
    }

    public function searchPublic($params)
    {
        $query = Event::find();

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
            'idEvent' => $this->idEvent,
            'time' => $this->time,
            'private' => false,
            'Club_idClub' => $this->Club_idClub,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'address', $this->address]);

        return $dataProvider;
    }

    public function searchPrivate($params)
    {
        //$query = Event::find();
        $query = (new Query());

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



            $subQuery = (new Query())->select('idSport')->from('sport');
            $subQuery->join('LEFT JOIN', 'club', 'club.Sport_idSport = idSport');
            $subQuery->join('LEFT JOIN', 'membership', 'membership.Club_IdClub = idClub');
            $subQuery->join('LEFT JOIN', 'person', 'person.idPerson = Person_idPerson');
            $loggedInUserID = Yii::$app->user->id;
            $subQuery->andwhere(['user_id' => $loggedInUserID]);
            $subQuery->groupBy(['idSport']);


            // SELECT * FROM (SELECT `id` FROM `user` WHERE status=1) u 

            $query->from(['u' => $subQuery]);
            $query->join('LEFT JOIN', 'club', 'club.Sport_idSport = idSport');
            $query->join('LEFT JOIN', 'event', 'event.Club_idClub = idClub');

        // grid filtering conditions
        $query->andFilterWhere([
            'idEvent' => $this->idEvent,
            'time' => $this->time,
            'private' => true,
            'Club_idClub' => $this->Club_idClub,
        ]);

        $query->andFilterWhere(['like', 'event.name', $this->name])
            ->andFilterWhere(['like', 'address', $this->address]);

        return $dataProvider;
    }

}
