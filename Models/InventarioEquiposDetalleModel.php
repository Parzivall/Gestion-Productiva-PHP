<?php
	class InventarioEquipoDe
	{
		private $pdo;
	    
	    public $Id;
	    public $Descripcion;
	    public $Marca;
	    public $Modelo;
	    public $NumeroSerie;
	    public $Fecha_Fabricacion;

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
				$stmt = $this->pdo->prepare("SELECT * FROM InventarioEquipo_Detalle ORDER BY Cantidad");

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

		public function Actualizar($InventarioEquipoDe)
		{
			try 
			{
				if ($InventarioEquipoDe->Cantidad!=null){
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
	                        $InventarioEquipoDe->Cantidad,
	                        $InventarioEquipoDe->Estado,
	                        $InventarioEquipoDe->Edad,
	                        $InventarioEquipoDe->Observaciones,
	                        $InventarioEquipoDe->InventarioFisico_Id,
	                        $unidadProductiva->Material_Insumo_Id,
	                        $InventarioEquipoDe->Id, 
						)
					 );	
				} 
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Registrar(InventarioEquipoDe $InventarioEquipoDe)
		{
			try 
			{
				$this->pdo->beginTransaction();	
				$sql = "INSERT INTO InventarioFisico_Detalle (Id,Cantidad,Estado,Edad,Observaciones,InventarioFisico_Id,Material_Insumo_Id) 
				        VALUES (?, ?, ?, ?, ?, ?, ?)";

				$this->pdo->prepare($sql)
				     ->execute(
						array(
							$InventarioEquipoDe->Cantidad, 
							$InventarioEquipoDe->Estado,
		                    $InventarioEquipoDe->Edad,
		                    $InventarioEquipoDe->Observaciones,
		                    $InventarioEquipoDe->InventarioFisico_Id,
		                    $InventarioEquipoDe->Material_Insumo_Id,
		                    $InventarioEquipoDe->Id
		                )
					);
			} catch (Exception $e) 
			{
				$this->pdo->rollback();
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
	}
		

?>