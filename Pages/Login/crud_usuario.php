<?php 
	require_once('conexion.php');
	require_once('usuario.php');
	
	class CrudUsuario{

		public function __construct(){}

		//inserta los datos del usuario
		public function insertar($usuario){
			$db=DB::conectar();
			$insert=$db->prepare('INSERT INTO USUARIOS VALUES(NULL,:login, :clave)');
			$insert->bindValue('login',$usuario->getNombre());
			//encripta la clave
			$pass=password_hash($usuario->getClave(),PASSWORD_DEFAULT);
			$insert->bindValue('clave',$pass);
			$insert->execute();
		}

		//obtiene el usuario para el login
		public function obtenerUsuario($login, $clave){
			$db=Db::conectar();
			$select=$db->prepare('SELECT * FROM CAR_USUARIOS WHERE LOGIN=:login');//AND clave=:clave
			$select->bindValue('login',$login);
			$select->execute();
			$registro=$select->fetch();
			$usuario=new Usuario();
			//verifica si la clave es conrrecta
			//echo "Login:" . $login . "<br> Clave:" . $clave . "<br> Registro[CLAV]:" . $registro['CLAVE'] . "<br>";
		if ($clave == $registro['CLAVE']) {				
				//if (password_verify($clave, $registro['clave'])) {				
					//si es correcta, asigna los valores que trae desde la base de datos
				$usuario->setId($registro['IDUSUARIO']);
				$usuario->setNombre($registro['LOGIN']);
				$usuario->setClave($registro['CLAVE']);
			}			
			return $usuario;
		}

		//busca el nombre del usuario si existe
		public function buscarUsuario($login){
			$db=Db::conectar();
			$select=$db->prepare('SELECT * FROM USUARIOS WHERE login=:login');
			$select->bindValue('login',$login);
			$select->execute();
			$registro=$select->fetch();
			if($registro['Idusuario']!=NULL){
				$usado=False;
			}else{
				$usado=True;
			}	
			return $usado;
		}
	}
?>