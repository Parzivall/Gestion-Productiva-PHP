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
				if (isset($_SESSION['Unidad_Id'])){
					$stm = $this->pdo->prepare("SELECT * FROM Cronogramas WHERE Unidad_Id=:unidad_id");
					$stm->bindparam(":unidad_id", ($_SESSION['Unidad_Id']));	
				}
				else{
					$stm = $this->pdo->prepare("SELECT * FROM Cronogramas");	
				}
				$stm->execute();
				return $stm->rowCount();
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		public function getCronogramasByUnidadId($unidad_Id, $startFrom){
			try
			{
				$limit = resultsPerPage;
				$start = $startFrom;
				$stmt = $this->pdo->prepare("SELECT * FROM Cronogramas WHERE Unidad_Id=:unidad_id ORDER BY FechaFin DESC LIMIT :startFrom,:resultsPerPage");
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

		public function getCronogramasFechaLimite(){
			try
			{
				if (isset($_SESSION['Unidad_Id'])){
					$stmt = $this->pdo->prepare("SELECT cro.Descripcion, upro.Nombre FROM Cronogramas cro, UnidadesProductivas upro WHERE cro.Unidad_Id = upro.Id and FechaFin=CURDATE() and Cumplido=false and cro.Unidad_Id=:unidad_id");

					$stmt->bindparam(":unidad_id", ($_SESSION['Unidad_Id']));	
				}
				else{
					$stmt = $this->pdo->prepare("SELECT cro.Descripcion, upro.Nombre FROM Cronogramas cro, UnidadesProductivas upro WHERE cro.Unidad_Id = upro.Id and FechaFin=CURDATE() and Cumplido=false");

				}
				$stmt->execute();
				return $stmt->fetchAll();
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