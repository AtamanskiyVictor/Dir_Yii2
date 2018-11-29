<?php
//dev
/* @var $arDirAll[]  */
/* @var $arDirInfo[]  */

use yii\helpers\Url;

$this->title = 'My Dir';

?>

<div class="container">
<?php
    echo '<h3><a href=', Url::to(['dir/index']), '>Корневой каталог</a></h3>';
    echo '<h2>Выбранный ресурс: ', $arDirInfo[0], "</h2>", PHP_EOL;

    if(isset($arDirInfo[1])) {
        echo '<div>Тип: ', $arDirInfo[1]==1 ? 'Каталог' : 'Файл';
        echo '<br>ID Владельца: ', $arDirInfo[2]["uid"];
        echo '<br>Размер: ', $arDirInfo[2]["size"], " байт";
        echo '<br>Изменен: ', date("d.m.Y  H:i:s.", $arDirInfo[2]["ctime"]), "</div>", PHP_EOL;
    }

    if ($arDirAll) echo '<h4>Содержит: </h4>', '<a href="', Url::to(['dir/export', 'dir_path' => $arDirInfo[0]]), "\" target='_blank'>Export</a><br>", PHP_EOL;

    foreach ($arDirAll as $value) {
        echo '<a href="', Url::to(['dir/index', 'dir_path' => $value]), "\" target='_blank'>$value</a><br>", PHP_EOL;
    }

?>
</div>
