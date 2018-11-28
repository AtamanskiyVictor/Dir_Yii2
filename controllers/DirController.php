<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Dir;

class DirController extends Controller
{
    /**
     * Main action.
     * @param string $dir_path the input path.
     * @return Response
     */
    public function actionIndex($dir_path = '.')
    {
        $model = new Dir();

        $model->setPath($dir_path);

        return $this->render('dir',[
            'arDirAll'=>$model->getDirAll(),
            'arDirInfo'=>$model->getDirInfo()
        ]);
    }
}
