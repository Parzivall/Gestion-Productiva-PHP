<?php

	class Documento
	{
		private $pdo;
	    
	    public $Id;
	    public $Unidad_Id;
	    public $Fecha_Legalizacion;
	    public $Numero_Folios;
	    public $EstadoOperativo;
	    public $Observaciones;
	    public $Descripcion;
	    public $Tipo_Documento_Id;
	    public $Numero;

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
				$stmt = $this->pdo->prepare("SELECT * FROM DocumentoExistente ORDER BY Fecha_Legalizacion ASC LIMIT :startFrom,:resultsPerPage");
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

		public function Buscar($startFrom, $busqueda)
		{
			try
			{
				$limit = resultsPerPage;
				$start = $startFrom;
				$busqueda = '%'.$busqueda.'%';
				$stmt = $this->pdo->prepare("SELECT * FROM DocumentoExistente where Descripcion LIKE :busqueda ORDER BY Descripcion ASC LIMIT :startFrom,:resultsPerPage");
				$stmt->bindparam(":busqueda", $busqueda);
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

		public function Obtener($Id)
		{
			try 
			{
				$stm = $this->pdo
				          ->prepare("SELECT * FROM DocumentoExistente WHERE Id = ?");
				          

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
			            ->prepare("DELETE FROM DocumentoExistente WHERE Id = ?");
			$stm->execute(array($Id));
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Actualizar(Documento $documento)
		{
			try 
			{
				$sql = "UPDATE DocumentoExistente SET 
						Descripcion          = ?, 
						Tipo_Documento_Id        = ?,
                        Numero        		= ?,
						Fecha_Legalizacion        = ?, 
						Numero_Folios  = ?,
						EstadoOperativo 			= ?, 
						Observaciones 		= ?, 
						Unidad_Id 		= ? 
				    WHERE Id = ?";

				$this->pdo->prepare($sql)
			     ->execute(
				    array(
                        $documento->Descripcion, 
                        $documento->Tipo_Documento_Id,
                        $documento->Numero,
                        $documento->Fecha_Legalizacion,
                        $documento->Numero_Folios,
                        $documento->EstadoOperativo,
                        $documento->Observaciones,
                        $documento->Unidad_Id,
                        $documento->Id
					)
				);	
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function Registrar(documento $documento)
		{
			try 
			{
			$sql = "INSERT INTO DocumentoExistente (Descripcion,Tipo_Documento_Id,Numero,Fecha_Legalizacion, Numero_Folios, EstadoOperativo, Observaciones, Unidad_Id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

			$this->pdo->prepare($sql)
			     ->execute(
					array(
						$documento->Descripcion, 
                        $documento->Tipo_Documento_Id,
                        $documento->Numero,
                        $documento->Fecha_Legalizacion,
                        $documento->Numero_Folios,
                        $documento->EstadoOperativo,
                        $documento->Observaciones,
                        $documento->Unidad_Id,
	                )
				);
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function getTotalRecords(){
			try {
				$stm = $this->pdo->prepare("SELECT * FROM DocumentoExistente");
				$stm->execute();
				return $stm->rowCount();
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		public function getTotalRecordsBusqueda($busqueda){
			try {
				if ($busqueda!='')
				{
					$busqueda = '%'.$busqueda.'%';
					$stmt = $this->pdo->prepare("SELECT * FROM DocumentoExistente where Descripcion LIKE :busqueda");
					$stmt->bindparam(":busqueda", $busqueda);
					$stmt->execute();
					return $stmt->rowCount();
				} else {
					$stmt = $this->pdo->prepare("SELECT * FROM DocumentoExistente");
					$stmt->execute();
					return $stmt->rowCount();
				}
				
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
	}
?>