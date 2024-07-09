<?php

namespace app\modules\api\controllers;

use Yii;
use amnah\yii2\user\models\UserToken;
use app\models\Role;
use app\models\User;
use yii\web\BadRequestHttpException;
use yii\web\ServerErrorHttpException;

class UserController extends DefaultController
{
    public $modelClass = 'app\models\User';

    public function actionRegister()
    {
        $user = new User();
        $post = Yii::$app->request->post();

        if (!$post) {
            throw new ServerErrorHttpException('Error creating user');
        }

        // Load
        if ($user->load($post, '')) {
            // Validation
            if ($user->validate()) {
                
                $roleId = $post['role_id'] ?? Role::ROLE_DELIVERY_MAN;

                // Check roleId
                if (!in_array($roleId, Role::getValidRoleIds())) {
                    throw new BadRequestHttpException('Invalid Role.');
                }

                $user->setRegisterAttributes($roleId);

                if ($user->save()) {
                    $this->afterRegister($user);
                } else {
                    throw new ServerErrorHttpException('Failed to save user');
                }
            } else {
                throw new BadRequestHttpException('Validation failed: ' . json_encode($user->errors));
            }
        } else {
            throw new BadRequestHttpException('Failed to load user data');
        }

        return $user;
    }

    protected function afterRegister($user)
    {
        /** @var \amnah\yii2\user\models\UserToken $userToken */
        $userToken = new UserToken();

        // determine userToken type to see if we need to send email
        $userTokenType = null;
        if ($user->status == $user::STATUS_INACTIVE) {
            $userTokenType = $userToken::TYPE_EMAIL_ACTIVATE;
        } elseif ($user->status == $user::STATUS_UNCONFIRMED_EMAIL) {
            $userTokenType = $userToken::TYPE_EMAIL_CHANGE;
        }

        // checks if we have a userToken type to process or login user directly
        if ($userTokenType) {
            $userToken = $userToken::generate($user->id, $userTokenType);
            if (!$user->sendEmailConfirmation($userToken)) {
                // handle email error
                // Yii::$app->session->setFlash("Email-error", "Failed to send email");
            }
        } else {
            Yii::$app->user->login($user);
        }
    }
}
