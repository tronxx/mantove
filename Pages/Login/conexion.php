<?php 
	class Db{
		private static $conexion=null;
		private function __construct(){}

		public static function conectar(){
			$user='root';
			$password='';
			$basedatos = 'dbname=mantove';
			$data_source='mysql:host=localhost';
			$miconexion_z = $data_source . ";" . $basedatos;
	
			$pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
			//self::$conexion=new PDO('mysql:host=localhost;dbname=mantove','root','',$pdo_options);
			//self::$conexion=new PDO('mysql:host=localhost;dbname=mantove',$user,$password,$pdo_options);
			self::$conexion=new PDO($miconexion_z,$user,$password,$pdo_options);
			return self::$conexion;
		}
	}
?>