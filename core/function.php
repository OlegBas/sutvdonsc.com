<?

function is_admin()
{
    global $USER_IS;

    if($USER_IS) return true;
                 return false;
}

function admin_tools($ADMIN_BUTTONS)
{
    global $TPL;

    $out = '';

    $default = array
    (
        'type'        => 'button',
        'action'      => '#',
        'ico'         => '',
        'text'        => 'button',
        'align'       => 'left',
        'target'      => '_top',
        'window_size' => null
    );

    foreach ($ADMIN_BUTTONS as $item)
    {
        $item = array_merge ($default,$item);

        if($item['target'] == 'dialog') $item['action'] .= '&type=dialog';

        $tags = array
        (
            'ACTION'      =>  $item['action'],
            'ICO'         =>  $item['ico'],
            'TEXT'        =>  $item['text'],
            'ALIGN'       =>  $item['align'],
            'TARGET'      =>  $item['target'],
            'WINDOW_SIZE' =>  $item['window_size']

        );



        $out .= $TPL->get("admin_button/". $item['type'].'.php', $tags);
    }
    $tags = array("buttons" => $out);
    return $TPL->get("admin_tools.php", $tags);



}

function admin_tools_modules()
{
    $dir = MODULE_DIR;

    while ($module = readdir($dir))
    {
        $load = MODULE_DIR . DS . $module . DS . 'con';

        if(file_exists($load))
        {
            require_once($load);
        }
    }
}
/*
function mail_send($to,$subject, $message)
{
    try{
        $smpt = new lib_Smpt(SMPT_SERVER,SMPT_USER,SMPT_PASSWOER, SMPT_PORT);
        $smpt->debag = false;
        $smpt->send($to,$subject, $message,null, "");
    }catch (Exception $e)
    {
        print $e->getMessage();
    }
}

*/
function mail_send($to,$subject, $message)
{
    $mail = new lib_PHPMailer;
    $mail->isSMTP();
    $mail->Host     = SMPT_SERVER;
    $mail->Port     = SMPT_PORT;

    $mail->SMTPAuth  = true;
    $mail->Username  = SMPT_USER;
    $mail->Password  = SMPT_PASSWOER;

    //$mail->Mailer   = "smtp";
    //$mail->SMTPSecure = 'SSL';
    $mail->setFrom('robot@sutvdonsk.ru', 'Robot');
    $mail->CharSet = 'UTF-8';
    $mail->addAddress($to);


    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = $subject;
    $mail->Body = $message;


    if(!$mail->send()) {
        print $mail->ErrorInfo;
    }
}

?>