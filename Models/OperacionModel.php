<?php

	class Operacion
	{
		private $pdo;
	    
	    public $Id;
	    public $Tipo;
	    public $Unidad_Id;
	    public $Fecha;

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
				$stmt = $this->pdo->prepare("SELECT * FROM Operaciones ORDER BY FECHA DESC LIMIT :startFrom,:resultsPerPage");
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
					$stm = $this->pdo->prepare("SELECT * FROM Operaciones WHERE Unidad_Id=:unidad_id");
					$stm->bindparam(":unidad_id", ($_SESSION['Unidad_Id']));	
				}
				else{
					$stm = $this->pdo->prepare("SELECT * FROM Operaciones");	
				}
				$stm->execute();
				return $stm->rowCount();
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		public function getOperacionesByUnidadId($unidad_Id, $startFrom){
			try
			{
				$limit = resultsPerPage;
				$start = $startFrom;
				$stmt = $this->pdo->prepare("SELECT * FROM Operaciones WHERE Unidad_Id=:unidad_id ORDER BY Fecha DESC LIMIT :startFrom,:resultsPerPage");
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

		public function getUnidades(){
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

		public function getMontoTotal($Id){
			try 
			{
				$stm = $this->pdo
				            ->prepare("SELECT sum(Monto) FROM Operaciones op, DetallesOperacion do where op.Id = do.Operacion_Id and op.Id = ?");			          

				$stm->execute(array($Id));
				$row = $stm->fetch(PDO::FETCH_NUM);
				return $row[0];
			}
			catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Obtener($Id)
		{
			try 
			{
				$stm = $this->pdo
				          ->prepare("SELECT * FROM Operaciones WHERE Id = ?");
				          

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
				$this->pdo->beginTransaction();	
				//Eliminar las relaciones
				$stmForeign = $this->pdo
				            ->prepare("DELETE FROM DetallesOperacion WHERE Operacion_Id = ?");			          
				$stmForeign->execute(array($Id));

				/*
				//Eliminar los detalles
				$stm = $this->pdo->prepare("SELECT De.Id FROM Detalle_Operacion do, Detalles de where do.Operacion_Id=? and do.Detalle_Id = de.Id");
				$stm->execute(array($Id));

				$detallesToDelete = $stm->fetchAll();
				for ($i=0; $i < count($detallesToDelete); $i++) { 
					//Eliminar cada detalle
					$stmForeign = $this->pdo
					            ->prepare("DELETE FROM Detalles WHERE Id = ?");			          
					$stmForeign->execute(array($detallesToDelete[$i][0]));
				}

				*/
				$stm = $this->pdo
				            ->prepare("DELETE FROM Operaciones WHERE Id = ?");			          
				$stm->execute(array($Id));

				$this->pdo->commit();
			} catch (Exception $e) 
			{
				$this->pdo->rollback();
				die($e->getMessage());
			}
		}

		public function Actualizar(Operacion $operacion)
		{
			try 
 			{
				$sql = "UPDATE Operaciones SET 
							Tipo          = ?,
							Unidad_Id=?,
							Fecha=?
					    WHERE Id = ?";

				$this->pdo->prepare($sql)
				     ->execute(
					    array(
	                        $operacion->Tipo, 
	                        $operacion->Unidad_Id,
	                        $operacion->Fecha,
	                        $operacion->Id
						)
					);
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Registrar(Operacion $operacion)
		{
			try 
			{
			$sql = "INSERT INTO Operaciones (Tipo, Unidad_Id, Fecha) 
			        VALUES (?,?,?)";

			$this->pdo->prepare($sql)
			     ->execute(
					array(
						$operacion->Tipo,
						$operacion->Unidad_Id,
						$operacion->Fecha
	                )
				);
			return $this->pdo->lastInsertId();
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}
	}
?>