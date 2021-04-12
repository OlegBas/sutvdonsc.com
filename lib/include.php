<?
/**
 * @param $class_name
 * Aвтоматическое подключение классов библиотеки
 * классы библиотеки вызываются с префиксом mfw_
 */

function __autoload($class_name)
{
    $prefix = 'lib';

    /* проверяем является ли класс частью библиотеки */
    $parts = explode("_", $class_name);


    /* если нет префикса, игнорируем*/
    if(!isset($parts[0]) || !isset($parts[1]) || $parts[0] != $prefix) return;

    $file = LIB_DIR.'/'.$parts[1].'/'.$parts[1].'.class.php';

    /*проверяем наличие файла*/

    if(file_exists($file))
        include_once($file);
    else throw new Exception('Файл "'.strip_tags($file).'" библиотеки не найден');

}
?>