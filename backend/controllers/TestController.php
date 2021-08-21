<?php

namespace app\controllers;

use app\models\Country;
use Yii;
use app\controllers\AppController;
use app\models\EntryForm;
use yii\bootstrap\ActiveForm;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\View;


class TestController extends AppController
{
    //Перенаправление основного шаблона (сейчас в замен index будет my-test)
//    public $defaultAction = 'my-test';

    public $my_var;

    //переопределяем layout для всего котроллера
//    public $layout = 'test';

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            //Если обращаются у test/test а actionText нету, перенаправляем его components\HelloAction
            'test' => [
                'class' => 'app\components\HelloAction',
//                'viewPrefix' => '',
            ],
        ];
    }

    public function actionIndex($name = NULL, $age = NULL)
    {

        //Передача переменой в контроллере не передавая в вид (смотри вид), но так же обращаясь к этому котроллеру можно его использовать в layout
        //Смотри  layout после футера
        $this->my_var = 'My App';
        //Второй вариант передачи
        //Глобальный доступ
//        \Yii::$app->view->params['t1'] = 'T1 params';
        //Доступ только с контроллера
        $this->view->params['t1'] = 'T1 params';


        //Подключение с шаблоном вы вода layout
        //Два метода передачи данных
//        return $this->render('index',[
//            'name'=>$name,
//            'age'=>$age,
//        ]);

        return $this->render('index', compact('name', 'age'));

        //Подключение без шаблоном вы вода layout
//        return $this->renderPartial('index');

        //Подключение без шаблоном вы вода layout для ajax запросов
//        return $this->renderAjax('index');

        //Подключение без шаблоном вы вода layout, заданный как путь к файлу или алиас.
//        return $this->renderFile('@app/views/test/index.php');
    }

    public function actionMyTest()
    {
        //Задать нужный layout
        $this->layout = 'test';
        //Задать заголовок страници в котроллере
        $this->view->title = 'My Test';

        //Смотри https://www.yiiframework.com/doc/guide/2.0/ru/structure-views События в видах
        \Yii::$app->view->on(View::EVENT_END_BODY, function () {
            echo date('Y-m-d');
        });
        return $this->render('my-test');
    }

    public function actionForm($alert = '')
    {
        //Работа с формами
        $this->view->registerMetaTag(['name' => 'description', 'content' => 'мета-описание...'], 'description');
        $model = new EntryForm();

        //Пример проверки и сравнения alert
//        switch ($alert){
//            case 'error':
//                \Yii::$app->session->setFlash('error', 'Error');
//                break;
//            case 'success':
//                \Yii::$app->session->setFlash('success', 'OK');
//                break;
//            case 'info':
//                \Yii::$app->session->setFlash('info', 'INFO');
//                break;
//            case 'warning':
//                \Yii::$app->session->setFlash('warning', 'Warning');
//                break;
//            default:
//                \Yii::$app->session->setFlash('danger', 'Danger');
//        }

        //Загрзка данных с модели, если данных нет в модели они игнорируются
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            // Проверка каким методом был отправлен AJAX или POST
            if (Yii::$app->request->isPjax) {
                //Собобщение об действии Стандартный и не стандарнтый в виде для примера своего действия
                Yii::$app->session->setFlash('success', 'Данные отправленый через Pjax');
                $model = new EntryForm();
            } else {
                //Собобщение об действии Стандартный и не стандарнтый в виде для примера своего действия
                Yii::$app->session->setFlash('success', 'Данные отправленый Post');
                return $this->refresh();
            }
        } else {
            return $this->render('form', compact('model'));
        }
    }

    public function actionAjax()
    {
        //Работа с формами Ajax

        $model = new EntryForm();

        if ($model->load(Yii::$app->request->post())) {
            // Проверка каким методом был отправлен AJAX или POST
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                if ($model->validate()) {
                    return ['message' => 'Ok'];
                } else {
                    return ActiveForm::validate($model);
                }
            }
        } else {
            return $this->render('ajax', compact('model'));
        }
    }

    public function actionModels()
    {
        //Работа с формами Models
        //https://www.yiiframework.com/doc/guide/2.0/ru/structure-models
        //https://www.yiiframework.com/doc/guide/2.0/ru/start-databases
        //https://www.yiiframework.com/doc/guide/2.0/ru/db-active-record
        $this->view->title = 'Работа с моделями';

        //Получение данных (чтение)
//        $model = Country::find()->where('population < 100000000 AND code<>"AU"')->all();

//        $model = Country::find()->where('population < :population AND code<>:code', [':code' => 'AU', ':population' => 100000000])->all();

//        $model = Country::find()->where([
//            'code' => ['DE', 'FR', 'GB'],
//            'status' => 1
//        ])->all();

//        $model = Country::find()->where(['like','name','ni'])->all();

//        $model = Country::find()->where(['like','name','ni'])->OrderBy('code DESC')->all();

//        $model = Country::find()->count();

//        $model = Country::find()->limit(1)->one();

        //В виде массива а не обьекта, меньше ест памяти если высконагружены запрос > 10 000
//        $model = Country::find()->asArray()->all();


        // SQL запрос
//        $sql = 'SELECT * FROM country WHERE status=:status';
//        $model = Country::findBySql($sql, [':status' => 1])->all();

        // return $this->render('models', compact('model'));

        //Создание данных
//        $model = new Country();
//
//        // Проверка каким методом был отправлен AJAX или POST
//        // Для проверки уникальности строки code ('enableAjaxValidation' => true,)
//        if (Yii::$app->request->isAjax) {
//            $model->load(Yii::$app->request->post());
//            Yii::$app->response->format = Response::FORMAT_JSON;
//            return ActiveForm::validate($model);
//        }
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            Yii::$app->session->setFlash('success', 'Данные добавлены');
//            return $this->refresh();
//        }


//        Обновление данных

//        $model = Country::findOne('UA');
//
//        if(!$model) {
//            throw new NotFoundHttpException('Country not found');
//        }
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            Yii::$app->session->setFlash('success', 'Данные добавлены');
//            return $this->refresh();
//        }


        //Удажение данных

        $model = Country::findOne('UA');

        if(!$model) {
            throw new NotFoundHttpException('Country not found');
        }

        if ($model->delete()) {
            Yii::$app->session->setFlash('success', 'Данные удалены');
            return $this->refresh();
        }

        return $this->render('create', compact('model'));

    }
}