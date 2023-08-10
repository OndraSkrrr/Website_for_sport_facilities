<?php

namespace app\controllers;

use app\models\Participation;
use app\models\ParticipationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;



//for rights
use yii\filters\AccessControl;

/**
 * ParticipationController implements the CRUD actions for Participation model.
 */
class ParticipationController extends Controller
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
                        'actions'=> ['index','create','update', 'search', 'view', 'delete','attend'],
                        'allow'=> true,
                        'roles'=>['admin',],   //@ = logged in user, ? = guest(not logged in)
                    ],
                    [
                        'actions'=> ['attend'],
                        'allow'=> true,
                        'roles'=>['memer'],   //@ = logged in user, ? = guest(not logged in)
                    ],
                    /*
                    [
                        'actions'=> [''],
                        'allow'=> true,
                        'roles'=>['@'],   //@ = logged in user, ? = guest(not logged in)
                    ],
                    [
                        'actions'=> [''],
                        'allow'=> true,
                        'roles'=>['?'],   //@ = logged in user, ? = guest(not logged in)
                    ],
                    */
                    ]
                ]
            ]
        );
    }

    /**
     * Lists all Participation models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ParticipationSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Participation model.
     * @param int $Event_idEvent Event Id Event
     * @param int $Person_idPerson Person Id Person
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($Event_idEvent, $Person_idPerson)
    {
        return $this->render('view', [
            'model' => $this->findModel($Event_idEvent, $Person_idPerson),
        ]);
    }

    /**
     * Creates a new Participation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Participation();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'Event_idEvent' => $model->Event_idEvent, 'Person_idPerson' => $model->Person_idPerson]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Participation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $Event_idEvent Event Id Event
     * @param int $Person_idPerson Person Id Person
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($Event_idEvent, $Person_idPerson)
    {
        $model = $this->findModel($Event_idEvent, $Person_idPerson);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Event_idEvent' => $model->Event_idEvent, 'Person_idPerson' => $model->Person_idPerson]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Participation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $Event_idEvent Event Id Event
     * @param int $Person_idPerson Person Id Person
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($Event_idEvent, $Person_idPerson)
    {
        $this->findModel($Event_idEvent, $Person_idPerson)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Participation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $Event_idEvent Event Id Event
     * @param int $Person_idPerson Person Id Person
     * @return Participation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Event_idEvent, $Person_idPerson)
    {
        if (($model = Participation::findOne(['Event_idEvent' => $Event_idEvent, 'Person_idPerson' => $Person_idPerson])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAttend()
    {
        $searchModel = new ParticipationSearch();
        $dataProvider = $searchModel->searchAttend($this->request->queryParams);

        return $this->render('attend', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}
