<?php
	
	class Usuario
	{
		private $pdo;
	    

	    public $Username;
	    public $Password;
	    public $UltimaConexion;

		public function __construct()
		{
			try
			{
				$this->pdo = Database::Conectar();
			}
			catch(Exception $e)
			{
				die("Error al conectar a la Base de datos.");
				//die($e->getMessage());
			}
		}

		public function Registrar(Usuario $user)
		{
			try 
			{
				$new_password = password_hash($user->Password, PASSWORD_DEFAULT);

				$sql = "INSERT INTO Personas (Username,Password, UltimaConexion) 
				        VALUES (?, ?, ?)";

				$this->pdo->prepare($sql)
				     ->execute(
						array(
		                    $user->Username,
		                    $new_password,
		                    date('Y-m-d')	
		                )
					);
			} 
			catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Login($usuario)
		{
			try
			{
				$stmt = $this->pdo->prepare("SELECT Dni, Username, Password, TipoUsuario FROM Personas where Username=:username");
				$stmt->bindparam(":username", $usuario->Username);
				$stmt->execute();
				$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
				if($stmt->rowCount() == 1)
				{
					if(password_verify($usuario->Password, $userRow['Password']))
					{
					//if ($usuario->Password == $userRow['Password']){
						if ($userRow['TipoUsuario'] == 0){
							$stmtUnidad = $this->pdo->prepare("SELECT Id, Nombre FROM UnidadesProductivas where Persona_Dni=:personaDni");
							$stmtUnidad->bindparam(":personaDni", $userRow['Dni']);
							$stmtUnidad->execute();
							$unidadRow=$stmtUnidad->fetch(PDO::FETCH_ASSOC);	
							if  ($stmtUnidad->rowCount() > 0){
								$_SESSION['Unidad_Id'] = $unidadRow['Id'];
								$_SESSION['UnidadNombre'] = $unidadRow['Nombre'];
								$_SESSION['NoUnidad'] = "0";
							}
							else{
								$_SESSION['NoUnidad'] = "1";
								return false;
							}
						
						}
						$_SESSION['UserSession'] = $userRow['Username'];
						$_SESSION['UserDni'] = $userRow['Dni'];
						$_SESSION['TipoUsuario'] = $userRow['TipoUsuario'];
						return true;
	
					}
					else
					{
						return false;
					}
				}

			}
			catch(PDOException $e)
			{
				die($e->getMessage());
			}
		}

		public function isLoggedIn()
		{
			if(isset($_SESSION['UserSession']))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		
		public function redirect($url)
		{
			header("Location: $url");
		}
		
		public function Logout()
		{
			session_destroy();
			unset($_SESSION['UserSession']);
			unset($_SESSION['UserDni']);
			unset($_SESSION['TipoUsuario']);
			unset($_SESSION['Unidad_Id']);
			unset($_SESSION['UnidadNombre']);
			unset($_SESSION['NoUnidad']);
			return true;
		}
}