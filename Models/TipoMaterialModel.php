<?php
class TipoMaterial
	{
		private $pdo;
		public  $Id;
		public $Descripcion;

		function __construct()
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
				
				$stmt = $this->pdo->prepare("SELECT * FROM TipoMaterial ORDER BY Descripcion ASC LIMIT :startFrom,:resultsPerPage ");
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
			echo"dentra a recoger la cantidad de filas";
			try {
				$stm = $this->pdo->prepare("SELECT * FROM TipoMaterial");

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
				          ->prepare("SELECT * FROM TipoMaterial WHERE Id = ?");
				          

				$stm->execute(array($Id));
				return $stm->fetch(PDO::FETCH_OBJ);
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}


		public function Actualizar($tipomaterial)
		{
			try 
			{
					$sql = "UPDATE TipoMaterial SET 
							Descripcion              =  ?
					    WHERE Id = ?";

					$this->pdo->prepare($sql)
				     ->execute(
					    array(
	                        $tipomaterial->Descripcion
						)
					 );	
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Registrar(TipoMaterial $tipomaterial)
		{
			try 
			{
				$sql = "INSERT INTO TipoMaterial (Id,Descripcion) 
				        VALUES (?, ?)";

				$this->pdo->prepare($sql)
				     ->execute(
						array(
							$tipomaterial->Id, 
							$tipomaterial->Descripcion
		                )
					);
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
				            ->prepare("DELETE FROM TipoMaterial WHERE Id = ?");			          
				$stm->execute(array($Id));
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}
	}
?>