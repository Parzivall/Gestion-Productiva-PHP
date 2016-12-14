<?php 
	class InventarioFisico
	{
		private $pdo;
        
        public $Id;
		public $TipoExistencia_Id;
		public $UnidadMedida_Id;
		public $Periodo;
		public $Descripcion_Existencia;
		public $Codigo_Existencia;//esto ya no deberia de dentrar porque ya tiene 
		//la descripvin de existencia
		public $Unidad_Id;
        public $incremento;

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
			    $stmt = $this->pdo->prepare("SELECT * FROM InventarioFisico ORDER BY Descripcion_Existencia ASC LIMIT :startFrom,:resultsPerPage" );
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

		public function Actualizar(InventarioFisico $Inventariofisico)
		{
			try 
			{
				$sql = "UPDATE InventarioFisico SET 
						TipoExistencia_Id  =  ?, 
	    				UnidadMedida_Id     =  ?,
	                    Periodo       		=  ?,
						Descripcion_Existencia  = ?, 
						Codigo_Existencia = ?,
						Unidad_Id = ?
				    WHERE Id = ?";

				$this->pdo->prepare($sql)->execute(
				    array(
				    	$Inventariofisico->Id,
	                    $Inventariofisico->TipoExistencia_Id,
                        $Inventariofisico->UnidadMedida_Id,
                        var_dump($Inventariofisico->Periodo),//$Inventariofisico->Periodo,
                        $Inventariofisico->Descripcion_Existencia,
                        $Inventariofisico->Codigo_Existencia,
                        $Inventariofisico->Unidad_Id,
					    )
					 );
			}
			catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Registrar(InventarioFisico $InventarioFisico)
			{
				echo "meto aqui var_dump($InventarioFisico->Periodo) ";

				try 
				{
//					$this->pdo->beginTransaction();	//prque se pone esto aqui??

				$sql = "INSERT INTO InventarioFisico (Id,TipoExistencia_Id,UnidadMedida_Id,Unidad_Id,Periodo,Descripcion_Existencia,Codigo_Existencia) 
				        VALUES (?,?,?,?,?,?,?)";

				$this->pdo->prepare($sql)
				     ->execute(
						array(
							$InventarioFisico->Id,
							$InventarioFisico->TipoExistencia_Id,
							$InventarioFisico->UnidadMedida_Id,
							$InventarioFisico->Unidad_Id,
						    $InventarioFisico->Periodo,//esto es sin el var_dump recuerda
							$InventarioFisico->Descripcion_Existencia,
							$InventarioFisico->Codigo_Existencia
		                )
					);
				    return $this->pdo->lastInsertId();
				} catch (Exception $e) 
				{
					die($e->getMessage());
				}

				echo "esto se acaba";
			}
        
        public function Obtener($Id)
        {
            try {
                $stmt=$this->pdo->prepare("SELECT * FROM InventarioFisico Where Id = ?");
                $stmt->execute( array($Id) );
                return $stmt->fetch(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }

        public function getUnidadMedida()
        {
        	try
        	{
        		$stmt = $this->pdo->prepare("SELECT * FROM UnidadMedida ORDER BY Id ASC");
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_OBJ);
        	}
        	catch(Exception $e){
        		die($e->getMessage());	
        	}
        }

        public function getTipos_inventarios()
        {
        	try
        	{
        		$stmt = $this->pdo->prepare("SELECT * FROM TipoExistencia ORDER BY Id ASC");
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_OBJ);
        	}
        	catch(Exception $e){
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

		public function getMontoTotal($Id){
			try 
			{
				$stm = $this->pdo
				            ->prepare("SELECT sum(Monto) FROM Operaciones op, DetallesOperacion do where op.Id = do.Operacion_Id and op.Id = ?");			          

				$stm->execute(array($Id));
				$row = $stm->fetch(PDO::FETCH_NUM);
				return $row[0];
			}
			catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function getCantidadDetalle($Id){
			try 
			{
				$stm = $this->pdo
				            ->prepare("SELECT sum(Cantidad) FROM InventarioFisico_Detalle WHERE InventarioFisico_Id = ? ");			          
				$stm->execute(array($Id));
				//$row = mysql_fetch_array($stm)
				$row = $stm->fetch(PDO::FETCH_NUM);
			    //echo "que es lo que saca acas $row[0]";

				return $row[0];//aca saca la columna
			}
			catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}


		public function getTotalRecords(){//esto es para la paginacion
			try {
				$stm = $this->pdo->prepare("SELECT * FROM  InventarioFisico");
				$stm->execute();
				return $stm->rowCount();
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

        public function getTotalRecordsporUnnidad($Id){
			try {
				$stm = $this->pdo->prepare("SELECT * FROM  InventarioFisico Where 
					Unidad_Id =?");
				$stm->execute(array($Id));
				return $stm->rowCount();
				
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
				            ->prepare("DELETE FROM InventarioFisico WHERE Id = ?");			          
				$stm->execute(array($Id));

				//$this->pdo->commit();//averiguar que esto 

			} catch (Exception $e)
			{
				echo "dentra por acas";
				die($e->getMessage());
			}
		}

		public function getporIddetalle($Id)
		{
			try 
			{
				$stm = $this->pdo
				            ->prepare("DELETE FROM InventarioFisico_Detalle WHERE InventarioFisico_Id = ?");			          
				$stm->execute(array($Id));

				
				return $stmt->fetchAll(PDO::FETCH_OBJ);

			} catch (Exception $e)
			{
				echo "dentra por acas";
				die($e->getMessage());
			}

		}
        public function getInventarioFisico_DetalleById($Id){
			try 
			{
				$stm = $this->pdo
				            ->prepare("SELECT * FROM InventarioFisico_Detalle WHERE Id = ?");			        
				$stm->execute(array($Id));
				$row = $stm->fetch(PDO::FETCH_ASSOC);
				return $row['Cantidad'];//como saco dos atributos ?? para sacar tambien el estado
			}
			catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

        public function getInventarioFisico_DetalleById2($Id){
			try 
			{
				$stm = $this->pdo
				            ->prepare("SELECT * FROM InventarioFisico_Detalle WHERE Id = ?");			        
				$stm->execute(array($Id));
				$row = $stm->fetch(PDO::FETCH_ASSOC);
				return $row['Id'];//como saco dos atributos ?? para sacar tambien el estado
			}
			catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function getUnidadMedidaById($Id){
			try 
			{
				$stm = $this->pdo
				            ->prepare("SELECT * FROM UnidadMedida WHERE Id = ?");			          

				$stm->execute(array($Id));
				$row = $stm->fetch(PDO::FETCH_ASSOC);
				return $row['Nombre'];
			}
			catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function getDetalle_Cantidad($Id)
		{
				try 
			    {
					$stm = $this->pdo
					            ->prepare("SELECT * FROM InventarioFisico_Detalle WHERE InventarioFisico_Id = ?");		          

					$stm->execute(array($Id));
					 //$stm->fetch(PDO::FETCH_ASSOC);
					return $stm->fetch(PDO::FETCH_ASSOC);;
				}
				catch (Exception $e) 
				{
					die($e->getMessage());
				}
		}
		public function getMaterial_InsumoById($Id){
				try 
			    {
					$stm = $this->pdo
					            ->prepare("SELECT * FROM Material_Insumo WHERE Id = ?");		          

					$stm->execute(array($Id));
					$row = $stm->fetch(PDO::FETCH_ASSOC);
					return $row['Marca'];
				}
				catch (Exception $e) 
				{
					die($e->getMessage());
				}
			}
		}

?>


