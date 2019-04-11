<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use Yii;
use app\models\User;
use yii\console\Controller;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class UserController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex($email, $username, $password)
    {
        $model = new User();
        $model->scenario = 'create';
        $model->username = $username;
        $model->email = $email;
        $model->password = $password;
        $model->is_active = User::IS_ACTIVE_TRUE;

        if ($model->validate()) {
            $model->save();
            $this->stdout('User has been created' . "!\n", 4);
        } else {
            $this->stdout(json_encode($model->getErrors()) . "\n", 3);
        }
    }

}
