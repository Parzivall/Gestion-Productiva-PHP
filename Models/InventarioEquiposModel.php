<?php 
	class InventarioEquipos
	{
		private $pdo;
        
        public $Id;
		public $Unidad_Id;
		public $Fecha_Ingreso;
		public $Condicion;
		public $EstadoOperativo;//se haria en cada equipos
		public $Observaciones;

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
				$limit = resultsPerPage;//acas lo guarda la variable
				$start = $startFrom;
			    $stmt = $this->pdo->prepare("SELECT * FROM InventarioEquipos ORDER BY Fecha_Ingreso ASC LIMIT :startFrom,:resultsPerPage" );
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

		public function Actualizar($Inventarioequipos)
		{
			try 
			{
				$sql = "UPDATE InventarioEquipos SET 

						Unidad_Id  		    =  ?,
	                    Fecha_Ingreso   	=  ?,
						Condicion           =  ?, 
						EstadoOperativo     =  ?,
						Observaciones        = ?
				    WHERE Id = ?";

				$this->pdo->prepare($sql)
			     ->execute(
				    array(		
	                    $Inventarioequipos->Unidad_Id,
                        $Inventarioequipos->Fecha_Ingreso,
                        $Inventarioequipos->Condicion,
                        $Inventarioequipos->EstadoOperativo,
                        $Inventarioequipos->Observaciones ,
                        $Inventarioequipos->Id//me salia invalido numero de tokens
					    )
					 );	
				}
			catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Registrar(InventarioEquipos $InventarioEquipos)
			{
				try 
				{
				$sql = "INSERT INTO InventarioEquipos (Unidad_Id,Fecha_Ingreso,Condicion,EstadoOperativo,Observaciones) 
				        VALUES (?,?,?,?,?)";

				$this->pdo->prepare($sql)
				     ->execute(
						array(
							$InventarioEquipos->Unidad_Id,
							$InventarioEquipos->Fecha_Ingreso,
							$InventarioEquipos->Condicion,
							$InventarioEquipos->EstadoOperativo,
							$InventarioEquipos->Observaciones,
		                )
					);
				     return $this->pdo->lastInsertId();
				} catch (Exception $e) 
				{
					die($e->getMessage());
				}
			}
        
        public function Obtener($Id)
        {
            try {
                $stmt=$this->pdo->prepare("SELECT * FROM InventarioEquipos Where Id = ?");
                $stmt->execute( array($Id) );
                return $stmt->fetch(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }

        public function getUnidades(){
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
	
		public function getTotalRecords(){//esto es para la paginacion
			try {
				$stm = $this->pdo->prepare("SELECT * FROM  InventarioEquipos");
				$stm->execute();
				return $stm->rowCount();
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
        
        public function getTotalRecordsporUnnidad($Id){//esto es para la paginacion
			try {
				$stm = $this->pdo->prepare("SELECT * FROM  InventarioEquipos Where 
					Unidad_Id =?");
				$stm->execute(array($Id));
				return $stm->rowCount();
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		public function getInventarioId($Id)
		{
			try {
				$stm = $this->pdo->prepare("SELECT * FROM  InventarioEquipos WHERE Unidad_Id = ?");
				$stm->execute( array($Id) );

				return $stm->fetchAll(PDO::FETCH_OBJ);
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

        public function Eliminar($Id)
		{
			//Faltar eliminar recursivamente las fks
			echo "pasa por acas en eliminar $Id";
			try 
			{
				$stm = $this->pdo
				            ->prepare("DELETE FROM InventarioEquipos WHERE Id = ?");			          
				$stm->execute(array($Id));

			} catch (Exception $e)
			{
				echo "dentra por acas";
				die($e->getMessage());
			}
		}

		public function getnombreUnidadId($Id)
		{
			try 
			{
				$stm = $this->pdo
				            ->prepare("SELECT * FROM UnidadesProductivas WHERE Id = ?");			          
				$stm->execute(array($Id));
				return $stm ->fetch(PDO::FETCH_OBJ);
			} catch (Exception $e)
			{
				echo "dentra por acas";
				die($e->getMessage());
			}	
		}

	}//llave de la clase
?>