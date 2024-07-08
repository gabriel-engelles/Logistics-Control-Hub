<?php

namespace app\modules\api\controllers;

use yii\filters\AccessControl;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;


class DefaultController extends ActiveController{

   public function behaviors()
   {
      $behaviors = parent::behaviors();

      unset($behaviors['authenticator']);

        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::class,
        ];

        $behaviors['authentication'] = [
         'class' => CompositeAuth::class,
         'authMethods' => [
            HttpBearerAuth::class
         ]
      ];

      $behaviors['access'] = [
         'class' => AccessControl::class,
         'rules' => [
             [
               'actions' => ['index', 'create', 'update', 'delete', 'view', 'set-role'],
               'allow' => true,
               'roles' => ['admin'],
            ],
            [
               'actions' => [/* */],
               'allow' => true,
               'roles' => ['scheduler'],
            ],
            [
               'actions' => [/* */],
               'allow' => true,
               'roles' => ['delivery_man'],
            ],
         ]
      ];

      return $behaviors;
   }


}