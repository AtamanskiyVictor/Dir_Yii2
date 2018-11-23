<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Dir;

class DirController extends Controller
{

  public function actionIndex($dir_path = '.')
  {
    $model = new Dir();

    $model->set_path($dir_path);

    return $this->render('dir',[
      'dir_all'=>$model->dir_all(),
      'dir_stat'=>$model->dir_stat()
    ]);
  }
}
