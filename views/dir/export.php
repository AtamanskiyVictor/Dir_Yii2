<?php

\Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
\Yii::$app->response->getHeaders()->set('Content-Type', 'application/vnd.ms-excel');
//header("Content-type: application/vnd.ms-excel");

include("ex_header.inc");

foreach($arr as $value)
{
    echo "<tr height=17 style='height:12.75pt'>";

    foreach($value as $val)
        {
            if (!is_array($val)) echo "<td class=xl28 align=left>", $val, "</td>";
        }

    echo "</tr>";
}

include("ex_footer.inc");

?>
