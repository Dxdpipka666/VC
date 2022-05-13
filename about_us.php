<?php

    session_start();
    unset ($_SESSION['username']);
    unset ($_SESSION['from_email']);
    unset ($_SESSION['message_subject']);
    unset ($_SESSION['your_message']);

    unset ($_SESSION['error_username']);
    unset ($_SESSION['error_from_email']);
    unset ($_SESSION['error_message_subject']);
    unset ($_SESSION['error_your_message']);;





    function redirect(){
        header('Location:/HTML/contacts.php');
        exit;
    }

    $user_name = htmlspecialchars(trim($_POST['username'])); // htmlspecialchars в качестве параметра принимает строку и удалает все теги html
    $from_email = htmlspecialchars(trim($_POST['from_email']));
    $message_subject = htmlspecialchars(trim($_POST['message_subject']));
    $your_message = htmlspecialchars(trim($_POST['your_message']));

    $_SESSION['username'] = $user_name;
    $_SESSION['from_email'] = $from_email;
    $_SESSION['message_subject'] = $message_subject;
    $_SESSION['your_message'] = $your_message;
    // сессии нужны, чтобы сохрнать данные, которые ввели
    if (strlen($user_name) <=4){
        $_SESSION['error_username'] = "Enter correct name";
        redirect();
    }
    elseif (strlen($from_email) <5 || strpos($from_email, "@") == false){
        $_SESSION['error_from_email'] = "Entered incorrect email";
        redirect();
    }
    elseif (strlen($message_subject) <= 10){
        $_SESSION['error_message_subject'] = "The subject line must before than 10 long";
        redirect();
    }
    elseif (strlen($your_message) <= 10){
        $_SESSION['error_your_message'] = "The subject line must before than 15 long";
        redirect();
    }
    else{
        $from = "dxdpika@yandex.ru";
        $subject = "Тема сообщение";
        $message = 'Message';
        $subject = "=?utf-8?B?".base64_decode($subject). "?=";
        $headers = "From: $from\r\nReply-to: $from\r\nContent-type:text/plan; charset=utf-8\r\n";
        mail("dxdpika@yandex.ru",$subject, $message, $headers );
        $_SESSION['success_mail'] = "You success spent mail";
        redirect();

    }

?>