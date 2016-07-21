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
				$stmt = $this->pdo->prepare("SELECT Username, Password FROM Personas where Username=:username");
				$stmt->bindparam(":username", $usuario->Username);
				$stmt->execute();
				$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
				//printf($userRow['Username']);
				//printf($usuario->Password);
				//printf($userRow['Password']);
				if($stmt->rowCount() == 1)
				{
					if(password_verify($usuario->Password, $userRow['Password']))
					{
					//if ($usuario->Password == $userRow['Password']){
						printf("login success");
						$_SESSION['UserSession'] = $userRow['Username'];
						printf($_SESSION['UserSession']);
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
				echo $e->getMessage();
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
			return true;
		}
}