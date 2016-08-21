<?php
class MailData {
	public static $tablename = "";
	public $mail = null;

	public function open(){

    $this->mail = new PHPMailer();

    // ---------- adjust these lines ---------------------------------------
    		$email_user = Core::$email_user;//ConfigurationData::getByPreffix("email_user")->val;
    		$email_password = Core::$email_password;//ConfigurationData::getByPreffix("email_password")->val;
    $this->mail->Username = $email_user; // your GMail user name
    $this->mail->Password = $email_password; 
    //-----------------------------------------------------------------------
	//$this->mail->SMTPDebug = 1;
	$this->mail->SMTPSecure = 'ssl';
    $this->mail->Host = "smtp.gmail.com"; // GMail
    $this->mail->Port = 465;
    $this->mail->IsSMTP(); // use SMTP
    $this->mail->SMTPAuth = true; // turn on SMTP authentication
    $this->mail->From = $this->mail->Username;
	}

	public  function RegisterSuccess(){
    $this->mail->Subject = "Registro Exitoso";
    $this->mail->Body    = "Se ha creado tu cuenta en el sistema de coaching."; 
	}
	public function send(){
        if(Core::$send_alert_emails){
        $this->mail->AddAddress(ConfigurationData::getByPreffix("admin_email")->val); // recipients email
        $this->mail->Body .="<h1 style='color:#3498db;'>".ConfigurationData::getByPreffix("company_name")->val."</h1>";
        $this->mail->Body .= "<p>$this->message</p>";
        $this->mail->Body .= "<p>Usuario: ".Core::$user->name." ".Core::$user->lastname."</p>";
        $this->mail->Body .= "<p>Fecha y Hora: ".date("d-m-Y h:i:s")."</p>";
        $this->mail->Body .= "<p><i>".Core::$email_footer."</i></p>";
	    $this->mail->Send();
        }
	}



}

?>