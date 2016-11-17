<?php

	class DetalleOperacion
	{
		private $pdo;
	    
	    public $Id;
	    public $Descripcion;
	    public $Monto;
	    public $Operacion_Id;


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

		public function Listar()
		{
			try
			{
				$stm = $this->pdo->prepare("SELECT * FROM DetallesOperacion");
				$stm->execute();

				return $stm->fetchAll(PDO::FETCH_OBJ);
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}
		}

		public function getMontoTotal()
		{
			
		}

		public function Obtener($id)
		{
			try 
			{
				$stm = $this->pdo
				          ->prepare("SELECT * FROM DetallesOperacion WHERE Id = ?");
				          

				$stm->execute(array($id));
				return $stm->fetch(PDO::FETCH_OBJ);
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function getDetallesByOperacionId($Id){
			try
			{
				$stm = $this->pdo->prepare("SELECT do.Id, do.Descripcion, do.Monto FROM DetallesOperacion do where do.Operacion_Id=?");
				$stm->execute(array($Id));

				return $stm->fetchAll(PDO::FETCH_OBJ);
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}
		}

		public function getDetallesArrayByOperacionId($Id){
			try
			{
				$stm = $this->pdo->prepare("SELECT Id, Descripcion, Monto FROM DetallesOperacion where Operacion_Id=?");
				$stm->execute(array($Id));

				return $stm->fetchAll();
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
				$stm = $this->pdo
				            ->prepare("DELETE FROM DetallesOperacion WHERE Id = ?");			          

				$stm->execute(array($Id));
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Actualizar(DetalleOperacion $Detalle_Operacion)
		{
			try 
			{
				$sql = "UPDATE DetallesOperacion SET 
							Descripcion       = ?, 
							Monto        	  = ?,
							Operacion_Id      = ?
					    WHERE Id = ?";

				$this->pdo->prepare($sql)
				     ->execute(
					    array(
	                        $Detalle_Operacion->Descripcion, 
	                        $Detalle_Operacion->Monto,
	                        $Detalle_Operacion->Operacion_Id,
	                        $Detalle_Operacion->Id
						)
					);
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Registrar(DetalleOperacion $Detalle_Operacion)
		{
			try 
			{
			$sql = "INSERT INTO DetallesOperacion (Descripcion,Monto,Operacion_Id) 
			        VALUES (?, ?, ?)";

			$this->pdo->prepare($sql)
			     ->execute(
					array(
						$Detalle_Operacion->Descripcion, 
						$Detalle_Operacion->Monto,
						$Detalle_Operacion->Operacion_Id
	                )
				);
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}
	}
?>