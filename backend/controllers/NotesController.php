<?php

namespace backend\controllers;

use Yii;
use backend\models\Notes;
use backend\models\NotesSearch;
use backend\controllers\AppAdminController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NotesController implements the CRUD actions for Notes model.
 */
class NotesController extends AppAdminController
{


    /**
     * Lists all Notes models.
     * @return mixed
     */
//    public function actionIndex()
//    {
//        $searchModel = new NotesSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//
//        return $this->render('index', [
//            'searchModel' => $searchModel,
//            'dataProvider' => $dataProvider,
//        ]);
//    }

    public function actionIndex()
    {
        $model = new Notes();

        $message = null;
        if (Yii::$app->request->isPjax) {

            $data = Yii::$app->request->post('Notes');
            $data_save = Yii::$app->request->post('save');

            if (isset($data_save) && !empty($data_save)) {
                foreach ($data as $item) {
                    if (isset($item['changes']) && !empty($item['changes'])) {
                        $update_model = Notes::findOne($item['id']);
                        $update_model->text = $item['text'];
                        if(isset($item['date']) && !empty($item['date'])){
                            $update_model->date = (int)strval(strtotime(($item['date'])));
                        }
                        $update_model->save();
                    }
                }
                $message = 'Записи обновлены!';
            } else {
                if ($model->load(Yii::$app->request->post())) {
                    if(isset($data['date']) && !empty($data['date'])){
                        $model->date = (int)strval(strtotime(($data['date'])));
                        $model->save();
                        $message = 'Записи обновлены!';
                    }
                    $model = new Notes();
                }
            }
        }

        $searchModel = new NotesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            'message' => $message,
        ]);
    }

    /**
     * Displays a single Notes model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Notes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Notes();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Notes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Notes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Notes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Notes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Notes::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
