<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\models\Options;
use backend\models\Languages;

/**
 * Site controller
 */
class OptionsController extends AppAdminController
{

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
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

    public function actionLanguages()
    {
        $languages = Languages::find()->all();

        $model = Options::findOne(1);

        if ($model->load(Yii::$app->request->post())) {
            $data_languages = Yii::$app->request->post('Options');
            //Сохраняем статус языков
            $active_multilanguages = $data_languages['languages'];
            $model->languages = $active_multilanguages;
            $model->save();
            if ((int)$active_multilanguages == 1) {
                $selected_languages = $data_languages['multilanguages'];
                $languages = Languages::updateAll(['active' => 0]);
                foreach ($selected_languages as $item) {
                    $language = Languages::findOne($item);
                    $language->active = 1;
                    $language->update();
                }
            } else {
                foreach ($languages as $item) {
                    $item->active = 0;
                    $item->update();
                    $language = Languages::findOne(3);
                    $language->active = 1;
                    $language->update();
                }
            }
            Yii::$app->session->setFlash('success', 'Языки сохранены или обновлены');
            return $this->redirect('index');
        }


        return $this->render('languages', compact('languages', 'model'));
    }

}
