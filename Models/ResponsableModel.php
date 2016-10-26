<?php

	class Responsable
	{
		private $pdo;
	    
	    public $Id;
	    public $Unidad_Id;
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
				$stmt = $this->pdo->prepare("SELECT * FROM Responsables LIMIT :startFrom,:resultsPerPage");
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
				$stm = $this->pdo->prepare("SELECT * FROM Responsables");
				$stm->execute();
				return $stm->rowCount();
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		public function Obtener($Id)
		{
			try 
			{
				$stm = $this->pdo
				          ->prepare("SELECT * FROM Responsables WHERE Id = ?");
				          

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
				            ->prepare("DELETE FROM Responsables WHERE Id = ?");			          
				$stm->execute(array($Id));
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Actualizar(Responsable $responsable)
		{
			try 
			{
				$sql = "UPDATE Responsables SET 
							Unidad_Id = ?,
							Persona_Dni = ?
					    WHERE Id = ?";

				$this->pdo->prepare($sql)
				     ->execute(
					    array(
	                        $responsable->Unidad_Id, 
	                        $responsable->Persona_Dni, 
	                        $responsable->Id
						)
					);
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Registrar(Responsable $responsable)
		{
			try 
			{
			$sql = "INSERT INTO Responsables (Unidad_Id, Persona_Dni) 
			        VALUES (?,?)";

			$this->pdo->prepare($sql)
			     ->execute(
					array(
						$responsable->Unidad_Id,
						$responsable->Persona_Dni
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