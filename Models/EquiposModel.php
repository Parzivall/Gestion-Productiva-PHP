<?php

class Equipos
{
	private $pdo;

	public $Id;
	public $Descripcion;
	public $Marca;
	public $Modelo;
	public $Numero_Serie;
	public $Fecha_Fabricacion;
	public $InventarioEquipo_Id;
	function __construct()
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
			$limit = resultsPerPage;//acas lo guarda la variable
			$start = $startFrom;
		    $stmt = $this->pdo->prepare("SELECT * FROM Equipos ORDER BY Descripcion ASC LIMIT :startFrom,:resultsPerPage" );
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

	public function getEquipoporId($Id)
	{
		try {
			$stm = $this->pdo->prepare("SELECT do.Descripcion, do.Marca, do.Modelo ,do.NumeroSerie,do.Fecha_Fabricacion FROM  Equipos do WHERE          do.InventarioEquipo_Id = ?") ;

			$stm->execute(array($Id)) ;
			return $stm->fetchAll(PDO::FETCH_OBJ);
			
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Actualizar($detalleequipo)
		{

			try 
			{

				$sql = "UPDATE Equipos SET 
						Descripcion             = ?, 
						Marca              	    = ?,
                        Modelo  				= ?,
						NumeroSerie       		= ?, 
						Fecha_Fabricacion 		= ?,
						InventarioEquipo_Id 	= ?
				   		WHERE Id = ?";

				$this->pdo->prepare($sql)
			     ->execute(
				    array(
                        $detalleequipo->Descripcion,
                        $detalleequipo->Marca,
                        $detalleequipo->Modelo,
                        $detalleequipo->Numero_Serie,
                        $detalleequipo->Fecha_Fabricacion,
                        $detalleequipo->InventarioEquipo_Id
					)
				 );	
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Registrar(Equipos $detalleoperacion)
		{
			try 
			{
			  // $this->pdo->beginTransaction();	//prque se pone esto aqui??

				$sql = "INSERT INTO Equipos (Descripcion,Id,Marca,NumeroSerie,Modelo,Fecha_Fabricacion,InventarioEquipo_Id) 
				        VALUES (?,?,?,?,?,?,?) ";
				//echo "asma $detalleoperacion->Cantidad destpues";
				//echo "despues el id es $detalleoperacion->Material_Insumo_Id";
				 echo "lo que falla es el sql";
				$this->pdo->prepare($sql)
				     ->execute(
						array(
							$detalleoperacion->Descripcion,
							$detalleoperacion->Id, 	
		                    $detalleoperacion->Marca,
		                    $detalleoperacion->Numero_Serie,//estos son los datos que envias
		                    $detalleoperacion->Modelo,
		                    $detalleoperacion->Fecha_Fabricacion,
		                    $detalleoperacion->InventarioEquipo_Id
		                )
					);
				echo "despues sdls,d";;
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function getporInventarioEID($Id)
		{
			try {
				$stm = $this->pdo->prepare("SELECT * FROM  Equipos  WHERE  InventarioEquipo_Id= ?") ;

				$stm->execute(array($Id)) ;
				return $stm->fetchAll();
				
			} catch (Exception $e) {
				die($e->getMessage());
			}

		}

		public function Eliminar($Id)
		{
			try 
			{
				$stm = $this->pdo
				            ->prepare("DELETE FROM Equipos WHERE Id = ?");			          
				$stm->execute(array($Id));

			} catch (Exception $e)
			{
				echo "dentra por acas";
				die($e->getMessage());
			}
		}

}
?>