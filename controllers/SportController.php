<?php

namespace app\controllers;

use app\models\Sport;
use app\models\SportSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


//for rights
use yii\filters\AccessControl;


/**
 * SportController implements the CRUD actions for Sport model.
 */
class SportController extends Controller
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
                        'actions'=> ['index','create','update', 'search', 'view', 'delete','all'],
                        'allow'=> true,
                        'roles'=>['admin',],   //@ = logged in user, ? = guest(not logged in)
                    ],
                    [
                        'actions'=> ['all'],
                        'allow'=> true,
                        'roles'=>['memer'],   //@ = logged in user, ? = guest(not logged in)
                    ],
                    [
                        'actions'=> ['all'],
                        'allow'=> true,
                        'roles'=>['@'],   //@ = logged in user, ? = guest(not logged in)
                    ],
                    [
                        'actions'=> ['all'],
                        'allow'=> true,
                        'roles'=>['?'],   //@ = logged in user, ? = guest(not logged in)
                    ],
                    ]
                ]

            ]
        );
    }

    /**
     * Lists all Sport models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SportSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sport model.
     * @param int $idSport Id Sport
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idSport)
    {
        return $this->render('view', [
            'model' => $this->findModel($idSport),
        ]);
    }

    /**
     * Creates a new Sport model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Sport();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'idSport' => $model->idSport]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Sport model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idSport Id Sport
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idSport)
    {
        $model = $this->findModel($idSport);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idSport' => $model->idSport]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Sport model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idSport Id Sport
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idSport)
    {
        $this->findModel($idSport)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Sport model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idSport Id Sport
     * @return Sport the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idSport)
    {
        if (($model = Sport::findOne(['idSport' => $idSport])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAll()
    {
        $searchModel = new SportSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('all', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}
