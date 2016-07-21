<?php

	class ProductoServicio
	{
		private $pdo;
	    
	    public $Id;
	    public $TipoProductoServicio_Id;
	    public $Descripcion;
	    public $Imagen;
	    public $Tipo;


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

				$stm = $this->pdo->prepare("SELECT * FROM ProductoServicio");
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
				          ->prepare("SELECT * FROM ProductoServicio WHERE id = ?");
				          

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
				            ->prepare("DELETE FROM ProductoServicio WHERE id = ?");			          

				$stm->execute(array($id));
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Actualizar(ProductoServicio $ProductoServicio)
		{
			try 
			{
				$sql = "UPDATE ProductoServicio SET 
							TipoProductoServicio_Id         = ?, 
							Descripcion        				= ?,
	                        Imagen        					= ?,
							Tipo        					= ?, 

					    WHERE id = ?";

				$this->pdo->prepare($sql)
				     ->execute(
					    array(
	                        $ProductoServicio->TipoProductoServicio_Id, 
	                        $ProductoServicio->Descripcion,
	                        $ProductoServicio->Imagen,
	                        $ProductoServicio->Tipo

						)
					);
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Registrar(ProductoServicio $ProductoServicio)
		{
			try 
			{
			$sql = "INSERT INTO ProductoServicio (TipoProductoServicio_Id,Descripcion,Imagen,Tipo) 
			        VALUES (?, ?, ?, ?)";

			$this->pdo->prepare($sql)
			     ->execute(
					array(
						$ProductoServicio->TipoProductoServicio_Id, 
						$ProductoServicio->Descripcion,
	                    $ProductoServicio->Imagen,
	                    $ProductoServicio->Tipo
	                )
				);
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}
	}
?>