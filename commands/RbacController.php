<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
/**
 * Инициализатор RBAC выполняется в консоли php yii rbac/init
 */
class RbacController extends Controller {

    public function actionInit() {
        $auth = Yii::$app->authManager;

        $auth->removeAll(); //На всякий случай удаляем старые данные из БД...

        // Создадим роли админа и редактора новостей
        $admin = $auth->createRole('admin');
        $author = $auth->createRole('author');
        $auditor = $auth->createRole('auditor');
        $moderator =  $auth->createRole('moderator');
        $manager  = $auth->createRole('manager');
        $user = $auth->createRole('user');

        // запишем их в БД
        $auth->add($admin);
        $auth->add($author);
        $auth->add($auditor);
        $auth->add($moderator);
        $auth->add($manager);
        $auth->add($user);


        // Создаем наше правило, которое позволит проверить автора новости
        $authorRule = new \app\rbac\AuthorRule;

        // Запишем его в БД
        $auth->add($authorRule);

        // Создаем разрешения. Например, просмотр админки viewAdminPage и редактирование новости updateNews
        $viewAdminPage = $auth->createPermission('viewAdminPage');
        $viewAdminPage->description = 'Просмотр админки';

        $createRoom = $auth->createPermission('createRoom');
        $createRoom->description = 'Создания Room';

        $updateRoom = $auth->createPermission('updateRoom');
        $updateRoom->description = 'Редактирование Room';

        $viewRoom = $auth->createPermission('viewRoom');
        $viewRoom->description = 'Просмотр Room';



        // Запишем эти разрешения в БД
        $auth->add($viewAdminPage);
        $auth->add($createRoom);
        $auth->add($updateRoom);
        $auth->add($viewRoom);


        // Теперь добавим наследования. Для роли editor мы добавим разрешение updateNews,
        // а для админа добавим наследование от роли editor и еще добавим собственное разрешение viewAdminPage

        // Роли «Редактор новостей» присваиваем разрешение «Редактирование новости»
        $auth->addChild($author,$updateRoom);
        $auth->addChild($author,$viewRoom);

        //$auth->addChild($user,$viewRoom);

        // админ наследует роль редактора новостей. Он же админ, должен уметь всё! :D
        $auth->addChild($admin, $author);

        // Еще админ имеет собственное разрешение - «Просмотр админки»
        $auth->addChild($admin, $viewAdminPage);

        // Назначаем роль admin пользователю с ID 1
        $auth->assign($admin, 1);

        // Назначаем роль editor пользователю с ID 2
        $auth->assign($author, 2);
    }
}