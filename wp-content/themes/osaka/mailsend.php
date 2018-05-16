<?php 
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

$return = array("sended" => false);

if(!empty($_POST))
{
    $keys   = array("name", "email", "subject", "message", "to");
    $errors = false;
    foreach($keys as $_key)
    {
        if(empty($_POST[$_key]))
        {
            $errors = true;
        }
    }
    
    if(!$errors)
    {
        $to      = $_POST['to'];
        $subject = $_POST['subject'];
        $message = "from: ". $_POST['name'] . "\n\n" . $_POST['message'];
        $headers = 'From: ' . $_POST['email'] . "\r\n" .
            'Reply-To: ' . $_POST['email'] . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
        
        mail($to, $subject, $message, $headers);
        $return['sended'] = true;
    }
}

echo json_encode($return);