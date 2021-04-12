<?php

require_once(MODULE_DIR . DS . "articles/config.php");
$catalog = new lib_catalog("article_catalog", "article_catalog_cash", "article_catalog_link");

require_once(MODULE_DIR . DS . "/articles/function.php");
require_once(MODULE_DIR . DS . "/articles/article.class.php");
