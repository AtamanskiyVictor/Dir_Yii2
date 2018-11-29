<?php
namespace app\models;

use yii\base\Model;

class Dir extends Model
{
    private $dir_path;

    function __construct($path = ".") {
        $this->setPath($path);
    }

    /**
     * Main recursion function
     * @param string $path the input path.
     * @return array the full path all files & dir in path.
     */
    private function getDir(string $path)
    {
        $arDir = [];
        if (!is_dir($path)) return $arDir;

        foreach (array_diff (scandir($path) , [".",".."]) as $value) {
            $strFullPath = $path."/". $value;

            if (is_dir ($strFullPath) ) {
                $arDir = array_merge ($this->getDir ($strFullPath), $arDir);;
                array_unshift($arDir, $strFullPath);
            } else {
                $arDir[] = $strFullPath;
            }
        }
        return $arDir;
    }

    /**
     * Set $this->dir_path
     * @param string $path the input path.
     */
    public function setPath($path)
    {
        if (!file_exists($path)) {
            $this->dir_path = ".";
        } else {
            $this->dir_path = $path;
        }
    }

    /**
     * @return array the full path all files & dir's in $this->dir_path.
     */
    public function getDirAll()
    {
        return $this->getDir($this->dir_path);
    }

    /**
     * @return array info of $this->dir_path.
     */
    public function getDirInfo()
    {
        $arDirInfo[0] = $this->dir_path;
        if($this->dir_path != ".") {
            $arDirInfo[1] = is_dir($this->dir_path);
            $arDirInfo[2] = stat($this->dir_path);
        }
        return $arDirInfo;
    }

}
