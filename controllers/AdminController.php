<?php


namespace app\controllers;


use app\models\Image;
use app\models\Product;
use Codeception\Step\Comment;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\UploadedFile;

class AdminController extends Controller
{
    /**
     * {@inheritDoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'catalog', 'product-edit', 'product-delete'],
                'rules' => [
                    [
                        'actions' => ['logout', 'catalog', 'product-edit', 'product-delete', 'deleteProduct'],
                        'allow' => true,
                        'roles' => ['@'],
                    ]
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

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\web\CapthcaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'textme' : null,
            ],
        ];
    }

    public function actionCatalog()
    {
//        $query = Product::find();
//        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 5]);
//        $products = $query->offset($pages->offset)
//            ->limit($pages->limit)
//            ->orderBy(['id' => SORT_DESC])
//            ->all();
//
//        return $this->render('catalog', [
//            'products' => $products,
//            'pages' => $pages,
//        ]);

        $dataProvider = new ActiveDataProvider([
            'query' => Product::find(),
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        return $this->render('catalog', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionProductCreate()
    {
        $product = new Product();
        $image = new Image();

        if ($product->load(Yii::$app->request->post())) {
                $image->imageFile = UploadedFile::getInstance($image, 'imageFile');
                if ($image->save()) {
                    $product->image_id = $image->id;
                } else {
                    Yii::$app->session->setFlash('warning', 'Something goes wrong when upload image');
                }

            if ($product->save()) {
                //Yii::$app->session->setFlash('success', 'New product was added successufly');
                return $this->redirect(Url::to('site/index'));
            }
        }

        return $this->render('product-edit', [
            'product' => $product,
            'image' => $image,
        ]);
    }

    public function actionProductEdit($id)
    {
        $product = Product::getProductById($id);
        if (!isset($product)) {
            $this->redirect('/');
        }

        $image = Image::getOneById($product->image_id);
        if (!isset($image)) {
            $image = new Image();
        }


        if ($product->load(Yii::$app->request->post())) {
            $image = new Image();
            $image->imageFile = UploadedFile::getInstance($image, 'imageFile');
            if ($image->save()) {
                $image->deleteImageById($product->image_id);
                $product->image_id = $image->id;
            } else {
                Yii::$app->session->setFlash('warning', 'Something goes wrong when upload image');
            }

            if ($product->save()) {
                return $this->redirect(Url::to(['admin/catalog']));
            }
        }


        return $this->render('product-edit', [
            'product' => $product,
            'image' => $image,
        ]);
    }

    public function actionProductDelete($id)
    {
        $post = $_POST;
//        if ()

        return $this->render('index', [
            'post' => $post,
        ]);
    }
}