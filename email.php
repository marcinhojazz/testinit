<?php
$Nome		= $_POST["Nome"];	// Pega o valor do campo Nome
$Fone		= $_POST["Fone"];	// Pega o valor do campo Telefone
$Email		= $_POST["Email"];	// Pega o valor do campo Email
$Servico	= $_POST["Servico"]; // Pega o valor escolhido em Serviços
$Mensagem	= $_POST["Mensagem"];	// Pega os valores do campo Mensagem

// echo $_POST['Servico'];
// die();

// Variável que junta os valores acima e monta o corpo do email

$Vai = 
		"Nome: $Nome\n
		E-mail: $Email\n
		Telefone: $Fone\n
		Servico: $Servico\n
		Mensagem: $Mensagem\n";

require_once("phpmailer/class.phpmailer.php");

define('GUSER', 'contato.alkimera@gmail.com');	// <-- Insira aqui o seu GMail
define('GPWD', 'alk@1234');		// <-- Insira aqui a senha do seu GMail

function smtpmailer($para, $de, $de_nome, $assunto, $corpo) { 
	global $error;
	$mail = new PHPMailer();
	$mail->IsSMTP();		// Ativar SMTP
	$mail->SMTPDebug = 1;		// Debugar: 1 = erros e mensagens, 2 = mensagens apenas
	$mail->SMTPAuth = true;		// Autenticação ativada
	$mail->SMTPSecure = 'ssl';	// SSL REQUERIDO pelo GMail
	$mail->Host = 'smtp.gmail.com';	// SMTP utilizado
	$mail->Port = 465;  		// A porta 587 deverá estar aberta em seu servidor
	$mail->Username = GUSER;
	$mail->Password = GPWD;
	$mail->SetFrom($de, $de_nome);
	$mail->Subject = $assunto;
	$mail->Body = $corpo;
	$mail->AddAddress($para);
	if(!$mail->Send()) {
		$error = 'Mail error: '.$mail->ErrorInfo; 
		return false;
	} else {
		$error = 'Mensagem enviada!';
		return true;
	}
}

// Insira abaixo o email que irá receber a mensagem, o email que irá enviar (o mesmo da variável GUSER), 
// o nome do email que envia a mensagem, o Assunto da mensagem e por último a variável com o corpo do email.

 if (smtpmailer('contato.alkimera@gmail.com', 'contato.alkimera@gmail.com', 'Site', 'Servico', $Vai)) {

	Header("location:http://127.0.0.1:5500/estudo-php/index.html"); // Redireciona para uma página de obrigado.

}
if (!empty($error)) echo $error;
?>