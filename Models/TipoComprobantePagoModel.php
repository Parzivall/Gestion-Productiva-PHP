<?php

	class TipoComprobantePago
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

		public function Listar($startFrom)
		{
			try
			{
				$limit = resultsPerPage;
				$start = $startFrom;
				$stmt = $this->pdo->prepare("SELECT * FROM Tipo_Comprobante_Documento ORDER BY Descripcion ASC LIMIT :startFrom,:resultsPerPage");
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

		public function getAll(){
			try
			{
				$stmt = $this->pdo->prepare("SELECT * FROM Tipo_Comprobante_Documento ORDER BY Descripcion ASC");
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_OBJ);
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}
		}

		public function getComprobantesSeleccionados(){
			try
			{
				$stmt = $this->pdo->prepare("SELECT * FROM Tipo_Comprobante_Documento WHERE Id<5 or Id=103 ORDER BY Descripcion ASC");
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_OBJ);
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}
		}

		

		public function getTotalRecords(){
			try {
				$stm = $this->pdo->prepare("SELECT * FROM Tipo_Comprobante_Documento");
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
				          ->prepare("SELECT * FROM Tipo_Comprobante_Documento WHERE Id = ?");
				          
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
				            ->prepare("DELETE FROM Tipo_Comprobante_Documento WHERE Id = ?");			          
				$stm->execute(array($Id));
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Actualizar(TipoComprobantePago $TipoComprobantePago)
		{
			try 
			{
				$sql = "UPDATE Tipo_Comprobante_Documento SET 
							Descripcion          = ?
					    WHERE Id = ?";

				$this->pdo->prepare($sql)
				     ->execute(
					    array(
	                        $TipoComprobantePago->Descripcion, 
	                        $TipoComprobantePago->Id
						)
					);
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Registrar(TipoComprobantePago $TipoComprobantePago)
		{
			try 
			{
			$sql = "INSERT INTO Tipo_Comprobante_Documento (Descripcion) 
			        VALUES (?)";

			$this->pdo->prepare($sql)
			     ->execute(
					array(
						$TipoComprobantePago->Descripcion
	                )
				);
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}
	}
?>