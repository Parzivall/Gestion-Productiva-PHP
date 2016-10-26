<?php

	class Detalle
	{
		private $pdo;
	    
	    public $Id;
	    public $Descripcion;
	    public $Monto;

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
				$result = array();

				$stm = $this->pdo->prepare("SELECT * FROM Detalles");
				$stm->execute();

				return $stm->fetchAll(PDO::FETCH_OBJ);
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}
		}

		public function Obtener($id)
		{
			try 
			{
				$stm = $this->pdo
				          ->prepare("SELECT * FROM Detalles WHERE Id = ?");
				          

				$stm->execute(array($id));
				return $stm->fetch(PDO::FETCH_OBJ);
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Eliminar($id)
		{
			try 
			{
				$stm = $this->pdo
				            ->prepare("DELETE FROM Detalles WHERE Id = ?");			          

				$stm->execute(array($id));
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Actualizar(Detalle $Detalle)
		{
			try 
			{
				$sql = "UPDATE Detalles SET 
							Descripcion         = ?, 
							Monto        		= ?
					    WHERE Id = ?";

				$this->pdo->prepare($sql)
				     ->execute(
					    array(
	                        $Detalle->Descripcion, 
	                        $Detalle->Monto,
	                        $Detalle->Id
						)
					);
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Registrar(Detalle $Detalle)
		{
			try 
			{
				$sql = "INSERT INTO Detalles (Descripcion,Monto) 
				        VALUES (?, ?)";

				$this->pdo->prepare($sql)
				     ->execute(
						array(
							$Detalle->Descripcion, 
							$Detalle->Monto
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