<?php
	class Material_Insumo
	{
		private $pdo;

		public $Id;
		public $Descripcion;
		public $Marca;

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
				$stmt = $this->pdo->prepare("SELECT * FROM Material_Insumo ORDER BY Id ASC LIMIT :startFrom,:resultsPerPage");
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

		public function Actualizar($Materialinsumo)
		{
			try 
			{
					$sql = "UPDATE Material_Insumo SET 
							Marca               =  ?,
							Descripcion			=  ?
					    WHERE Id = ?";

					$this->pdo->prepare($sql)
				     ->execute(
					    array(
	                        $Materialinsumo->Descripcion,
	                        $Materialinsumo->Marca
						)
					 );	
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Registrar(Material_Insumo $Materialinsumo)
		{
			try 
			{
				$sql = "INSERT INTO Material_Insumo (Id,Marca,Descripcion) 
				        VALUES (?,?,?)";

				$this->pdo->prepare($sql)
				     ->execute(
						array(
							$Materialinsumo->Id, 
							$Materialinsumo->Marca,//ojo modifique esto
							$Materialinsumo->Descripcion
		                )
					);
				 echo "termino de Registrar";
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function getTotalRecords(){//la cantidad de filas
			try {
				$stm = $this->pdo->prepare("SELECT * FROM Material_Insumo");
				$stm->execute();
				return $stm->rowCount();
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		public function getrowId()
		{
			echo "asdmaods";
			try
			{
			    $stm = $this->pdo->prepare("SELECT * FROM Material_Insumo ");
				$stm->execute();
				
				return $stm->fetchAll(PDO::FETCH_OBJ);
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}
		}

		public function Eliminar($Id)
		{
			try
			{
			    $stm = $this->pdo->prepare("DELETE FROM Material_Insumo WHERE Id =? ");
				$stm->execute(array($Id));
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
			    $stm = $this->pdo->prepare("SELECT * FROM Material_Insumo WHERE Id =? ");
				$stm->execute(array($Id));
				return $stm->fetch(PDO::FETCH_OBJ);
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}	
		}
	}
?>