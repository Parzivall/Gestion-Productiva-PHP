<?php

	class Unidades_ProductosServicios
	{
		private $pdo;
	    
	    public $Id;
	    public $Unidad_Id;
	    public $ProductoServicio_Id;

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

				$stm = $this->pdo->prepare("SELECT * FROM Unidades_ProductosServicios");
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
				          ->prepare("SELECT * FROM Unidades_ProductosServicios WHERE id = ?");
				          

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
				            ->prepare("DELETE FROM Unidades_ProductosServicios WHERE id = ?");			          

				$stm->execute(array($id));
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Actualizar(Unidades_ProductosServicios $Unidades_ProductosServicios)
		{
			try 
			{
				$sql = "UPDATE Unidades_ProductosServicios SET 
							Unidad_Id          		= ?, 
							ProductoServicio_Id     = ?, 
					    WHERE id = ?";

				$this->pdo->prepare($sql)
				     ->execute(
					    array(
	                        $Unidades_ProductosServicios->Unidad_Id, 
	                        $Unidades_ProductosServicios->ProductoServicio_Id,
						)
					);
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Registrar(Unidades_ProductosServicios $Unidades_ProductosServicios)
		{
			try 
			{
			$sql = "INSERT INTO Unidades_ProductosServicios (Unidad_Id,ProductoServicio_Id) 
			        VALUES (?, ?)";

			$this->pdo->prepare($sql)
			     ->execute(
					array(
						$Unidades_ProductosServicios->Unidad_Id, 
						$Unidades_ProductosServicios->ProductoServicio_Id
	                )
				);
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}
	}
?>