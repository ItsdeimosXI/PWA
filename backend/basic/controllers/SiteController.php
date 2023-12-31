<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\FormValidator;
use app\models\Query;
use app\models\Usuario;
use yii\data\Pagination;
use yii\helpers\Html;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }
    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    /**
     * Displays prueba page.
     *
     * @return string
     */
    public function actionPrueba()
    {
        return $this->render('prueba', ['varname' => 'Dato de variable']);
    }

    public function actionForm($mensaje = null)
    {

        return $this->render('form', ["mensaje" => $mensaje]);
    }
    public function actionSform()
    {
        $datotxt = null;
        if (isset($_REQUEST['campotxt'])) {
            $datotxt = "El valor enviado desde el form es: " . $_REQUEST['campotxt'];
        }
        return $this->redirect(['site/form', "mensaje" => $datotxt]);
    }


    public function actionFormvalidator()
    {
        $model = new FormValidator;

        $mensaje = null;
        if ($model->load(Yii::$app->request->post())) {

            if ($model->validate()) {
                //consultas, calculos, etc, Guardado
                $user = new Usuario;
                $user->nombre = $model->nombre;
                $user->email = $model->email;
                if ($user->insert()) {
                    $mensaje = 'Los datos fueron cargados y validados';
                    $model->nombre = null;
                    $model->email = null;
                } else {
                    $mensaje = 'Ha ocurrido un error al cargar los datos';
                }
            } else {
                $model->getErrors();
            }
        }
        return $this->render('Formvalidator', ['model' => $model, 'mensaje' => $mensaje]);
    }
    public function actionUsuario($mensaje = null)
    {
        $model = new Query();
        if ($model->load(Yii::$app->request->get())) {
            if ($model->validate()) {
                $search = Html::encode($model->query);
                if (is_numeric($search)) {
                    $query = Usuario::find()
                        ->andWhere(['id' => $search]);
                } else {
                    $query = Usuario::find()
                        ->orwhere(['like', 'nombre',  $search])
                        ->orwhere(['like', 'email', $search]);
                }
            } else {
                $model->getErrors();
            }
        } else {
            $query = Usuario::find();
        }

        $countQuery = clone $query;

        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 2
        ]);
        $data = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('Usuarios', ['data' => $data, 'model' => $model, 'pages' => $pages]);
    }

    public function actionDelusuario($id)
    {
        $user = Usuario::findOne($id);
        $user->delete();
        return $this->redirect(['site/usuario']);
    }
}
