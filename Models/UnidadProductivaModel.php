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
		public function getTotalRecords(){
			try {
				$stm = $this->pdo->prepare("SELECT * FROM UnidadesProductivas");
				$stm->execute();
				return $stm->rowCount();
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		public function Eliminar($Id)
		{
			//Faltar eliminar recursivamente las fks
			try 
			{
				$stm = $this->pdo
				            ->prepare("DELETE FROM UnidadesProductivas WHERE Id = ?");			          

				$stm->execute(array($Id));
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Actualizar($unidadProductiva)
		{
			try 
			{
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
							Organigrama = ?
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
	                        $unidadProductiva->Id
						)
					);
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Registrar(UnidadProductiva $unidadProductiva)
		{
			try 
			{
			$sql = "INSERT INTO UnidadesProductivas (Nombre,Rubro_Id,Web,Telefono,Telefono_Anexo,Fax,Celular,Ubicacion, Ciudad_Id, Organigrama) 
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
	                    $unidadProductiva->Organigrama
	                )
				);
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}
	}
?>