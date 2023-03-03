<?php
//identificação para a chamada da classe

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

    require "PHPMailer/src/PHPMailer.php";
    require "PHPMailer/src/SMTP.php";
    include_once('../controllers/funcoes_db.php');


    function enviaEmail($email, $nome, $mensagem, $assunto, $email_resposta=null){

        // instanciando a classe
        $mail = new PHPMailer();

        // habilitando SMTP	
        $mail->isSMTP(); 

        // habilitando tranferêcia segura 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        // Pode ser: 0 = não exibe erros, 1 = exibe erros e mensagens, 2 = apenas mensagens	

        $mail->SMTPDebug = 0; // Debug

        // habilitando autenticação	
        $mail->SMTPAuth = true;

        // Configurações para utilização do SMTP do Gmail 

        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587; // porta gmail
        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ]
        ];

        $mail->Username = 'argelymanu@gmail.com'; ////Usuário para autenticação 
        $mail->Password = 'iitkhyfjybgkxgxw'; //senha autenticação

        // Remetente da mensagem - sempre usar o mesmo usuário da autenticação  
        $mail->setFrom('argelymanu@gmail.com','Site Casa Tramontini');

        // Endereço de destino do email
        $mail->addAddress($email, $nome );

        $mail->CharSet = "utf-8";

        // Endereço para resposta
        if($email_resposta)
        {
            $mail->addReplyTo($email_resposta);
        }
        // Assunto e Corpo do email
        $mail->Subject = $assunto;

        $mail->Body = $mensagem;

        $mail->isHTML(true);


        // Enviando o email
        if (!$mail->send()) {
            $retorno=false;
        } else {
            $retorno=$mensagem;
        }

    return $retorno;
    }

    function enviaEmailContato($email, $nome, $mensagem, $assunto, $email_resposta=null){

        // instanciando a classe
        $mail = new PHPMailer();

        // habilitando SMTP	
        $mail->isSMTP();

        // habilitando tranferêcia segura 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        // Pode ser: 0 = não exibe erros, 1 = exibe erros e mensagens, 2 = apenas mensagens	

        $mail->SMTPDebug = 0; // Debug

        // habilitando autenticação	
        $mail->SMTPAuth = true;

        // Configurações para utilização do SMTP do Gmail 

        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587; // porta gmail
        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ]
        ];

        $mail->Username = 'argelymanu@gmail.com'; ////Usuário para autenticação 
        $mail->Password = 'iitkhyfjybgkxgxw'; //senha autenticação

        // Remetente da mensagem - sempre usar o mesmo usuário da autenticação  
        $mail->setFrom($email,$nome);

        // Endereço de destino do email
        $mail->addAddress('argelymanu@gmail.com','Site Casa Tramontini');

        $mail->CharSet = "utf-8";

        // Endereço para resposta
        if($email)
        {
            $mail->addReplyTo($email);
        }
        // Assunto e Corpo do email
        $mail->Subject = $assunto;

        $mail->Body = $mensagem;

        $mail->isHTML(true);


        // Enviando o email
        if (!$mail->send()) {
            $retorno=false;
        } else {
            $retorno=$mensagem;
        }

    return $retorno;
    }

    function enviaEmailPromo($resultado, $mensagem, $assunto, $email_resposta=null){

        // instanciando a classe
        $mail = new PHPMailer();

        // habilitando SMTP	
        $mail->isSMTP();

        // habilitando tranferêcia segura 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        // Pode ser: 0 = não exibe erros, 1 = exibe erros e mensagens, 2 = apenas mensagens	

        $mail->SMTPDebug = 0; // Debug

        // habilitando autenticação	
        $mail->SMTPAuth = true;

        // Configurações para utilização do SMTP do Gmail 

        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587; // porta gmail
        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ]
        ];

        $mail->Username = 'argelymanu@gmail.com'; ////Usuário para autenticação 
        $mail->Password = 'iitkhyfjybgkxgxw'; //senha autenticação

        // Remetente da mensagem - sempre usar o mesmo usuário da autenticação  
        $mail->setFrom('argelymanu@gmail.com','Site Casa Tramontini');

        // Endereço de destino do email
        foreach($resultado as $linha){
            $mail->addAddress($linha['email'], $linha['nome'] );
        }
        

        $mail->CharSet = "utf-8";

        // Endereço para resposta
        if($email_resposta)
        {
            $mail->addReplyTo($email_resposta);
        }
        // Assunto e Corpo do email
        $mail->Subject = $assunto;

        $mail->Body = $mensagem;

        $mail->isHTML(true);


        // Enviando o email
        if (!$mail->send()) {
            $retorno=false;
        } else {
            $retorno=$mensagem;
        }

    return $retorno;
    }

?>