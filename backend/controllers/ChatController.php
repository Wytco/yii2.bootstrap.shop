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
class ChatController extends AppAdminController
{


    public function actionIndex()
    {
        $my = Yii::$app->user->identity;

        $users = User::find()->where(['!=', 'id', $my->id])->all();

        $model = new Chat();

        $message = null;

        if(isset($_SESSION['UserID']) && !empty($_SESSION['UserID'])){
            $UserID = $_SESSION['UserID'];
            $list = Chat::find()->orWhere(['first_user_id' => $my->id])->orWhere(['second_user_id' => $UserID])->orWhere(['first_user_id' => $UserID])->orWhere(['second_user_id' => $my->id])->asArray()->all();
        }

//        if (Yii::$app->request->post()) {
        if (Yii::$app->request->isPjax) {
            $data = Yii::$app->request->post('Chat');
            if (isset($data['send-btn']) && !empty($data['send-btn'])) {
                $UserID = $data['UserID'];
                $message = $data['message'];

                $model->first_user_id = (int)$my->id;
                $model->second_user_id = (int)$UserID;
                $model->message = $message;
                $model->save();

                $session = Yii::$app->session;
                $session->open();

                $_SESSION['UserID'] = $UserID;

            } else {
                $UserID = $_SESSION['UserID'];
                $list = Chat::find()->orWhere(['first_user_id' => $my->id])->orWhere(['second_user_id' => $UserID])->orWhere(['first_user_id' => $UserID])->orWhere(['second_user_id' => $my->id])->asArray()->all();
            }
        }

        return $this->render('index', compact('model', 'my', 'users', 'message', 'list', 'UserID'));
    }

}
