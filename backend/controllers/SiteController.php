<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends AppAdminController
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

    public function actionVideo()
    {
        return $this->render('video');
    }

    public function actionCalculator()
    {
        return $this->render('calculator');
    }

    public function actionSize()
    {
        $man_params = [
            'ALL' => [
                0 => 'XS',
                1 => 'S',
                2 => 'M',
                3 => 'L',
                4 => 'XL',
                5 => 'XXL',
                6 => '3XL',
            ],
            'EUR' => [
                0 => '34',
                1 => '36',
                2 => '38',
                3 => '40',
                4 => '42',
                5 => '44',
                6 => '46',
            ],
            'UA' => [
                0 => '42-44',
                1 => '44-46',
                2 => '46-48',
                3 => '48-50',
                4 => '50-52',
                5 => '52-54',
                6 => '54-56',
            ],
            'A' => [
                0 => [
                    'start' => 86,
                    'end' => 90,
                ],
                1 => [
                    'start' => 90,
                    'end' => 94,
                ],
                2 => [
                    'start' => 94,
                    'end' => 98,
                ],
                3 => [
                    'start' => 98,
                    'end' => 102,
                ],
                4 => [
                    'start' => 102,
                    'end' => 106,
                ],
                5 => [
                    'start' => 106,
                    'end' => 110,
                ],
                6 => [
                    'start' => 110,
                    'end' => 114,
                ],
            ],
            'B' => [
                0 => [
                    'start' => 74,
                    'end' => 78,
                ],
                1 => [
                    'start' => 78,
                    'end' => 82,
                ],
                2 => [
                    'start' => 82,
                    'end' => 86,
                ],
                3 => [
                    'start' => 86,
                    'end' => 90,
                ],
                4 => [
                    'start' => 92,
                    'end' => 94,
                ],
                5 => [
                    'start' => 96,
                    'end' => 100,
                ],
                6 => [
                    'start' => 106,
                    'end' => 110,
                ],
            ],
            'C' => [
                0 => [
                    'start' => 88,
                    'end' => 92,
                ],
                1 => [
                    'start' => 92,
                    'end' => 96,
                ],
                2 => [
                    'start' => 96,
                    'end' => 100,
                ],
                3 => [
                    'start' => 100,
                    'end' => 104,
                ],
                4 => [
                    'start' => 104,
                    'end' => 108,
                ],
                5 => [
                    'start' => 108,
                    'end' => 112,
                ],
                6 => [
                    'start' => 112,
                    'end' => 116,
                ],
            ],
            'D' => [
                0 => [
                    'start' => 39,
                    'end' => 41,
                ],
                1 => [
                    'start' => 40,
                    'end' => 42,
                ],
                2 => [
                    'start' => 41,
                    'end' => 43,
                ],
                3 => [
                    'start' => 42,
                    'end' => 44,
                ],
                4 => [
                    'start' => 43,
                    'end' => 45,
                ],
                5 => [
                    'start' => 44,
                    'end' => 47,
                ],
                6 => [
                    'start' => 45,
                    'end' => 47,
                ],
            ],
            'E' => [
                0 => [
                    'start' => 63,
                    'end' => 65,
                ],
                1 => [
                    'start' => 64,
                    'end' => 66,
                ],
                2 => [
                    'start' => 64,
                    'end' => 66,
                ],
                3 => [
                    'start' => 64,
                    'end' => 66,
                ],
                4 => [
                    'start' => 64,
                    'end' => 66.5,
                ],
                5 => [
                    'start' => 65,
                    'end' => 67,
                ],
                6 => [
                    'start' => 66,
                    'end' => 67.5,
                ],
            ],
            'F' => [
                0 => [
                    'start' => 158,
                    'end' => 164,
                ],
                1 => [
                    'start' => 165,
                    'end' => 177,
                ],
                2 => [
                    'start' => 178,
                    'end' => 185,
                ],
                3 => [
                    'start' => 185,
                ],
            ],
            'G' => [
                0 => [
                    'start' => 37,
                    'end' => 38,
                ],
                1 => [
                    'start' => 39,
                    'end' => 40,
                ],
                2 => [
                    'start' => 40,
                    'end' => 41,
                ],
                3 => [
                    'start' => 41,
                    'end' => 42,
                ],
                4 => [
                    'start' => 43,
                    'end' => 44,
                ],
                5 => [
                    'start' => 44,
                    'end' => 45,
                ],
                6 => [
                    'start' => 46,
                ],
            ],
        ];
        $A = null;
        $B = null;
        $C = null;
        $E = null;
        $F = null;
        $G = null;
        if (Yii::$app->request->post()) {
            $data = Yii::$app->request->post();
            $man_data = $data['Man'];
            //Обхват груди
            if (isset($man_data['A']) && !empty($man_data['A'])) {
                $A = (int)$man_data['A'];
                $array_A_ids = [];
                foreach ($man_params['A'] as $key => $man_param) {
                    if ($A >= $man_param['start']  && $A <= $man_param['end']) {
                        $array_A_ids[] = $key;
                        $man_params['A'][$key]['active'] .= 'active';
                    }
                }
            }

            //Обхват талии
            if (isset($man_data['B']) && !empty($man_data['B'])) {
                $B = (int)$man_data['B'];
                $array_B_ids = [];
                foreach ($man_params['B'] as $key => $man_param) {
                    if ($man_param['start'] <= $B && $man_param['end'] >= $B) {
                        $array_B_ids[] = $key;
                        $man_params['B'][$key]['active'] = 'active';
                    }
                }
            }
            //Обхват бедер
            if (isset($man_data['C']) && !empty($man_data['C'])) {
                $C = (int)$man_data['C'];
                $array_C_ids = [];
                foreach ($man_params['C'] as $key => $man_param) {
                    if ($man_param['start'] <= $C && $man_param['end'] >= $C) {
                        $array_C_ids[] = $key;
                        $man_params['C'][$key]['active'] = 'active';
                    }
                }
            }
            //Ширина плеча
            if (isset($man_data['D']) && !empty($man_data['D'])) {
                $D = (int)$man_data['D'];
                $array_D_ids = [];
                foreach ($man_params['D'] as $key => $man_param) {
                    if ($man_param['start'] <= $D && $man_param['end'] >= $D) {
                        $array_D_ids[] = $key;
                        $man_params['D'][$key]['active'] = 'active';
                    }
                }
            }
            //Длина рукава
            if (isset($man_data['E']) && !empty($man_data['E'])) {
                $E = (int)$man_data['E'];
                $array_E_ids = [];
                foreach ($man_params['E'] as $key => $man_param) {
                    if ($man_param['start'] <= $E && $man_param['end'] >= $E) {
                        $array_E_ids[] = $key;
                        $man_params['E'][$key]['active'] = 'active';
                    }
                }
            }
            //Длина ноги
            if (isset($man_data['F']) && !empty($man_data['F'])) {
                $F = (int)$man_data['F'];
                $array_F_ids = [];
                foreach ($man_params['F'] as $key => $man_param) {
                    if ($man_param['start'] <= $F && $man_param['end'] >= $F) {
                        $array_F_ids[] = $key;
                        $man_params['F'][$key]['active'] = 'active';
                    }
                }
            }
            //Обхват шеи
            if (isset($man_data['G']) && !empty($man_data['G'])) {
                $G = (int)$man_data['G'];
                $array_G_ids = [];
                foreach ($man_params['G'] as $key => $man_param) {
                    if ($man_param['start'] <= $G && $man_param['end'] >= $G) {
                        $array_G_ids[] = $key;
                        $man_params['G'][$key]['active'] = 'active';
                    }
                }
            }
        }
        return $this->render('size',compact('man_params','A','B','C','D','E','F','G'));
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
