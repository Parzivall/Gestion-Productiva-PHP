 <?php

	class TipoProductoServicio
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

		public function Listar()
		{
			try
			{
				$result = array();

				$stm = $this->pdo->prepare("SELECT * FROM TipoProductoServicio");
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
				          ->prepare("SELECT * FROM TipoProductoServicio WHERE id = ?");
				          

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
				            ->prepare("DELETE FROM TipoProductoServicio WHERE id = ?");			          

				$stm->execute(array($id));
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Actualizar(TipoProductoServicio $TipoProductoServicio)
		{
			try 
			{
				$sql = "UPDATE TipoProductoServicio SET 
							Descripcion          = ?, 
							 
					    WHERE id = ?";

				$this->pdo->prepare($sql)
				     ->execute(
					    array(
	                        $TipoProductoServicio->Descripcion 
	                       
						)
					);
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Registrar(TipoProductoServicio $TipoProductoServicio)
		{
			try 
			{
			$sql = "INSERT INTO TipoProductoServicio (Descripcion) 
			        VALUES (?)";

			$this->pdo->prepare($sql)
			     ->execute(
					array(
						$TipoProductoServicio->Descripcion
	                )
				);
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}
	}
?>