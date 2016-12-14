<?php 
	class InventarioBienes
	{
		private $pdo;
		public $Id;
		public $Cantidad;
		public $Estado;
		public $Observaciones;
		public $EstadoOperativo;
		public $Unidad_Id;

		/*es necesario un atributo llamado fecha de ingreso*/

		public function __construct()
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
				$stmt= $this->pdo->prepare("SELECT * FROM InventarioBienes ORDER BY Fecha_Ingreso ASC LIMIT :startFrom,:resultsPerPage");
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

		public function Registrar($InventarioBienes)
		{
			try
			{
				$sql = "INSERT INTO InventarioBienes (Cantidad, Id,Estado,Observaciones,EstadoOperativo,Unidad_Id,Fecha_Ingreso) 
				VALUES (?,?,?,?,?,?,?)";
				$this->pdo->prepare($sql)->execute(array(
					$InventarioBienes->Cantidad,
					$InventarioBienes->Id,
					$InventarioBienes->Estado,
					$InventarioBienes->Observaciones,
					$InventarioBienes->EstadoOperativo,
					$InventarioBienes->Unidad_Id,
					$InventarioBienes->Fecha_Ingreso
				 )
				);
			} 
			catch(Exception $e)
			{
				die($e->getMessage());
			}
		}
		public function Eliminar($Id)
		{
			try
			{
				$stm = $this->pdo->prepare("DELETE FROM InventarioBienes WHERE Id =?");
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
				$stm = $this->pdo->prepare("SELECT * FROM InventarioBienes");
				$stm->execute();
				return $stm->rowCount();
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
    $stmt=$this->pdo->prepare("SELECT * FROM InventarioBienes Where Id = ?");
    $stmt->execute( array($Id) );
    return $stmt->fetch(PDO::FETCH_OBJ);
			} 
			catch (Exception $e) 
			{
    die($e->getMessage());
   }
  }
  public function getUnidades()
  {
			try
			{
				$stmt = $this->pdo->prepare("SELECT * FROM UnidadesProductivas ORDER BY Nombre ASC");
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_OBJ);

			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}
		}
		public function Actualizar($InventarioBienes)
		{
			try 
			{
				$sql = "UPDATE InventarioEquipos SET 
					Unidad_Id  =  ?, 
    	Equipo_Id     =  ?,
     Fecha_Ingreso   	=  ?,
					Condicion  = ?, 
					EstadoOperativo = ?,
					Observaciones = ?
			  WHERE Id = ?";

				$this->pdo->prepare($sql)->execute(array(		
     $Inventarioequipos->Unidad_Id,
     $Inventarioequipos->Equipo_Id,
     $Inventarioequipos->Fecha_Ingreso,
     $Inventarioequipos->Condicion,
     $Inventarioequipos->EstadoOperativo,
     $Inventarioequipos->Observaciones 
			  )
			 );	
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
	}
	public function ObtenerNombreUnidadProductiva($Id)
	{
		try {
			$stm = $this->pdo->prepare("SELECT * FROM UnidadesProductivas WHERE Id =?");
				$stm->execute(array($Id));
				return $stm->fetch(pdo::FETCH_OBJ);	
		} catch (Exception $e) {
				die($e->getMessage());
		}
	}
	public function Obtenerbienes()
	{
		try{
			$stm = $this->pdo->prepare("SELECT * FROM Bienes ");
				$stm->execute();
				return $stm->fetchAll(pdo::FETCH_OBJ);	
		}
		catch(Exception $e){
			die($e->getMessage());
		}
	}
}
?>
