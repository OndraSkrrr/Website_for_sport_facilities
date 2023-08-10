<?php

namespace app\controllers;

use app\models\Person;
use app\models\PersonSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


//for rights
use yii\filters\AccessControl;


/**
 * PersonController implements the CRUD actions for Person model.
 */
class PersonController extends Controller
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
                        'actions'=> ['index','create','update', 'search', 'view', 'delete','request','members'],
                        'allow'=> true,
                        'roles'=>['admin',],   //@ = logged in user, ? = guest(not logged in)
                    ],
                    [
                        'actions'=> ['request', 'members'],
                        'allow'=> true,
                        'roles'=>['memer'],   //@ = logged in user, ? = guest(not logged in)
                    ],
                    [
                        'actions'=> ['request'],
                        'allow'=> true,
                        'roles'=>['@'],   //@ = logged in user, ? = guest(not logged in)
                    ],
                    [
                        'actions'=> ['request'],
                        'allow'=> true,
                        'roles'=>['?'],   //@ = logged in user, ? = guest(not logged in)
                    ],
                    ]
                ]
            ]
        );
    }

    /**
     * Lists all Person models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PersonSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Person model.
     * @param int $idPerson Id Person
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idPerson)
    {
        return $this->render('view', [
            'model' => $this->findModel($idPerson),
        ]);
    }

    /**
     * Creates a new Person model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Person();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'idPerson' => $model->idPerson]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Person model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idPerson Id Person
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idPerson)
    {
        $model = $this->findModel($idPerson);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idPerson' => $model->idPerson]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Person model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idPerson Id Person
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idPerson)
    {
        $this->findModel($idPerson)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Person model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idPerson Id Person
     * @return Person the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idPerson)
    {
        if (($model = Person::findOne(['idPerson' => $idPerson])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionMembers()
    {
        $searchModel = new PersonSearch();
        $dataProvider = $searchModel->searchMembers($this->request->queryParams);

        return $this->render('members', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionRequest()
    {
        //$personId=(-1);
        $loggedInUserID = \Yii::$app->user->id;
        $person = Person::find()->andWhere(['user_id' => $loggedInUserID])->one();
        //$personId = $person->idPerson;

        if($person == null){
            $model = new Person();
            $model->user_id = $loggedInUserID;
            $model->idPerson = $loggedInUserID;
        }else{
            $model = $person;
        }

        //$model = new Person();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['site/index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('request', [
            'model' => $model,
        ]);
    }

}
