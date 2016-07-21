<?php

	class Operacion
	{
		private $pdo;
	    
	    public $Id;
	    public $Tipo;
	    public $Monto;
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
				$stm = $this->pdo->prepare("SELECT * FROM Operaciones");
				$stm->execute();
				return $stm->rowCount();
				
			} catch (Exception $e) {
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
				$stm = $this->pdo
				            ->prepare("DELETE FROM Operaciones WHERE Id = ?");			          
				$stm->execute(array($Id));
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Actualizar(Operacion $operacion)
		{
			try 
			{
				$sql = "UPDATE Operaciones SET 
							Tipo          = ?,
							Monto=?,
							Unidad_Id=?,
							Fecha=?
					    WHERE Id = ?";

				$this->pdo->prepare($sql)
				     ->execute(
					    array(
	                        $operacion->Tipo, 
	                        $operacion->Monto,
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
			$sql = "INSERT INTO Operaciones (Tipo, Monto, Unidad_Id, Fecha) 
			        VALUES (?,?,?,?)";

			$this->pdo->prepare($sql)
			     ->execute(
					array(
						$operacion->Tipo,
						$operacion->Monto,
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