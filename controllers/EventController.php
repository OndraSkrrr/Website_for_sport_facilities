<?php

namespace app\controllers;

use app\models\Event;
use app\models\EventSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\Participation;
use app\models\ParticipationSearch;
use app\models\Person;
use app\models\PersonSearch;

use amnah\yii2\user\models\User;

//for rights
use yii\filters\AccessControl;

/**
 * EventController implements the CRUD actions for Event model.
 */
class EventController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],

                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                   
                    [
                        'actions'=> ['index','create','update', 'search', 'view', 'delete','public','private','join','dissmis'],
                        'allow'=> true,
                        'roles'=>['admin',],   //@ = logged in user, ? = guest(not logged in)
                    ],
                    [
                        'actions'=> ['public','private','join','dissmis'],
                        'allow'=> true,
                        'roles'=>['memer'],   //@ = logged in user, ? = guest(not logged in)
                    ],
                    [
                        'actions'=> ['public','private','join','dissmis'],
                        'allow'=> true,
                        'roles'=>['@'],   //@ = logged in user, ? = guest(not logged in)
                    ],
                    [
                        'actions'=> ['public'],
                        'allow'=> true,
                        'roles'=>['?'],   //@ = logged in user, ? = guest(not logged in)
                    ],
                    ]
                ]
            ]
        );
    }

    /**
     * Lists all Event models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new EventSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Event model.
     * @param int $idEvent Id Event
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idEvent)
    {
        return $this->render('view', [
            'model' => $this->findModel($idEvent),
        ]);
    }

    /**
     * Creates a new Event model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Event();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'idEvent' => $model->idEvent]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Event model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idEvent Id Event
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idEvent)
    {
        $model = $this->findModel($idEvent);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idEvent' => $model->idEvent]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Event model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idEvent Id Event
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idEvent)
    {
        $this->findModel($idEvent)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Event model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idEvent Id Event
     * @return Event the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idEvent)
    {
        if (($model = Event::findOne(['idEvent' => $idEvent])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionPublic()
    {
        $searchModel = new EventSearch();
        $dataProvider = $searchModel->searchPublic($this->request->queryParams);

        return $this->render('public', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPrivate()
    {
        $searchModel = new EventSearch();
        $dataProvider = $searchModel->searchPrivate($this->request->queryParams);

        return $this->render('private', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionJoin()
    {
        $searchModel = new EventSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $loggedInUserID = \Yii::$app->user->id;
        $user = User::find()->andWhere(['id' => $loggedInUserID])->one();
        $role = $user->role_id;

        $eventId = $_GET['eventId'];
        $event = Event::find()->andWhere(['idEvent' => $eventId])->one();
        $private = $event->private;
        
        if($private == 1 && $role == 2){
            return $this->render('noright', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);

        }else{
            $participation = new Participation();
            $loggedInUserID = \Yii::$app->user->id;
            $person = Person::find()->andWhere(['user_id' => $loggedInUserID])->one();
            if($person == null){
                return $this->redirect(['person/request']);
            }
            $personId = $person->idPerson;

            $participation->Event_idEvent = $_GET['eventId'];
            $participation->Person_idPerson = $personId;
            $participation->time = 0;
            $participation->save();

        }


        return $this->render('join', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDismiss()
    {
        $searchModel = new EventSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);


        $loggedInUserID = \Yii::$app->user->id;
        $person = Person::find()->andWhere(['user_id' => $loggedInUserID])->one();
        $personId = $person->idPerson;

        $participation = Participation::find()->andWhere(['Event_idEvent' => $_GET['eventId'], 'Person_idPerson' => $personId])->one();
        $participation->delete();


        return $this->render('dismiss', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


}
