<?php

namespace api\modules\magbat\controllers;

use api\modules\magbat\models\MagbatMagic;
use api\modules\magbat\models\MagbatMagicDirection;
use api\modules\magbat\models\MagbatUserMagicList;
use api\modules\magbat\models\MagbatUser;
use Yii;
use yii\db\Exception;
use yii\rest\Controller;

class MagicController extends Controller
{
    public function actionGetAllMagic()
    {
        return MagbatMagic::find()->all();
    }

    public function actionGetMyMagic()
    {
        $username = Yii::$app->request->post('username');

        $model = MagbatUser::find()->where(['username' => $username])->one();

        return $model->magbatUserMagicLists;
    }

    public function actionAddMyMagic()
    {
        $username = Yii::$app->request->post('username');
        $magicId = Yii::$app->request->post('magicId');

        $userModel = MagbatUser::find()->where(['username' => $username])->one();

        $userMagicListModel = MagbatUserMagicList::find()->where(['user_id' => $userModel->id])->andWhere(['magic_id' => $magicId])->one();
        if(!$userMagicListModel)
        {
            $userMagicListModel = new MagbatUserMagicList();
            $userMagicListModel->user_id = $userModel->id;
            $userMagicListModel->magic_id = $magicId;
            if($userMagicListModel->save())
                return true;
        }

        return false;
    }

    public function actionActivateMagic()
    {
        $username = Yii::$app->request->post('username');
        $magicId = Yii::$app->request->post('magicId');
        $magicStatus = Yii::$app->request->post('magicStatus');

        $userModel = MagbatUser::find()->where(['username' => $username])->one();
        $userMagicListModel = MagbatUserMagicList::find()->where(['user_id' => $userModel->id])->andWhere(['magic_id' => $magicId])->one();
        $userMagicListModel->status = $magicStatus;

        if($userMagicListModel->save())
            return true;
        return false;
    }

    public function actionCreateMagic()
    {
        $username = Yii::$app->request->post('username');
        $magicTitle = Yii::$app->request->post('magicTitle');
        $pointsJson = Yii::$app->request->post('points');
        $mp = Yii::$app->request->post('mp');
        $magicType = Yii::$app->request->post('magicType');

        $userModel = MagbatUser::find()->where(['username' => $username])->one();

        $transaction = Yii::$app->db->beginTransaction();

        try {

            $magicModel = new MagbatMagic();
            $magicModel->user_id = $userModel->id;
            $magicModel->type_id = $magicType;
            $magicModel->title = $magicTitle;
            $magicModel->mp = $mp;

            if($magicModel->save())
            {
                $points = json_decode($pointsJson);
                foreach ($points as $key => $point)
                {
                    $directionModel = new MagbatMagicDirection();
                    $directionModel->magic_id = $magicModel->id;
                    $directionModel->point = json_encode($point);
                    $directionModel->order = $key;
                    if(!$directionModel->save())
                        $transaction->rollback();
                }

                $myMagicModel = new MagbatUserMagicList();
                $myMagicModel->user_id = $userModel->id;
                $myMagicModel->magic_id = $magicModel->id;

                if(!$myMagicModel->save())
                    $transaction->rollback();

                $transaction->commit();
                return true;
            }
        }
        catch (Exception $e) {
            $transaction->rollback();
        }

        return false;
    }
}


