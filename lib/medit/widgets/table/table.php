<?php
/**
 * Created by PhpStorm.
 * User: bioma_000
 * Date: 24.07.2016
 * Time: 17:39
 */

$file = $_FILES['file_csv']['tmp_name'];
$separator = ";";
// Открываем переданный файл
if(!($fp = fopen($file,"rb")))
{
    echo "<p>Невозможно открыть файл.</p>";
    exit();
}
// Читаем содержимое файла в промежуточный буфер - $buffer
$buffer = fread($fp,filesize($file));
// Закрываем файл
fclose($fp);
// Если имеются пустые позиции, заменяем их прочерком
$buffer = str_replace($separator.$separator, $separator."-".$separator,$buffer);
$buffer = str_replace("\n".$separator,"\n-".$separator, $buffer);
// Заменяем прямые кавычки обратными
$buffer = str_replace("'", "`",$buffer);
// Разбиваем файл по строкам, каждую строку файла помещаем в отдельный
// элемент промежуточного массива $strtmp
$tok = strtok($buffer,"\n");
$strtmp[] = $tok;
while ($tok)
{
    $tok = strtok("\n");
    $strtmp[] = $tok;
}
// Начинаем формирование таблицы
$table = "<table class=articletable border=1 cellpadding=0 cellspacing=0 width=100% bordercolordark=white bordercolorlight=gray>";
// Разбиваем строку по отдельным словам, используя
// разделитель $separator
foreach($strtmp as $value)
{
    // Если строка пустая выходим из цикла
    if(trim($value)=="")break;
    // Начинаем формирование строки таблицы
    $table .= "<tr>";
    $strtmp = strtok($value,$separator);
    $table .= "<td>$strtmp</td>";
    while($strtmp = strtok($separator))
    {
        // Помещаем значение в ячейку
        $table .= "<td>$strtmp</td>";
    }
    // Завершаем формирование строки таблицы
    $table .= "</tr>";
}
// Заканчиваем формирование таблицы
$table .= "</table>";