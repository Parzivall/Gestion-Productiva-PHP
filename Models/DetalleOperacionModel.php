<?php

	class DetalleOperacion
	{
		private $pdo;
	    
	    public $Id;
	    public $Operacion_Id;
	    public $Detalle_Id;

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
				$stm = $this->pdo->prepare("SELECT * FROM Detalle_Operacion");
				$stm->execute();

				return $stm->fetchAll(PDO::FETCH_OBJ);
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}
		}

		public function getDetallesByOperacionId($Id){
			try
			{
				$stm = $this->pdo->prepare("SELECT de.Id, de.Descripcion, de.Monto FROM Detalle_Operacion do, Detalles de where do.Operacion_Id=? and do.Detalle_Id = de.Id");
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
				$stm = $this->pdo->prepare("SELECT de.Id, de.Descripcion, de.Monto FROM Detalle_Operacion do, Detalles de where do.Operacion_Id=? and do.Detalle_Id = de.Id");
				$stm->execute(array($Id));

				return $stm->fetchAll();
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
				          ->prepare("SELECT * FROM Detalle_Operacion WHERE Id = ?");
				          

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
				            ->prepare("DELETE FROM Detalle_Operacion WHERE Id = ?");			          

				$stm->execute(array($Id));
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function EliminarByIds($Operacion_Id, $Detalle_Id)
		{
			try 
			{
				$stm = $this->pdo
				            ->prepare("DELETE FROM Detalle_Operacion WHERE Operacion_Id = ? and Detalle_Id=?");			

				$stm->execute(array($Operacion_Id, $Detalle_Id));
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Actualizar(DetalleOperacion $Detalle_Operacion)
		{
			try 
			{
				$sql = "UPDATE Detalle_Operacion SET 
							Operacion_Id      = ?, 
							Detalle_Id        = ?,
					    WHERE Id = ?";

				$this->pdo->prepare($sql)
				     ->execute(
					    array(
	                        $Detalle_Operacion->Operacion_Id, 
	                        $Detalle_Operacion->Detalle_Id,
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
			$sql = "INSERT INTO Detalle_Operacion (Operacion_Id,Detalle_Id) 
			        VALUES (?, ?)";

			$this->pdo->prepare($sql)
			     ->execute(
					array(
						$Detalle_Operacion->Operacion_Id, 
						$Detalle_Operacion->Detalle_Id
	                )
				);
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}
	}
?>