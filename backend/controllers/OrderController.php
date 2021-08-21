<?php

namespace backend\controllers;

use backend\models\OrderItems;
use backend\models\Product;
use backend\models\ProductSearch;
use Yii;
use backend\models\Order;
use backend\models\OrderSearch;
use backend\controllers\AppAdminController;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends AppAdminController
{


    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
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
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();

        $query = Product::find();
        $pages = new Pagination(['totalCount' => $query->count()]);
        $order_items = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy('id ASC')
            ->all();

        $name = null;
        $email = null;
        $phone = null;
        $address = null;
        $status = null;
        $search = null;
        $products = null;
        $message = 'Заказ сохранен';

        if (Yii::$app->request->isPjax) {
            $data = Yii::$app->request->post('Order');
            $data_btn = Yii::$app->request->post();

            $name = $data['name'];
            $email = $data['email'];
            $phone = $data['phone'];
            $address = $data['address'];
            $status = $data['status'];
            $search = $data['search'];
            if (isset($data['products'])) {
                $products = [];

                foreach ($data['products']['product_id'] as $key => $product_items) {
                    $products[$key]['product_id'] = $product_items;
                    $products[$key]['name'] = $data['products']['name'][$key];
                    $products[$key]['price'] = $data['products']['price'][$key];
                    $products[$key]['qty_item'] = $data['products']['qty_item'][$key];
                    $products[$key]['sum_item'] = $data['products']['price'][$key] * $data['products']['qty_item'][$key];
                }
            }

            if (isset($data_btn['save-btn']) && !empty($data_btn['save-btn'])) {
                $data_btn['search-btn'] = null;
                $message = 'Заказ сохранен';
                if ($products) {
                    $qty = 0;
                    $sum = 0;
                    foreach ($products as $product) {
                        $qty = $qty + $product['qty_item'];
                        $sum = $sum + $product['sum_item'];
                    }
                    $model->sum = $sum;
                    $model->qty = $qty;
                    if ($model->load(Yii::$app->request->post()) && $model->save()) {
                        foreach ($products as $product) {
                            $order_items = new OrderItems();
                            $order_items->order_id = $model->id;
                            $order_items->product_id = $product['product_id'];
                            $order_items->name = $product['name'];
                            $order_items->price = $product['price'];
                            $order_items->qty_item = $product['qty_item'];
                            $order_items->sum_item = $product['sum_item'];
                            $order_items->save();
                        }
                        Yii::$app->session->setFlash('success', 'Создана!');
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } else {
                    $message = 'Выберите товар';
                }
            } elseif (isset($data_btn['search-btn']) && !empty($data_btn['search-btn'])) {
                $data_btn['save-btn'] = null;
                if (isset($data['search'])) {
                    if (!empty($data['search'])) {
                        $query = Product::find();
                        $pages = new Pagination(['totalCount' => $query->count()]);
                        $order_items = $query->offset($pages->offset)
                            ->where(['like', 'name', $search])
                            ->limit($pages->limit)
                            ->orderBy('id ASC')
                            ->all();
                    } else {
                        $query = Product::find();
                        $pages = new Pagination(['totalCount' => $query->count()]);
                        $order_items = $query->offset($pages->offset)
                            ->limit($pages->limit)
                            ->orderBy('id ASC')
                            ->all();
                    }
                    $message = 'Товар подобран';
                }
            }

        }

        return $this->render('create', [
            'model' => $model,
            'order_items' => $order_items,
            'pages' => $pages,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'status' => $status,
            'search' => $search,
            'message' => $message,
            'products' => $products,
        ]);
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $query = Product::find();
        $pages = new Pagination(['totalCount' => $query->count()]);
        $order_items = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy('id ASC')
            ->all();

        $name = $model->name;
        $email = $model->email;
        $phone = $model->phone;
        $address = $model->address;
        $status = $model->status;
        $search = null;

        $orders_items = OrderItems::find()->where(['order_id' => $model->id])->all();
        $products = $orders_items;

        if (Yii::$app->request->isPjax) {
            $data = Yii::$app->request->post('Order');
            $data_btn = Yii::$app->request->post();

            $name = $data['name'];
            $email = $data['email'];
            $phone = $data['phone'];
            $address = $data['address'];
            $status = $data['status'];
            $search = $data['search'];

            $message = null;

            if (isset($data['products']) && !empty($data['products'])) {
                $products = [];

                foreach ($data['products']['product_id'] as $key => $product_items) {
                    $products[$key]['product_id'] = $product_items;
                    $products[$key]['name'] = $data['products']['name'][$key];
                    $products[$key]['price'] = $data['products']['price'][$key];
                    $products[$key]['qty_item'] = $data['products']['qty_item'][$key];
                    $products[$key]['sum_item'] = $data['products']['price'][$key] * $data['products']['qty_item'][$key];
                }
            }

            if (isset($data_btn['save-btn']) && !empty($data_btn['save-btn'])) {
                $data_btn['search-btn'] = null;

                if(isset($data['delete']) && !empty($data['delete'])){
                    $delete = explode(',',$data['delete']);
                    $delete_items = OrderItems::find()->where(['order_id'=>$model->id])->andWhere(['product_id'=>$delete])->all();
                    foreach($delete_items as $delete_item){
                        $delete_item->delete();
                    }
                }

                if (isset($data['products']) && !empty($data['products'])) {
                    $qty = 0;
                    $sum = 0;
                    foreach ($products as $product) {
                        $qty = $qty + $product['qty_item'];
                        $sum = $sum + $product['sum_item'];
                    }
                    $model->sum = $sum;
                    $model->qty = $qty;
                    if ($model->load(Yii::$app->request->post()) && $model->save()) {
                        foreach ($products as $product) {
                            $find_order_items = OrderItems::findOne(['order_id'=>$model->id,'product_id'=>$product['product_id']]);
                            if(!isset($find_order_items) && empty($find_order_items)) {
                                $order_items = new OrderItems();
                                $order_items->order_id = $model->id;
                                $order_items->product_id = $product['product_id'];
                                $order_items->name = $product['name'];
                                $order_items->price = $product['price'];
                                $order_items->qty_item = $product['qty_item'];
                                $order_items->sum_item = $product['sum_item'];
                                $order_items->save();
                            } else {
                                $find_order_items->price = $product['price'];
                                $find_order_items->qty_item = $product['qty_item'];
                                $find_order_items->sum_item = $product['sum_item'];
                                $find_order_items->save();
                            }
                        }
                        $message = 'Заказ сохранен';
                        Yii::$app->session->setFlash('success', 'Обновлено!');
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } else {
                    $data['products'] = null;
                    $products = null;
                    $message = 'Выберите товар';
                }
            } elseif (isset($data_btn['search-btn']) && !empty($data_btn['search-btn'])) {
                $data_btn['save-btn'] = null;
                if (isset($data['search'])) {
                    if (!empty($data['search'])) {
                        $query = Product::find();
                        $pages = new Pagination(['totalCount' => $query->count()]);
                        $order_items = $query->offset($pages->offset)
                            ->where(['like', 'name', $search])
                            ->limit($pages->limit)
                            ->orderBy('id ASC')
                            ->all();
                    } else {
                        $query = Product::find();
                        $pages = new Pagination(['totalCount' => $query->count()]);
                        $order_items = $query->offset($pages->offset)
                            ->limit($pages->limit)
                            ->orderBy('id ASC')
                            ->all();
                    }
                    $message = 'Товар подобран';
                }
            }

        }

        return $this->render('update', [
            'model' => $model,
            'order_items' => $order_items,
            'pages' => $pages,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'status' => $status,
            'search' => $search,
            'message' => $message,
            'products' => $products,
        ]);

    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        OrderItems::deleteAll(['order_id' => $id]);
        Yii::$app->session->setFlash('error', 'Удаленно!');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
