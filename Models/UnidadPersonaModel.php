<?php

	class UnidadPersona
	{
		private $pdo;
	    
	    public $Id;
	    public $Persona_Dni;
	    public $Unidad_Id;
	    public $Cargo_Id;
	    

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
				$stmt = $this->pdo->prepare("SELECT * FROM Unidades_Personas LIMIT :startFrom,:resultsPerPage");
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

		public function getTotalRecords(){
			try {
				if (isset($_SESSION['Unidad_Id'])){
					$stm = $this->pdo->prepare("SELECT * FROM Unidades_Personas WHERE Unidad_Id=:unidad_id");
					$stm->bindparam(":unidad_id", ($_SESSION['Unidad_Id']));	
				}
				else{
					$stm = $this->pdo->prepare("SELECT * FROM Unidades_Personas");	
				}
				$stm->execute();
				return $stm->rowCount();
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		public function getUnidadesPersonasByUnidadId($unidad_Id, $startFrom){
			try
			{
				$limit = resultsPerPage;
				$start = $startFrom;
				$stmt = $this->pdo->prepare("SELECT * FROM Unidades_Personas WHERE Unidad_Id=:unidad_id LIMIT :startFrom,:resultsPerPage");
				$stmt->bindparam(":unidad_id", $unidad_Id);
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
				          ->prepare("SELECT * FROM Unidades_Personas WHERE Id = ?");
				          

				$stm->execute(array($Id));
				return $stm->fetch(PDO::FETCH_OBJ);
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Eliminar($Id)
		{
			try 
			{
				$stm = $this->pdo
				            ->prepare("DELETE FROM Unidades_Personas WHERE Id = ?");			          
				$stm->execute(array($Id));
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Actualizar(UnidadPersona $unidadPersona)
		{
			try 
			{
				$sql = "UPDATE Unidades_Personas SET 
							Persona_Dni = ?,
							Unidad_Id = ?,
							Cargo_Id = ?
					    WHERE Id = ?";

				$this->pdo->prepare($sql)
				     ->execute(
					    array(
	                        $unidadPersona->Persona_Dni, 
	                        $unidadPersona->Unidad_Id, 
	                        $unidadPersona->Cargo_Id,
	                        $unidadPersona->Id
						)
					);
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Registrar(UnidadPersona $unidadPersona)
		{
			try 
			{
			$sql = "INSERT INTO Unidades_Personas (Persona_Dni, Unidad_Id, Cargo_Id) 
			        VALUES (?,?,?)";

			$this->pdo->prepare($sql)
			     ->execute(
					array(
						$unidadPersona->Persona_Dni,
						$unidadPersona->Unidad_Id,
						$unidadPersona->Cargo_Id
	                )
				);
			} catch (Exception $e) 
			{
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
	}
?>