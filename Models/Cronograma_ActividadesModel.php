<?php

	class Cronogramas_Actividades
	{
		private $pdo;
	    
	    public $Id;
	    public $Cumplido;
	    public $Actividad_Id;
	    public $Cronograma_Id;
	    public $Vencido;

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

				$stm = $this->pdo->prepare("SELECT * FROM Cronogramas_Actividades");
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
				          ->prepare("SELECT * FROM Cronogramas_Actividades WHERE id = ?");
				          

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
				            ->prepare("DELETE FROM Cronogramas_Actividades WHERE id = ?");			          

				$stm->execute(array($id));
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Actualizar(Cronogramas_Actividades $Cronogramas_Actividades)
		{
			try 
			{
				$sql = "UPDATE Cronogramas_Actividades SET 
							Cumplido        = ?, 
							Actividad_Id    = ?,
	                        Cronograma_Id   = ?,
							Vencido        	= ?,  
					    WHERE id = ?";

				$this->pdo->prepare($sql)
				     ->execute(
					    array(
	                        $Cronogramas_Actividades->Cumplido, 
	                        $Cronogramas_Actividades->Actividad_Id,
	                        $Cronogramas_Actividades->Cronograma_Id,
	                        $Cronogramas_Actividades->Vencido
						)
					);
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Registrar(Cronogramas_Actividades $Cronogramas_Actividades)
		{
			try 
			{
			$sql = "INSERT INTO Cronogramas_Actividades (Cumplido,Actividad_Id,Cronograma_Id,Vencido) 
			        VALUES (?, ?, ?, ?)";

			$this->pdo->prepare($sql)
			     ->execute(
					array(
						$Cronogramas_Actividades->Cumplido, 
						$Cronogramas_Actividades->Actividad_Id,
	                    $Cronogramas_Actividades->Cronograma_Id,
	                    $Cronogramas_Actividades->Vencido
	                )
				);
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}
	}
?>