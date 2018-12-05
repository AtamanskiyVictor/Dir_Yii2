<?php
namespace app\models;

use yii\base\Model;
use yii\data\ArrayDataProvider;
use yii\helpers\Url;

class Dir extends Model
{
    private $strPath;
    private $intId;

    function __construct($path = ".") {
        $this->setPath($path);
    }

    /**
     * Main recursion function
     * @param string $path the input path.
     * @param int $parentId Id of parent dir.
     * @return array the full path all files & dir in path.
     */
    private function getDir($path, $parentId)
    {
        $arDir = [];
        if (!is_dir($path)) return $arDir;

        foreach (array_diff (scandir($path) , [".",".."]) as $value) {
            $strFullPath = $path ."/". $value;

            $this->intId++;
            $row = [
                'id'=>$this->intId,
                'parentId'=>$parentId,
                'path'=>$strFullPath,
                //'title'=>$value;
                'title'=>'<a href="' . Url::to(['dir/index', 'dir_path' => $strFullPath]) . "\" target='_blank'>".$value."</a>"];

            if (is_dir ($strFullPath) ) {
                /*$arDir = array_merge ($this->getDir ($strFullPath, $this->intId), $arDir);
                array_unshift($arDir, $row);
                */
                $arDir[] = $row + ['folder'=>'true', 'children' => $this->getDir ($strFullPath, $this->intId)];
            } else {
                $arDir[] = $row;
            }
        }
        return $arDir;
    }

    /**
     * Set $this->strPath
     * @param string $path the input path.
     */
    public function setPath($path)
    {
        $this->strPath = file_exists($path) ? $path : "." ;
    }


    /**
     * @return array the full path all files & dir's in $this->strPath.
     */
    public function getDirAll()
    {
        $this->intId = 1;
        return $this->getDir($this->strPath, 1);
    }


    /**
     * @return array the full path all files as arrayDataProvider
     */
    public function getDirDP()
    {
        return new ArrayDataProvider([
            'allModels'=>$this->getDirAll($this->strPath),
            'pagination' => false
        ]);
    }


    /**
     * @return array info of $this->strPath.
     */
    public function getDirInfo()
    {
        $arDirInfo[0] = $this->strPath;
        if($this->strPath != ".") {
            $arDirInfo[1] = is_dir($this->strPath);
            $arDirInfo[2] = stat($this->strPath);
        }
        return $arDirInfo;
    }

}
