<?php


// 14 de Abril del 2014
// Core.php
// @brief obtiene las configuraciones, muestra y carga los contenidos necesarios.
// actualizado [11-Aug-2016]
class Core {
	public static $user = null;
	public static $debug_sql = false;

	public static $email_user ="softreligion@gmail.com";
	public static $email_password ="l00lapal00za";

	public static $pdf_footer = "Generado por el Sistema Inventio Max v6";
	public static $email_footer = "Correo generado Automaticamente por el Sistema Inventio Max v6";

	public static $pdf_table_fillcolor = "[100, 100, 100]";
	public static $pdf_table_column_fillcolor = "255";
	public static $send_alert_emails = true; // enviar correos de alerta (ventas,abastecimientos, etc) -> MailData->send()

	public static function includeCSS(){
		$path = "res/css/";
		$handle=opendir($path);
		if($handle){
			while (false !== ($entry = readdir($handle)))  {
				if($entry!="." && $entry!=".."){
					$fullpath = $path.$entry;
				if(!is_dir($fullpath)){
						echo "<link rel='stylesheet' type='text/css' href='".$fullpath."' />";

					}
				}
			}
		closedir($handle);
		}

	}

	public static function alert($text){
		echo "<script>alert('".$text."');</script>";
	}

	public static function redir($url){
		echo "<script>window.location='".$url."';</script>";
	}

	public static function includeJS(){
		$path = "res/js/";
		$handle=opendir($path);
		if($handle){
			while (false !== ($entry = readdir($handle)))  {
				if($entry!="." && $entry!=".."){
					$fullpath = $path.$entry;
				if(!is_dir($fullpath)){
						echo "<script type='text/javascript' src='".$fullpath."'></script>";

					}
				}
			}
		closedir($handle);
		}

	}

}



?>