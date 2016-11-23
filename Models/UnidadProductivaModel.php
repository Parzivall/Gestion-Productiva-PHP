<?php

	class UnidadProductiva
	{
		private $pdo;
	    
	    public $Id;
	    public $Nombre;
	    public $Rubro_Id;
	    public $Web;
	    public $Telefono;
	    public $Telefono_Anexo;
	    public $Fax;
	    public $Celular;
	    public $Ubicacion;
	    public $Ciudad_Id;
	    public $Organigrama;
	    public $Persona_Dni;

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
				$stmt = $this->pdo->prepare("SELECT * FROM UnidadesProductivas ORDER BY Nombre ASC LIMIT :startFrom,:resultsPerPage");
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

		public function getAll(){
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


		public function Buscar($startFrom, $busqueda)
		{
			try
			{
				$limit = resultsPerPage;
				$start = $startFrom;
				$busqueda = '%'.$busqueda.'%';
				$stmt = $this->pdo->prepare("SELECT * FROM UnidadesProductivas where Nombre LIKE :busqueda ORDER BY Nombre ASC LIMIT :startFrom,:resultsPerPage");
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


		public function Obtener($Id)
		{
			try 
			{
				$stm = $this->pdo
				          ->prepare("SELECT * FROM UnidadesProductivas WHERE Id = ?");
				          

				$stm->execute(array($Id));
				return $stm->fetch(PDO::FETCH_OBJ);
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function nameExists($nombre){
			try 
				{
					$stmt = $this->pdo->prepare("SELECT * FROM UnidadesProductivas where Nombre=:nombre");
					$stmt->bindparam(":nombre", $nombre);
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

		public function getRubros(){
			try
			{
				$stmt = $this->pdo->prepare("SELECT * FROM Rubros ORDER BY Descripcion ASC");
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_OBJ);

			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}
		}

		public function getCiudades(){
			try
			{
				$stmt = $this->pdo->prepare("SELECT * FROM Ciudades ORDER BY Nombre ASC");
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_OBJ);

			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}
		}

		public function getResponsableByDni($Dni){
			try 
			{
				$stm = $this->pdo
				            ->prepare("SELECT * FROM Personas WHERE Dni = ?");			          

				$stm->execute(array($Dni));
				$row = $stm->fetch(PDO::FETCH_ASSOC);
				return $row['Nombres'].' '.$row['Apellidos'];
			}
			catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function getRubroById($Id){
			try 
			{
				$stm = $this->pdo
				            ->prepare("SELECT * FROM Rubros WHERE Id = ?");			          

				$stm->execute(array($Id));
				$row = $stm->fetch(PDO::FETCH_ASSOC);
				return $row['Descripcion'];
			}
			catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function getCiudadById($Id){
			try 
			{
				$stm = $this->pdo
				            ->prepare("SELECT * FROM Ciudades WHERE Id = ?");			          

				$stm->execute(array($Id));
				$row = $stm->fetch(PDO::FETCH_ASSOC);
				return $row['Nombre'];
			}
			catch (Exception $e) 
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

		public function getTotalRecords(){
			try {
				$stm = $this->pdo->prepare("SELECT * FROM UnidadesProductivas");
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
					$stmt = $this->pdo->prepare("SELECT * FROM UnidadesProductivas where Nombre LIKE :busqueda");
					$stmt->bindparam(":busqueda", $busqueda);
					$stmt->execute();
					return $stmt->rowCount();
				} else {
					$stmt = $this->pdo->prepare("SELECT * FROM UnidadesProductivas");
					$stmt->execute();
					return $stmt->rowCount();
				}	
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		public function Eliminar($Id)
		{
			//Faltar eliminar recursivamente las fks
			try 
			{
				$organigramaPath = $this->Obtener($Id)->Organigrama;
				$stm = $this->pdo
				            ->prepare("DELETE FROM UnidadesProductivas WHERE Id = ?");			          
				$stm->execute(array($Id));
				unlink($organigramaPath); //Eliminar la imagen del organigrama
			} catch (Exception $e)
			{
				die($e->getMessage());
			}
		}

		public function Actualizar($unidadProductiva)
		{
			try 
			{
				if ($unidadProductiva->Organigrama!=null){
					$sql = "UPDATE UnidadesProductivas SET 
							Nombre          = ?, 
							Rubro_Id        = ?,
	                        Web        		= ?,
							Telefono        = ?, 
							Telefono_Anexo  = ?,
							Fax 			= ?, 
							Celular 		= ?, 
							Ubicacion 		= ?, 
							Ciudad_Id 		= ?,
							Organigrama		= ?,
							Persona_Dni		= ?
					    WHERE Id = ?";

					$this->pdo->prepare($sql)
				     ->execute(
					    array(
	                        $unidadProductiva->Nombre, 
	                        $unidadProductiva->Rubro_Id,
	                        $unidadProductiva->Web,
	                        $unidadProductiva->Telefono,
	                        $unidadProductiva->Telefono_Anexo,
	                        $unidadProductiva->Fax,
	                        $unidadProductiva->Celular,
	                        $unidadProductiva->Ubicacion,
	                        $unidadProductiva->Ciudad_Id,
	                        $unidadProductiva->Organigrama,
	                        $unidadProductiva->Persona_Dni,
	                        $unidadProductiva->Id
						)
					);
				    if (!move_uploaded_file($_FILES['Organigrama']['tmp_name'], $unidadProductiva->Organigrama))
					{
						die("Error al subir la imagen al servidor, puede que no tenga permisos para escribir en el directorio.");
					}
							
				} else {
					$sql = "UPDATE UnidadesProductivas SET 
							Nombre          = ?, 
							Rubro_Id        = ?,
	                        Web        		= ?,
							Telefono        = ?, 
							Telefono_Anexo  = ?,
							Fax 			= ?, 
							Celular 		= ?, 
							Ubicacion 		= ?, 
							Ciudad_Id 		= ?,
							Persona_Dni = ?
					    WHERE Id = ?";

					$this->pdo->prepare($sql)
				     ->execute(
					    array(
	                        $unidadProductiva->Nombre, 
	                        $unidadProductiva->Rubro_Id,
	                        $unidadProductiva->Web,
	                        $unidadProductiva->Telefono,
	                        $unidadProductiva->Telefono_Anexo,
	                        $unidadProductiva->Fax,
	                        $unidadProductiva->Celular,
	                        $unidadProductiva->Ubicacion,
	                        $unidadProductiva->Ciudad_Id,
	                        $unidadProductiva->Persona_Dni,
	                        $unidadProductiva->Id
						)
					);	
				}
				

				
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Registrar(UnidadProductiva $unidadProductiva)
		{
			try 
			{
				$this->pdo->beginTransaction();	
				$sql = "INSERT INTO UnidadesProductivas (Nombre,Rubro_Id,Web,Telefono,Telefono_Anexo,Fax,Celular,Ubicacion, Ciudad_Id, Persona_Dni) 
				        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

				$this->pdo->prepare($sql)
				     ->execute(
						array(
							$unidadProductiva->Nombre, 
							$unidadProductiva->Rubro_Id,
		                    $unidadProductiva->Web,
		                    $unidadProductiva->Telefono,
		                    $unidadProductiva->Telefono_Anexo,
		                    $unidadProductiva->Fax,
		                    $unidadProductiva->Celular,
		                    $unidadProductiva->Ubicacion,
		                    $unidadProductiva->Ciudad_Id,
		                    $unidadProductiva->Persona_Dni
		                )
					);
				$lastId = $this->pdo->lastInsertId();
				$path = $_FILES['Organigrama']['name'];
				$ext = pathinfo($path, PATHINFO_EXTENSION);
				$imagePath = 'imagenes/unidadesproductivas/'.$lastId.'.'.$ext;
				$sql = "UPDATE UnidadesProductivas SET Organigrama=? WHERE Id=?";
				$this->pdo->prepare($sql)
				     ->execute(
						array(
							$imagePath,
							$lastId
		                )
					);
				$this->pdo->commit();
				if (!move_uploaded_file($_FILES['Organigrama']['tmp_name'], $imagePath))
				{
					die("Error al subir la imagen al servidor, puede que no tenga permisos para escribir en el directorio.");
				}
			} catch (Exception $e) 
			{
				$this->pdo->rollback();
				die($e->getMessage());
			}
		}
	}
?>