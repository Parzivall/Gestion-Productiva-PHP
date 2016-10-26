<?php

	class Unidades_Cronogramas
	{
		private $pdo;
	    
	    public $Id;
	    public $Unidad_Id;
	    public $Cronograma_Id;

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

				$stm = $this->pdo->prepare("SELECT * FROM Unidades_Cronogramas");
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
				          ->prepare("SELECT * FROM Unidades_Cronogramas WHERE id = ?");
				          

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
				            ->prepare("DELETE FROM Unidades_Cronogramas WHERE id = ?");			          

				$stm->execute(array($id));
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Actualizar(Unidades_Cronogramas $Unidades_Cronogramas)
		{
			try 
			{
				$sql = "UPDATE Unidades_Cronogramas SET 
							Unidad_Id          = ?, 
							Cronograma_Id      = ?,
					    WHERE id = ?";

				$this->pdo->prepare($sql)
				     ->execute(
					    array(
	                        $Unidades_Cronogramas->Unidad_Id, 
	                        $Unidades_Cronogramas->Cronograma_Id
						)
					);
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Registrar(Unidades_Cronogramas $Unidades_Cronogramas)
		{
			try 
			{
			$sql = "INSERT INTO Unidades_Cronogramas (Unidad_Id,Cronograma_Id) 
			        VALUES (?, ?)";

			$this->pdo->prepare($sql)
			     ->execute(
					array(
						$Unidades_Cronogramas->Unidad_Id, 
						$Unidades_Cronogramas->Cronograma_Id,
	                )
				);
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}
	}
?>