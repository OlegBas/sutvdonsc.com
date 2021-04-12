<?
class lib_javascript
{
    static public $files = array();


    /**
     * функция добавляет файл или код javascript
     * @param $js
     *
     */
    static public function add($js)
    {
        /*если файл, добавляем в массив*/
        if(preg_match("/.js$/", $js))
        {
            if(!in_array($js, self::$files)) self::$files[] = array($js, 'F');
        }
        else self::$files[] = array($js, 'C');

    }


    static public function get()
    {
        $out = '';

        foreach(self::$files as $js)
        {
            if(empty($js[0])) continue;
            if($js[1] == 'C') $out .= '<script>jQuery(function(){'.$js[0].'});</script>'.PHP_EOL;
            if($js[1] == 'F') $out .= '<script src="'.$js[0].'"></script>'.PHP_EOL;
        }


        return $out;
    }
}
?>