<?php
/**
 * Created by PhpStorm.
 * User: Danila
 * Date: 09.01.2016
 * Time: 13:34
 */

require_once("modules/articles/init.php");







$email    = $_POST['gjxnf'];
$name     = $_POST['bvz'];
$phone    = $_POST['ntktajyt'];
$message  = $_POST['cjjotybt'];
$m        = $_POST['dfigjxnf'];
$theme        = $_POST['gfdsgfds'];
$form_id  = intval($_POST['form_id']);
$politic  = intval($_POST['fdsafdsafds']);

$signature   = md5($conf_medit['widgets']['feedback']['key'] . "&" . $email);

if($signature != $_POST['signature']) exit();


$reg = "/^[a-z0-9_\.-]{1,}@[0-9a-z_\.-]{1,}\.[a-z]{2,4}$/";


if(empty($name))    error_view("Пожалуйста, введите Ваше имя");
if(empty($phone))   error_view("Пожалуйста, введите Ваш телефон");
if(empty($message)) error_view("Пожалуйста, введите Ваше сообщение");
if(empty($m))    error_view("Пожалуйста, введите Ваш E-mail");
if(empty($theme))    error_view("Пожалуйста, введите категорию обращения");

$site = str_replace('www.', '', $_SERVER['HTTP_HOST']);
$site = str_replace('.ru',  '',  $site);

$vars = array('name'=>$name, 'phone'=>$phone, 'message'=>$message, 'mail'=>$m, 'site'=>$site,
    'theme'=> $theme, 'politic' => $politic);

$bodyMail = $TPL->get("email_message.php", $vars);


$list = lib_string::toArray($email);

foreach($list as $email)
{
    if(empty($email)) continue;




   // $mail = new lib_mail($email, "Сообщение с ".$site, $bodyMail, $site, $email);


  //  $mail->send();

    mail_send($email,"Сообщение с ".$site, $bodyMail);
}



print "<script>";
print "parent.document.feedback_form_".$form_id.".reset();";
print "alert('Сообщение отправлено!');";
print "</script>";


exit();


function error_view($error)
{
    print "<script>";
    print "alert('".$error."');";
    print "</script>";
    exit();
}


