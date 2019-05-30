<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 27.05.2019
 * Time: 16:47
 */

namespace app\controllers;


use app\models\ProfileForm;
use app\models\RoomForm;
use app\models\Room;
use Yii;
use yii\base\Widget;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\web\Controller;

class CabinetController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index','profile','create-room','room'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }


    public function actionIndex()
    {
        $model = Room::rooms();

        return $this->render('index',['rooms'=> $model]);
    }

    public function actionProfile()
    {
        $form = new ProfileForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('profile', [
            'model' => $form,
        ]);

    }

    public function actionCreateRoom()
    {
        $form = new RoomForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {

             Room::create($form->name);
             Yii::$app->session->setFlash('su');

            return $this->redirect('index');
        }
        return $this->render('createRoom', [
            'model' => $form,
        ]);
    }

    public function actionRoom($name)
    {

//        if (!\Yii::$app->user->can('createRoom', ['news' => ])) {
////            throw new ForbiddenHttpException('Access denied');
////        }

        if (!\Yii::$app->user->can('viewRoom')) {
            Yii::$app->session->setFlash('Denied');

            return $this->redirect('/cabinet/index');
        }

        $model = Room::room($name);
        return $this->render('room', [
            'model' => $model,
        ]);
    }
}