<?php

namespace app\controllers;

use app\models\Club;
use app\models\ClubSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

//for rights
use yii\filters\AccessControl;


use app\models\Membership;
use app\models\MembershipSearch;

use app\models\Person;
use app\models\PersonSearch;

use amnah\yii2\user\models\User;


//Ondrej Skrob, m312227

/**
 * ClubController implements the CRUD actions for Club model.
 */
class ClubController extends Controller
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
                            'actions'=> ['index','create','update', 'search', 'view', 'delete','my','related','all','sign','leave'],
                            'allow'=> true,
                            'roles'=>['admin',],   //@ = logged in user, ? = guest(not logged in)
                        ],
                        [
                            'actions'=> ['my','related','all','sign','leave'],
                            'allow'=> true,
                            'roles'=>['memer'],   //@ = logged in user, ? = guest(not logged in)
                        ],
                        [
                            'actions'=> ['related','sign'],
                            'allow'=> true,
                            'roles'=>['@'],   //@ = logged in user, ? = guest(not logged in)
                        ],
                        [
                            'actions'=> ['related'],
                            'allow'=> true,
                            'roles'=>['?'],   //@ = logged in user, ? = guest(not logged in)
                        ],
                        ]
                    ]
                
            ]
        );
    }

    /**
     * Lists all Club models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ClubSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Club model.
     * @param int $idClub Id Club
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idClub)
    {
        return $this->render('view', [
            'model' => $this->findModel($idClub),
        ]);
    }

    /**
     * Creates a new Club model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Club();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'idClub' => $model->idClub]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Club model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idClub Id Club
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idClub)
    {
        $model = $this->findModel($idClub);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idClub' => $model->idClub]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Club model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idClub Id Club
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idClub)
    {
        $this->findModel($idClub)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Club model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idClub Id Club
     * @return Club the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idClub)
    {
        if (($model = Club::findOne(['idClub' => $idClub])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAll()
    {
        $searchModel = new ClubSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('all', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionMy()
    {
        $searchModel = new ClubSearch();
        $dataProvider = $searchModel->searchMy($this->request->queryParams);

        return $this->render('my', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRelated()
    {
        $searchModel = new ClubSearch();
        $dataProvider = $searchModel->searchRelated($this->request->queryParams);


        return $this->render('related', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSign()
    {
        $searchModel = new ClubSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $membership = new Membership();

        $loggedInUserID = \Yii::$app->user->id;
        $person = Person::find()->andWhere(['user_id' => $loggedInUserID])->one();

        if($person == null){
            return $this->redirect(['person/request']);
        }

        $personId = $person->idPerson;

        $membership->Club_idClub = $_GET['clubId'];
        $membership->Person_idPerson = $personId;
        $membership->Coach = 0;
        $membership->save();

                // \Yii::$app->user->role_id = 3; 

                $user = User::find()->andWhere(['id' => $loggedInUserID])->one();
                if($user->role_id == 2){
                    $user->role_id = 3;
                }
                $user->save();


        return $this->render('sign', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionLeave()
    {
        $searchModel = new ClubSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $membership = new Membership();

        $loggedInUserID = \Yii::$app->user->id;
        $person = Person::find()->andWhere(['user_id' => $loggedInUserID])->one();
        $personId = $person->idPerson;

        $membership = Membership::find()->andWhere(['Club_idClub' => $_GET['clubId'], 'Person_idPerson' => $personId])->one();
        $membership->delete();


        return $this->render('leave', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}
