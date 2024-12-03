<?php

use yii\db\Migration;
use yii\rbac\DbManager;

/**
 * Class m241130_182959_rbac_seed_permissions
 */
class m241130_182959_rbac_seed_permissions extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        /** @var DbManager $auth */
        $auth = Yii::$app->authManager;

        $crudPermission = $auth->createPermission('crud');
        $crudPermission->description = 'Create, Update, and Delete content';
        $auth->add($crudPermission);

        $userRole = $auth->createRole('user');
        $auth->add($userRole);
        $auth->addChild($userRole, $crudPermission);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        /** @var DbManager $auth */
        $auth = Yii::$app->authManager;
        $auth->removeAll();
    }
}
