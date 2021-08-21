<?php

namespace backend\controllers;

use Yii;
use backend\controllers\AppAdminController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Chat;
use common\models\User;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CalculatorController extends AppAdminController
{

    public function actionCalculator()
    {

        return $this->render('calculator');
    }
    public function actionIndex()
    {

        return $this->render('index');
    }

}
