<?php

/**
 * Created by PhpStorm.
 * User: Danila
 * Date: 08.01.2016
 * Time: 16:24
 */
class lib_Smpt
{

    private $server, $user, $password, $port;
    public $debag = false;
    private $header;

    function __construct($server, $user, $password, $port = 25)
    {
        $this->server   = $server;
        $this->user     = $user;
        $this->password = $password;
        $this->port     = $port;

    }

    public function  send($to, $subject, $message, $replyTo = null, $domen = null)
    {

        if(!$domen) $domen = $_SERVER['HTTP_HOST'];

        /*
                $SEND =	"Date: ".date("D, d M Y H:i:s") . " UT\r\n";
                $SEND .= 'Subject: =?utf-8?B?'.base64_encode($subject)."=?=\r\n";
                $SEND .= "Reply-To: ".$this->user."\r\n";
                $SEND .= "To: \"=?utf-8?B?".base64_encode($to)."=?=\" <$to>\r\n";
                $SEND .= "MIME-Version: 1.0\r\n";
                $SEND .= "Content-Type: text/html; charset=\"utf-8\"\r\n";
                $SEND .= "Content-Transfer-Encoding: 8bit\r\n";
                $SEND .= "From: \"=?utf-8?B?".base64_encode($domen)."=?=\" <".$this->ur.">\r\n";
                $SEND .= "X-Priority: 3\r\n\r\n";
        */

        $rtime = $_SERVER['REQUEST_TIME'];

        $form = (!$replyTo) ? $domen : $domen . " <".$replyTo.">";

        $this->addHeader("From: ".$form);
        $this->addHeader('X-Mailer: PHP/' . phpversion());
        $this->addHeader("MIME-Version: 1.0");
        $this->addHeader("Content-Type: text/html; charset=utf-8");
        $this->addHeader("X-PHP-Script: ".$domen." for 93.91.230.17, 93.91.230.17");
        $this->addHeader('Message-ID: <' . $rtime . md5($rtime) . '@' . $domen .'>');
        $this->addHeader("Date: ".date('r'));
        $this->addHeader("Subject: ".$subject);
        if($replyTo)$this->addHeader('Reply-To: '. $replyTo);
        $this->addHeader('To: '.$to);
        $this->addHeader('Content-Transfer-Encoding: 8bit:');


        //$this->header = $SEND;
        $errno  = null;
        $errstr = null;

               $smtp_conn = fsockopen($this->server, $this->port, $errno, $errstr, 10);

               if(!$smtp_conn) throw new Exception("cоединение с серверов не прошло");
               //$data = $this->geata($smtp_conn);


               //$this->command($smtp_conn, "EHLO ".$this->server, 250, "ошибка приветсвия EHLO");

               //$this->command($smtp_conn, "AUTH LOGIN", 334,   "сервер не разрешил начать авторизацию");

               //$this->command($smtp_conn, base64_encode($this->user), 334,   "ошибка доступа к такому юзеру");
               //$this->command($smtp_conn, base64_encode($this->password), 235,   "не правильный пароль");

               //$this->command($smtp_conn, "MAIL FROM: <".$this->user.">", 250,   "сервер отказал в команде MAIL FROM");

               //$this->command($smtp_conn, "RCPT TO: <".$to.">", 250,   "Сервер не принял команду RCPT TO");

               //$this->command($smtp_conn, "DATA", 354,   "сервер не принял DATA");

              // $this->command($smtp_conn, $this->header."\r\n".$message.PHP_EOL.".", 250,   "сервер не принял DATA");




               //fputs($smtp_conn, $this->header.PHP_EOL.$message.PHP_EOL);



               //fputs($smtp_conn,"QUIT\r\n");
               //fclose($smtp_conn);

        if( !$smtp_conn = fsockopen($this->server, $this->port, $errno, $errstr, 30) ) {
            if ($this->debag) echo $errno."<br>".$errstr;
            return false;
        }
        ;
        if (!$this->serverParse($smtp_conn, "220", __LINE__)) return false;
        /*
        fputs($smtp_conn, "HELO " . $this->server . "\r\n");
        if (!$this->serverParse($smtp_conn, "250", __LINE__)) {
            if ($this->debag) echo '<p>Не могу отправить HELO!</p>';
            fclose($smtp_conn);
            return false;
        }
        */
        $this->command($smtp_conn, "EHLO ".$this->server, 250, "ошибка приветсвия EHLO");
        $this->command($smtp_conn, "AUTH LOGIN", 334, "Не могу найти ответ на запрос авторизаци.");
        $this->command($smtp_conn, base64_encode($this->user), 334, "Логин авторизации не был принят сервером!");
        $this->command($smtp_conn, base64_encode($this->password), 235, "Пароль не был принят сервером как верный! Ошибка авторизации!");






        $this->command($smtp_conn, "MAIL FROM: <".$this->user.">", 250, "Не могу отправить комманду MAIL FROM");





        $this->command($smtp_conn, "RCPT TO: <" . $to . ">", 250, "Не могу отправить комманду RCPT TO");




        $this->command($smtp_conn, "DATA", 354, "Не могу отправить комманду DATA");




        $this->command($smtp_conn, $this->header.PHP_EOL.$message.PHP_EOL.".", 250, "Не смог отправить тело письма. Письмо не было отправленно!");

        fputs($smtp_conn, "QUIT\r\n");
        fclose($smtp_conn);

    }

    private function command($smtp_conn, $command, $checkCode, $error)
    {
        fputs($smtp_conn, $command.PHP_EOL);

        if (!$this->serverParse($smtp_conn, $checkCode, __LINE__))
        {
            if ($this->debag) throw new Exception($error);
            fclose($smtp_conn);
            return false;
        }
    }


    public function addHeader($header)
    {
        $this->header .= $header . PHP_EOL;
    }

    function serverParse($socket, $response, $line = __LINE__) {
        global $config;
        $server_response = null;

        while (@substr($server_response, 3, 1) != ' ') {
            if (!($server_response = fgets($socket, 256))) {
                if ($this->debag) echo "<p>Проблемы с отправкой почты!</p>$response<br>$line<br>";
                return false;
            }
        }
        if (!(substr($server_response, 0, 3) == $response)) {
            if ($config['smtp_debug']) echo "<p>Проблемы с отправкой почты!</p>$response<br>$line<br>";
            return false;
        }
        return true;
    }


}