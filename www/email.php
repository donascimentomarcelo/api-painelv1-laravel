<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");

$_POST = json_decode(file_get_contents('php://input'), true);

require 'phpmailer/phpmailer/PHPMailerAutoload.php';
 
$Mailer = new PHPMailer();
 
$Mailer->IsSMTP();
 
$Mailer->isHTML(true);
 
$Mailer->Charset = 'UTF-8';
 
$Mailer->SMTPAuth = true;
// $Mailer->SMTPDebug = true;
$Mailer->SMTPSecure = 'tsl';
$Mailer->Host = 'smtp.live.com';
$Mailer->Port = 587;
$Mailer->Username = 'marcelojunin2010@hotmail.com';
$Mailer->Password = '199400';
 
$Mailer->From = 'marcelojunin2010@hotmail.com';
 
$Mailer->FromName = 'Seu Nome';
 
$Mailer->Subject = 'Teste';
 
$Mailer->Body = 'Mensagem em HTML';
 
$Mailer->AltBody = 'Mensagem em texto';
 
// $Mailer->AddAddress('meu_amigo@dominio.com');
 
// $Mailer->AddAttachment('arquivo.pdf');

 
if ($Mailer->Send())
{
	echo "Enviado com sucesso";
}
else
{
	echo json_encode($Mailer->SMTPDebug);
}
