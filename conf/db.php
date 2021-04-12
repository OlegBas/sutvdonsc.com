<?php
/* localhost */
if(isset($_SERVER['WINDIR']))
{
    define("DB_SERVER", "localhost");
    define("DB_USER", "root");
    define("DB_PASSWORD", "");
    define("DB_NAME", "sut_bd");
    define("DB_CHARSET", "utf8");
}
else
{
    define("DB_SERVER", "");
    define("DB_USER", "");
    define("DB_PASSWORD", "");
    define("DB_NAME", "");
    define("DB_CHARSET", "utf8");
}
?>