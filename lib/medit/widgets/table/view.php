<?php
/**
 * Created by PhpStorm.
 * User: bioma_000
 * Date: 24.07.2016
 * Time: 17:39
 */

$file = $_FILES['file_csv']['tmp_name'];
$separator = ";";
// ��������� ���������� ����
if(!($fp = fopen($file,"rb")))
{
    echo "<p>���������� ������� ����.</p>";
    exit();
}
// ������ ���������� ����� � ������������� ����� - $buffer
$buffer = fread($fp,filesize($file));
// ��������� ����
fclose($fp);
// ���� ������� ������ �������, �������� �� ���������
$buffer = str_replace($separator.$separator, $separator."&nbsp;".$separator,$buffer);
$buffer = str_replace("\n".$separator,"\n&nbsp;".$separator, $buffer);
// �������� ������ ������� ���������
$buffer = str_replace("'", "`",$buffer);
// ��������� ���� �� �������, ������ ������ ����� �������� � ���������
// ������� �������������� ������� $strtmp
$tok = strtok($buffer,"\n");
$strtmp[] = $tok;
while ($tok)
{
    $tok = strtok("\n");
    $strtmp[] = $tok;
}
// �������� ������������ �������
$table = "<table>";
// ��������� ������ �� ��������� ������, ���������
// ����������� $separator
foreach($strtmp as $value)
{
    // ���� ������ ������ ������� �� �����
    if(trim($value)=="")break;
    // �������� ������������ ������ �������
    $table .= "<tr>";
    $strtmp = strtok($value,$separator);
    $table .= "<td>$strtmp</td>";
    while($strtmp = strtok($separator))
    {
        // �������� �������� � ������
        $table .= "<td>$strtmp</td>";
    }
    // ��������� ������������ ������ �������
    $table .= "</tr>";
}
// ����������� ������������ �������
$table .= "</table>";

print $table;