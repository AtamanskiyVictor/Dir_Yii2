<?php

\Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
\Yii::$app->response->getHeaders()->set('Content-Type', 'application/vnd.ms-excel');
//header("Content-type: application/vnd.ms-excel");

include("ex_header.inc");

$n = 0;
foreach($arr as $value)
{
    $n++;
    echo "<tr height=17 style='height:12.75pt'>";
    echo "<td class=xl28 align=left>$n</td>";
   	echo "<td class=xl28 align=left>$value</td>";
   	echo "<td class=xl28 align=left></td>";
  	echo "</tr>";
}

include("ex_footer.inc");

?>
