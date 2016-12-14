<?php
	class InventarioFisicoDe
	{
		private $pdo;
	    
	    public $Id;
	    public $Cantidad;
	    public $Estado;
	    public $Edad;
	    public $Observaciones;
	    public $InventarioFisico_Id;
	    public $Material_Insumo_Id;

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


		public function getDetallesByIFisicoId($Id){
			try
			{
				$stm = $this->pdo->prepare("SELECT  do.Id, do.Cantidad, do.Estado ,do.Edad,do.Observaciones,do.Material_Insumo_Id FROM InventarioFisico_Detalle  do WHERE do.InventarioFisico_Id = ?");
				$stm->execute(array($Id));

				return $stm->fetchAll(PDO::FETCH_OBJ);
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}
		}

		public function Listar2($Id)//$startFrom ,
		{
			try
			{
				//$limit = resultsPerPage;
				//$start = $startFrom;
				$stmt = $this->pdo->prepare("SELECT * FROM InventarioFisico_Detalle WHERE InventarioFisico_Id = ?");

				//$stmt->bindValue(":startFrom", (int)$start, PDO::PARAM_INT);
				//$stmt->bindValue(":resultsPerPage", (int)$limit, PDO::PARAM_INT);
				$stmt->execute( array($Id) );
				$row = $stmt->fetchAll(PDO::FETCH_OBJ);
				$cont =count($row);
				echo "llego termino $cont";
				return $row;
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}
		}

		public function Actualizar($Inventariofisicode)
		{

			try 
			{
				if ($Inventariofisicode->Cantidad!=null){

					$sql = "UPDATE InventarioFisico_Detalle SET 
							Cantidad            =  ?, 
							Estado              =  ?,
	                        Edad        		=  ?,
							Observaciones       = ?, 
							InventarioFisico_Id = ?,
							Material_Insumo_Id 	= ?
					   		WHERE Id = ?";

					$this->pdo->prepare($sql)
				     ->execute(
					    array(
	                        $Inventariofisicode->Cantidad,
	                        $Inventariofisicode->Estado,
	                        $Inventariofisicode->Edad,
	                        $Inventariofisicode->Observaciones,
	                        $Inventariofisicode->InventarioFisico_Id,
	                        $Inventariofisicode->Material_Insumo_Id,
	                        $Inventariofisicode->Id
						)
					 );	
				} 
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Registrar(Inventariofisicode $inventariofisicode)
		{
			try 
			{
			  // $this->pdo->beginTransaction();	//prque se pone esto aqui??

				$sql = "INSERT INTO InventarioFisico_Detalle (Cantidad,Estado,Edad,Observaciones,InventarioFisico_Id,Material_Insumo_Id) 
				        VALUES (?,?,?,?,?,?)";
				echo "asma $inventariofisicode->Cantidad destpues";
				echo "despues el id es $inventariofisicode->Material_Insumo_Id";
				$this->pdo->prepare($sql)
				     ->execute(
						array(
							$inventariofisicode->Cantidad, 
							$inventariofisicode->Estado,
		                    $inventariofisicode->Edad,
		                    $inventariofisicode->Observaciones,
		                    $inventariofisicode->InventarioFisico_Id,
		                    $inventariofisicode->Material_Insumo_Id
		                )
					);
				     echo "lala  $inventariofisicode->Observaciones";
				     echo "despues de esp la cantidad  $inventariofisicode->Cantidad";
				//$this->pdo->commit();
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function getTotalRecords(){
			try {
				$stm = $this->pdo->prepare("SELECT * FROM InventarioFisico_Detalle");
				$stm->execute();
				return $stm->rowCount();
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		public function Obtener($Id)
        {
            try {
                $stmt=$this->pdo->prepare("SELECT * FROM InventarioFisico_Detalle Where Id = ?");
                $stmt->execute( array($Id) );
                return $stmt->fetch(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }

		public function getporid($Id)
		{
			try 
			{
				$stm = $this->pdo
				          ->prepare("SELECT * FROM InventarioFisico_Detalle WHERE Id = ?");
					          
				$stm->execute(array($Id));
				return $stm->fetch(PDO::FETCH_OBJ);
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function getporUnidadID($Id)
		{
			try 
			{
				$stm = $this->pdo
				          ->prepare("SELECT * FROM InventarioFisico_Detalle WHERE InventarioFisico_Id = ?");
					          
				$stm->execute(array($Id));
				return $stm->fetchAll();//esto lo saca como un objeto PDO::FETCH_OBJ
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function getMarca($Id)
		{
			try 
			{
				$stm = $this->pdo
				          ->prepare("SELECT * FROM Material_Insumo WHERE  Id = ?");
					          
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
				          ->prepare("DELETE FROM InventarioFisico_Detalle WHERE  Id = ?");
					          
				$stm->execute(array($Id));
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}
	}
		

?>