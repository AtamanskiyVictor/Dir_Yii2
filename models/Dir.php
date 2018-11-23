<?php

namespace app\models;

use yii\base\Model;

class Dir extends Model
{
    private $dir_path = ".";

    // основная рекурсивная функция
    private function get_dir(string $path)
    {
      $arr_out = [];
      if (!is_dir($path)) return $arr_out;

      foreach (array_diff(scandir($path),[".",".."]) as $val) {
        $full_path = $path."/". $val;

        if (is_dir($full_path)) {
          $arr_out = array_merge ($this->get_dir ($full_path), $arr_out);;
          array_unshift($arr_out, $full_path);

        } else {
          $arr_out[]=$full_path;
        }
      }
      return $arr_out;
    }

    //устанавливаем существующий путь
    public function set_path($path)
    {
      if (!file_exists($path)) {
        $this->dir_path = ".";
      } else {
        $this->dir_path = $path;
      }
    }

    //возращяет массив файлов и каталогов с вложениями
    public function dir_all()
    {
      return $this->get_dir($this->dir_path);
    }

    // возращяет информацию по выбраному элементу
    public function dir_stat()
    {
      $dir_stat[0] = $this->dir_path;
      if($this->dir_path != ".") {
        $dir_stat[1] = is_dir($this->dir_path);
        $dir_stat[2] = stat($this->dir_path);
      }
      return $dir_stat;
    }
}
