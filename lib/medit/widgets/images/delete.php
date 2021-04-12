<?
/**@TODO удаление изображений */
$conf = $this->conf['widgets']['images'];

$sql = "SELECT ".$conf['dbRow']." FROM `".$conf['dbTable']."` WHERE `".$conf['dbId_group']."`=?";

$result = $this->db->query($sql, $id);

while($row = $this->db->fetch_array($result))
{
    @unlink($conf['path'].'/'. $row[0]);
}

?>