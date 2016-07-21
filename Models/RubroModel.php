<?php

	class Rubro
	{
		private $pdo;
	    
	    public $Id;
	    public $Descripcion;

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
				$stmt = $this->pdo->prepare("SELECT * FROM Rubros ORDER BY Id ASC LIMIT :startFrom,:resultsPerPage");
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
				$stm = $this->pdo->prepare("SELECT * FROM Rubros");
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
				          ->prepare("SELECT * FROM Rubros WHERE Id = ?");
				          

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
				            ->prepare("DELETE FROM Rubros WHERE Id = ?");			          
				$stm->execute(array($Id));
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Actualizar(Rubro $Rubro)
		{
			try 
			{
				$sql = "UPDATE Rubros SET 
							Descripcion= ?
					    WHERE Id = ?";

				$this->pdo->prepare($sql)
				     ->execute(
					    array(
	                        $Rubro->Descripcion, 
	                        $Rubro->Id
						)
					);
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Registrar(Rubro $Rubro)
		{
			try 
			{
			$sql = "INSERT INTO Rubros (Descripcion) 
			        VALUES (?)";

			$this->pdo->prepare($sql)
			     ->execute(
					array(
						$Rubro->Descripcion
	                )
				);
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}
	}
?>