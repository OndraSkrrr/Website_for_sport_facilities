<?php

namespace app\controllers;

use app\models\Membership;
use app\models\MembershipSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


//for rights
use yii\filters\AccessControl;

/**
 * MembershipController implements the CRUD actions for Membership model.
 */
class MembershipController extends Controller
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
                        'actions'=> ['index','create','update', 'search', 'view', 'delete'],
                        'allow'=> true,
                        'roles'=>['admin',],   //@ = logged in user, ? = guest(not logged in)
                    ],
                    ]
                ]
            ]
        );
    }

    /**
     * Lists all Membership models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MembershipSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Membership model.
     * @param int $Club_idClub Club Id Club
     * @param int $Person_idPerson Person Id Person
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($Club_idClub, $Person_idPerson)
    {
        return $this->render('view', [
            'model' => $this->findModel($Club_idClub, $Person_idPerson),
        ]);
    }

    /**
     * Creates a new Membership model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Membership();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'Club_idClub' => $model->Club_idClub, 'Person_idPerson' => $model->Person_idPerson]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Membership model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $Club_idClub Club Id Club
     * @param int $Person_idPerson Person Id Person
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($Club_idClub, $Person_idPerson)
    {
        $model = $this->findModel($Club_idClub, $Person_idPerson);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Club_idClub' => $model->Club_idClub, 'Person_idPerson' => $model->Person_idPerson]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Membership model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $Club_idClub Club Id Club
     * @param int $Person_idPerson Person Id Person
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($Club_idClub, $Person_idPerson)
    {
        $this->findModel($Club_idClub, $Person_idPerson)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Membership model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $Club_idClub Club Id Club
     * @param int $Person_idPerson Person Id Person
     * @return Membership the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Club_idClub, $Person_idPerson)
    {
        if (($model = Membership::findOne(['Club_idClub' => $Club_idClub, 'Person_idPerson' => $Person_idPerson])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
