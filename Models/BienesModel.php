<?php

class Bienes
{
	public $pdo;
	public $Id;
	public $Descripcion;
	public $TipoMaterial_Id;
	public $InventarioBien_Id;	
	function __construct()
	{
		try
		{
			$this->pdo=Database::Conectar();
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
				$stmt= $this->pdo->prepare("SELECT * FROM Bienes ORDER BY Descripcion ASC LIMIT :startFrom,:resultsPerPage");
				$stmt->bindValue(":startFrom", (int)$start, PDO::PARAM_INT);//lo pone el valor a la variable
				$stmt->bindValue(":resultsPerPage", (int)$limit, PDO::PARAM_INT);
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_OBJ);
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}
		}

		public function Registrar($Bienes)
		{
			try
			{
				$sql = "INSERT INTO Bienes (Id,Descripcion,TipoMaterial_Id,InventarioBien_Id) 
				VALUES (?,?,?,?)";
				$this->pdo->prepare($sql)->execute(array(
					$Bienes->Id,
					$Bienes->TipoMaterial_Id,
					$Bienes->InventarioBien_Id
				 )
				);
			} 
			catch(Exception $e)
			{
				die($e->getMessage());
			}
		}


		public function Actualizar($Bienes)
		{
			try 
			{
				$sql = "UPDATE  SET 
					Descripcion  		=  ?, 
    				TipoMaterial_Id     =  ?,
     				InventarioBien_Id  	=  ?
			  	WHERE Id = ?";

				$this->pdo->prepare($sql)->execute(array(		
			     $Bienes->Descripcion,
			     $Bienes->InventarioBien_Id,
			     $Bienes->TipoMaterial_Id
			  )
			 );	
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Eliminar($Id)
		{
			try
			{
				$stm = $this->pdo->prepare("DELETE FROM Bienes WHERE Id =?");
				$stm->execute(array($Id));
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}
		}
		public function getTotalRecords()
		{
			try
			{
				$stm = $this->pdo->prepare("SELECT * FROM Bienes");
				$stm->execute();
				return $stm->rowCount();
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}
		}

		public function obteneridbienes($Id)
		{
			try
			{
				$stm = $this->pdo->prepare("SELECT * FROM Bienes WHERE Id =?");
				$stm->execute(array($Id));
				return $stm->fetchAll(PDO::FETCH_OBJ);
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}
		}
}
?>