<?php
class Persona
{
	private $pdo;
    
    public $Dni;
    public $Username;
    public $Password;
    public $Nombres;
    public $Apellidos;
    public $Direccion;
    public $Telefono;
    public $Email;
    public $Web;
    public $Nacimiento;
    public $Genero;
    public $Foto;
    public $Informacion;
    public $UltimaConexion;
    public $TipoUsuario;
    public $Fecha_Ingreso;
    public $Condicion_Laboral;
    public $Especialidad;
    public $Cargo_Id;
    public $Unidad_Id;



	public function __construct()
	{
		try
		{
			$this->pdo = Database::Conectar();     
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar($startFrom)
	{
		try
		{
			$limit = resultsPerPage;
			$start = $startFrom;
			$stmt = $this->pdo->prepare("SELECT * FROM Personas ORDER BY Apellidos ASC LIMIT :startFrom,:resultsPerPage");
			$stmt->bindValue(":startFrom", (int)$start, PDO::PARAM_INT);
			$stmt->bindValue(":resultsPerPage", (int)$limit, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($dni)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Personas WHERE Dni = ?");
			$stm->execute(array($dni));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function dniExists($dni){
		try 
			{
				$stmt = $this->pdo->prepare("SELECT * FROM Personas where Dni=:dni");
				$stmt->bindparam(":dni", $dni);
				$stmt->execute();
				if($stmt->rowCount() > 0){
					return true;
				}
				else{
					return false;
				}
			} 
			catch (Exception $e) 
			{
				die($e->getMessage());
			}
	}

	public function userExists($username){
		try 
			{
				$stmt = $this->pdo->prepare("SELECT * FROM Personas where Username=:username");
				$stmt->bindparam(":username", $username);
				$stmt->execute();
				if($stmt->rowCount() > 0){
					return true;
				}
				else{
					return false;
				}
			} 
			catch (Exception $e) 
			{
				die($e->getMessage());
			}
	}

	public function getTotalRecords(){
		try {
			$stm = $this->pdo->prepare("SELECT * FROM Personas");
			$stm->execute();
			return $stm->rowCount();
			
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Eliminar($dni)
	{
		try 
		{
			$stm = $this->pdo
			            ->prepare("DELETE FROM Personas WHERE dni = ?");
			$stm->execute(array($dni));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Persona $persona)
	{
		try 
		{
			$sql = "UPDATE Personas SET 
						Username          = ?, 
						Password = ?,
						Nombres        = ?,
                        Apellidos       = ?,
						Direccion            = ?, 
						Telefono = ?,
						Email = ?,
						Web = ?,
						Nacimiento = ?,
						Genero=?,
						Foto=?,
						Informacion=?,
						Fecha_Ingreso = ?,
						Condicion_Laboral = ?,
						Especialidad = ?,
						Cargo_Id = ?,
						Unidad_Id = ?
				    WHERE Dni = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                        $persona->Username, 
                        $persona->Password,
                        $persona->Nombres,
                        $persona->Apellidos,
                        $persona->Direccion,
                        $persona->Telefono,
                        $persona->Email,
                        $persona->Web,
                        $persona->Nacimiento,
                        $persona->Genero,
                        $persona->Foto,
                        $persona->Informacion,
                        $persona->Fecha_Ingreso,
                        $persona->Condicion_Laboral,
                        $persona->Especialidad,
                        $persona->Cargo_Id,
                        $persona->Unidad_Id,
                        $persona->Dni

					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Persona $persona)
	{
		try 
		{

			$newPassword = password_hash($persona->Password, PASSWORD_DEFAULT);
			$sql = "INSERT INTO Personas (Dni,Username,Password,Nombres,Apellidos,Direccion,Telefono, Email, Web, Nacimiento, Genero, UltimaConexion, Foto, Informacion, Fecha_Ingreso, Condicion_Laboral, Especialidad, Cargo_Id, Unidad_Id) 
			        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?,?,?,?,?)";

			$this->pdo->prepare($sql)
			     ->execute(
					array(
	                    $persona->Dni,
	                    $persona->Username, 
	                    $newPassword,
	                    $persona->Nombres, 
	                    $persona->Apellidos,
	                    $persona->Direccion,
	                    $persona->Telefono,
	                    $persona->Email,
	                    $persona->Web,
	                    $persona->Nacimiento,
	                    $persona->Genero,
	                    date('Y-m-d'),
	                    $persona->Foto,
	                    $persona->Informacion,
	                    $persona->Fecha_Ingreso,
	                    $persona->Condicion_Laboral,
	                    $persona->Especialidad,
	                    $persona->Cargo_Id,
	                    $persona->Unidad_Id
	                )
				);
		} catch (Exception $e) 
		{
			//echo $e->getMessage();
			die($e->getMessage());
		}
	}


	public function getUnidadesProductivas(){
			try
			{
				$stmt = $this->pdo->prepare("SELECT * FROM UnidadesProductivas ORDER BY Nombre ASC");
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_OBJ);
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}
		}

		public function getPersonas(){
			try
			{
				$stmt = $this->pdo->prepare("SELECT * FROM Personas ORDER BY Nombres ASC");
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_OBJ);
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}
		}

		public function getCargos(){
			try
			{
				$stmt = $this->pdo->prepare("SELECT * FROM Cargos ORDER BY Descripcion ASC");
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_OBJ);
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}
		}

		public function getUnidadById($Id){
			try 
			{
				$stm = $this->pdo
				            ->prepare("SELECT * FROM UnidadesProductivas WHERE Id = ?");			          

				$stm->execute(array($Id));
				$row = $stm->fetch(PDO::FETCH_ASSOC);
				return $row['Nombre'];
			}
			catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function getCargoById($Id){
			try 
			{
				$stm = $this->pdo
				            ->prepare("SELECT * FROM Cargos WHERE Id = ?");			          

				$stm->execute(array($Id));
				$row = $stm->fetch(PDO::FETCH_ASSOC);
				return $row['Descripcion'];
			}
			catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}
}