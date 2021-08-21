<?php

namespace backend\controllers;

use backend\models\Product;
use Yii;
use backend\models\Category;
use backend\models\CategorySearch;
use backend\controllers\AppAdminController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends AppAdminController
{

    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $params = Yii::$app->params['languages'];
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'params' => $params,
        ]);
    }

    /**
     * Displays a single Category model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $params = Yii::$app->params['languages'];
        return $this->render('view', [
            'model' => $this->findModel($id),
            'params' => $params,
        ]);
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();

        $params = Yii::$app->params['languages'];

        if ($model->load(Yii::$app->request->post())) {

            if (count($params) >= 1) {
                $data = Yii::$app->request->post('Lang');
                $name = $data['name'];
                $keywords = $data['keywords'];
                $description = $data['description'];
                $model->name = serialize($name);
                $model->keywords = serialize($keywords);
                $model->description = serialize($description);
                $model->save();
            }

            Yii::$app->session->setFlash('success', 'Создана!');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'params' => $params,
        ]);
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $params = Yii::$app->params['languages'];

        if ($model->load(Yii::$app->request->post())) {

            if (count($params) >= 1) {
                $data = Yii::$app->request->post('Lang');
                $name = $data['name'];
                $keywords = $data['keywords'];
                $description = $data['description'];
                $model->name = serialize($name);
                $model->keywords = serialize($keywords);
                $model->description = serialize($description);
                $model->save();
            }

            Yii::$app->session->setFlash('success', 'Обновлено!');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'params' => $params,
        ]);
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $cats = Category::find()->where(['parent_id' => $id])->count();
        $products = Product::find()->where(['category_id' => $id])->count();
        if($cats || $products){
            Yii::$app->session->setFlash('error', 'Удаление невозможно: к категории прикреплены другие категории или товары');
        }else{
            $this->findModel($id)->delete();
            Yii::$app->session->setFlash('success', 'Категория удалена');
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
