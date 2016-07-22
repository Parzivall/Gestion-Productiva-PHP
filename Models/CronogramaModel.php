<?php

	class Cronograma
	{
		private $pdo;
	    
	    public $Id;
	    public $Cumplido;
	    public $Descripcion;
	    public $FechaInicio;
	    public $FechaFin;
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
				$stmt = $this->pdo->prepare("SELECT * FROM Cronogramas LIMIT :startFrom,:resultsPerPage");
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
				$stm = $this->pdo->prepare("SELECT * FROM Cronogramas");
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
				          ->prepare("SELECT * FROM Cronogramas WHERE Id = ?");
				          
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
				            ->prepare("DELETE FROM Cronogramas WHERE Id = ?");			          
				$stm->execute(array($Id));
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Actualizar(Cronograma $cronograma)
		{
			try 
			{
				$sql = "UPDATE Cronogramas SET 
							Cumplido = ?,
							Descripcion = ?,
							FechaInicio =?,
							FechaFin = ?,
							Unidad_Id = ?
					    WHERE Id = ?";

				$this->pdo->prepare($sql)
				     ->execute(
					    array(
	                        $cronograma->Cumplido, 
	                        $cronograma->Descripcion, 
	                        $cronograma->FechaInicio,
	                        $cronograma->FechaFin,
	                        $cronograma->Unidad_Id,
	                        $cronograma->Id
						)
					);
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Registrar(Cronograma $cronograma)
		{
			try 
			{
			$sql = "INSERT INTO Cronogramas (Cumplido, Descripcion, FechaInicio, FechaFin, Unidad_Id) 
			        VALUES (?,?,?,?,?)";

			$this->pdo->prepare($sql)
			     ->execute(
					array(
						$cronograma->Cumplido,
						$cronograma->Descripcion,
						$cronograma->FechaInicio,
						$cronograma->FechaFin,
						$cronograma->Unidad_Id
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
	}
?>