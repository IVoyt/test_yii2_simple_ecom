<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\ErrorAction;
use yii\captcha\CaptchaAction;

class SiteController extends Controller
{
    public $layout = 'product';

    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only'  => ['profile'],
                'rules' => [
                    [
                        'actions' => ['profile'],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'profile' => ['get'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions(): array
    {
        // $this->layout = 'main';
        return [
            'error'   => [
                'class' => ErrorAction::class,
            ],
            'captcha' => [
                'class'           => CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST
                    ? 'testme'
                    : null,
            ],
        ];
    }

    public function beforeAction($action)
    {
        if ($action instanceof ErrorAction) {
            $this->layout = 'main';
        }

        if (!parent::beforeAction($action)) {
            return false;
        }

        return true;
    }

    public function actionProfile(): string
    {
        return $this->render('profile', [
            'model' => Yii::$app->user->identity,
        ]);
    }
}
