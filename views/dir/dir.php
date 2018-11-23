<?php
  $this->title = 'My Dir';
?>

<div class="container">
<?php

  echo "<H3><a href='/index.php?r=dir'>Корневой каталог</a></H3>";
  echo "<H2>Выбранный ресурс: " . $dir_stat[0] . "</H2>\n";

  if(isset($dir_stat[1])) {
    echo "<div>Тип: ";
    echo ($dir_stat[1]==1) ? "Каталог" : "Файл";
    echo "<br>ID Владельца: " . $dir_stat[2]["uid"];
    echo "<br>Размер: " . $dir_stat[2]["size"] . " байт";
    echo "<br>Изменен: " . date("d.m.Y  H:i:s.",$dir_stat[2]["ctime"]) . "</div>\n";
  }

  if ($dir_all) echo "<br>Содержит: <br>" ;

  foreach ($dir_all as $value) {
    echo "<a href=/index.php?r=dir&dir_path=" .$value. " target='_blank'>". $value . "</a><br>\n";
  }

?>
</div>
