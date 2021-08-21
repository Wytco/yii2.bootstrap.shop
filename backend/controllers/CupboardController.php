<?php
/**
 * Created by PhpStorm.
 * User: WyTcorp
 * Date: 22.03.2020
 * Time: 15:56
 * Email: wild.savedo@gmail.com
 * Site : http://lockit.com.ua/
 */

namespace backend\controllers;


use Yii;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Cupboard;
use yii\web\UploadedFile;

class CupboardController extends AppAdminController
{

    public function actionIndex()
    {
        $query = Cupboard::find();
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 2, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $model = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy('id ASC')
            ->all();
        return $this->render('index', compact('model','pages'));
    }

    public function actionView($id)
    {
        $model = Cupboard::findOne($id);
        return $this->render('view', compact('model'));
    }

    public function actionCreate()
    {
        $model = new Cupboard();
        $width = null;
        $height = null;
        $length = null;
        $col = null;
        $row = null;
        $row_width = null;

        $my = Yii::$app->user->identity;

        if (Yii::$app->request->isPjax) {
            $data = Yii::$app->request->post('Cupboard');
            $width = $data['width'];
            $height = $data['height'];
            $length = $data['length'];
            $col = $data['col'];
            $rows = $data['row'];
            $row_width = $data['row-width'];
            $row_col_height = $data['row-col-height'];
            $row_col_height_col = $data['row-col-height-col'];
            $row_col_height_col_width = $data['row-col-height-col-width'];
            $row_col_height_col_width_row = $data['row-col-height-col-width-row'];
            $row_col_height_col_width_row_height = $data['row-col-height-col-width-row-height'];
            $new_rows = [];

            foreach ($rows as $key => $row) {
                $new_rows[$key]['row'] = $row;
                $new_rows[$key]['width'] = $width;
                $new_rows[$key]['height'] = $height;
                $new_rows[$key]['length'] = $length;
                $new_rows[$key]['col'] = $col;
                $new_rows[$key]['row_width'] = $row_width[$key];
                $new_rows[$key]['row-col-height'] = $row_col_height[$key];
                if(isset($row_col_height_col[$key]) && !empty($row_col_height_col)) {
                    foreach ($row_col_height_col[$key] as $key2 => $item) {
                        $new_rows[$key]['row-col-height-col'][$key2]['new_col'] = $item;
                        if(isset($row_col_height_col_width[$key][$key2]) && !empty($row_col_height_col_width[$key][$key2])){
                            $new_rows[$key]['row-col-height-col'][$key2]['col-width'] = $row_col_height_col_width[$key][$key2];
                        }
                        if(isset($row_col_height_col_width_row[$key][$key2]) && !empty($row_col_height_col_width_row[$key][$key2])){
                            $count = count($row_col_height_col_width_row[$key][$key2]);
                            for ($i = 1; $i <= $count; $i++) {
                                $new_rows[$key]['row-col-height-col'][$key2]['col-width-row'][$i]['new_col_row'] = $row_col_height_col_width_row[$key][$key2][$i];
                                $new_rows[$key]['row-col-height-col'][$key2]['col-width-row'][$i]['col-width-row-height'] = $row_col_height_col_width_row_height[$key][$key2][$i];
                            }
                        }
                    }
                }

            }
            $model->user_id = $my->id;
            $model->code = serialize($new_rows);
            $model->save();
            Yii::$app->session->setFlash('success', 'Шкаф сохранен!');
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', compact('model', 'width', 'height', 'length', 'col', 'row', 'row_width'));
    }

}
