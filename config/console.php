<?php

use antonyz89\seeder\SeederController;
use diecoding\seeder\TableSeeder;
use yii\log\FileTarget;
use yii\caching\FileCache;
use yii\redis\Connection;

$params = require __DIR__ . '/params.php';
$db     = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/db.php',
    require __DIR__ . '/db_local.php',
);

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@tests' => '@app/tests',
        '@console' => '@app/console'
    ],
    'components' => [
        'cache' => [
            'class' => FileCache::class,
        ],
        'log' => [
            'targets' => [
                [
                    'class' => FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'redis' => [
            'class' => Connection::class,
            'hostname' => 'localhost',
            'port' => 6379,
            'database' => 0,
        ],
    ],
    'params' => $params,
    'controllerMap' => [
        // 'fixture' => [ // Fixture generation command line.
        //     'class' => 'yii\faker\FixtureController',
        // ],
        'seeder' => [
            'class'                => SeederController::class,

            /** @var string the default command action. */
            'defaultAction'        => 'seed',

            /** @var string seeder path, support path alias */
            'seederPath'           => '@console/seeder',

            /** @var string tables path, support path alias */
            'tablesPath'           => '@console/seeder/tables',

            /** @var string seeder table namespace */
            'tableSeederNamespace' => 'console\seeder\tables',

            /** @var string model namespace */
            'modelNamespace'       => 'app\models',
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
    // configuration adjustments for 'dev' environment
    // requires version `2.1.21` of yii2-debug module
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
