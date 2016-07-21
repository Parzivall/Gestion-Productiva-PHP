<?php

	class Cronogramas
	{
		private $pdo;
	    
	    public $Id;
	    public $Fecha;
	    public $Cumplido;

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

				$stm = $this->pdo->prepare("SELECT * FROM Cronogramas");
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
				          ->prepare("SELECT * FROM Cronogramas WHERE id = ?");
				          

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
				            ->prepare("DELETE FROM Cronogramas WHERE id = ?");			          

				$stm->execute(array($id));
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Actualizar(Cronogramas $Cronogramas)
		{
			try 
			{
				$sql = "UPDATE Cronogramas SET 
							Fecha          = ?, 
							Cumplido      = ?,
					    WHERE id = ?";

				$this->pdo->prepare($sql)
				     ->execute(
					    array(
	                        $Cronogramas->Fecha, 
	                        $Cronogramas->Cumplido
						)
					);
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Registrar(Cronogramas $Cronogramas)
		{
			try 
			{
			$sql = "INSERT INTO Cronogramas (Fecha,Cumplido) 
			        VALUES (?, ?)";

			$this->pdo->prepare($sql)
			     ->execute(
					array(
						$Cronogramas->Fecha, 
						$Cronogramas->Cumplido,
	                )
				);
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}
	}
?>