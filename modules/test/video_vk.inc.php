<?php
/**
 * Created by PhpStorm.
 * User: bioma_000
 * Date: 24.01.2016
 * Time: 1:10
 */

$url = "http://vk.com/video-27433736_171344524";

$lib_vkVideo = new lib_vkVideo($url);

print "url: ".$url."<br />";
print "id: ".$lib_vkVideo->id."<br />";
print "oid: ".$lib_vkVideo->oid."<br />";
print "hash: ".$lib_vkVideo->hash."<br />";
print "UrlForIframe: ".$lib_vkVideo->getUrlForIframe()."<br />";
print $lib_vkVideo->player(640, 390);