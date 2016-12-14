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

	public function ListarByUnidad($startFrom,$Id)
	{
		try
		{
			$limit = resultsPerPage;
			$start = $startFrom;
			$stmt = $this->pdo->prepare("SELECT * FROM Personas where Unidad_Id=:unidad_Id ORDER BY Apellidos ASC LIMIT :startFrom,:resultsPerPage");
			$stmt->bindValue(":unidad_Id", $Id, PDO::PARAM_INT);
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

	public function Buscar($startFrom, $busqueda)
	{
		try
		{
			$limit = resultsPerPage;
			$start = $startFrom;
			$busqueda = '%'.$busqueda.'%';
			$stmt = $this->pdo->prepare("SELECT * FROM Personas where Nombres LIKE :busqueda or Apellidos LIKE :busqueda ORDER BY Apellidos ASC LIMIT :startFrom,:resultsPerPage");
			$stmt->bindparam(":busqueda", $busqueda);
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

	public function Listar($startFrom)
	{
		if (isset($_SESSION['Unidad_Id']))
		{
			$unidadID = intval($_SESSION['Unidad_Id']);
			return $this->ListarByUnidad($startFrom,$unidadID);
		}
		else
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

	public function getTotalRecordsBusqueda($busqueda){
		try {
			if ($busqueda!='')
			{
				$busqueda = '%'.$busqueda.'%';
				$stmt = $this->pdo->prepare("SELECT * FROM Personas where Nombres LIKE :busqueda or Apellidos LIKE :busqueda");
				$stmt->bindparam(":busqueda", $busqueda);
				$stmt->execute();
				return $stmt->rowCount();
			} else {
				$stmt = $this->pdo->prepare("SELECT * FROM Personas");
				$stmt->execute();
				return $stmt->rowCount();
			}
			
			
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Eliminar($dni)
	{
		try 
		{
			$fotoPath = $this->Obtener($dni)->Foto;
			$stm = $this->pdo
			            ->prepare("DELETE FROM Personas WHERE dni = ?");
			$stm->execute(array($dni));
			unlink($fotoPath); //Eliminar la foto de perfil
			return true;
		} 
		catch(PDOException $e)
		{
			return false;
			//die("La persona que deseas eliminar es responsable de una unidad, asigne otro responsable");
		}
		catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Persona $persona)
	{
		if (strlen($persona->Password)<22)
		{
			$persona->Password = password_hash($persona->Password, PASSWORD_DEFAULT);
		}		
		try 
		{
			if ($persona->Foto!=null){
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
				    if (!move_uploaded_file($_FILES['Foto']['tmp_name'], $persona->Foto))
					{
						die("Error al subir la imagen al servidor, puede que no tenga permisos para escribir en el directorio.");
					}

			} else {
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
	                        $persona->Informacion,
	                        $persona->Fecha_Ingreso,
	                        $persona->Condicion_Laboral,
	                        $persona->Especialidad,
	                        $persona->Cargo_Id,
	                        $persona->Unidad_Id,
	                        $persona->Dni
						)
					);

			}

			
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Persona $persona)
	{
		try 
		{
			$this->pdo->beginTransaction();
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
			$this->pdo->commit();
			if ($persona->Foto!=null)
			{
				if (!move_uploaded_file($_FILES['Foto']['tmp_name'], $imagePath))
				{
					die("Error al subir la imagen al servidor, puede que no tenga permisos para escribir en el directorio.");
				}	
			}
		} catch (Exception $e) 
		{
			$this->pdo->rollback();
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