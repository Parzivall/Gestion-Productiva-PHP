<?php

	class Directorio
	{
		private $pdo;
	    
	    public $Id;
	    public $Nombre;
	    public $Rubro_Id;
	    public $Web;
	    public $Telefono;
	    public $Telefono_Anexo;
	    public $Celular;
	    public $Ubicacion;
	    public $Ciudad_Id;
	    public $Persona_Dni;

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
				$stmt = $this->pdo->prepare("SELECT up.Id, up.Nombre, up.Rubro_Id, up.Web, up.Telefono, up.Telefono_Anexo, up.Celular, up.Ubicacion, up.Ciudad_Id, re.Persona_Dni FROM UnidadesProductivas up, Responsables re where up.Id = re.Unidad_Id LIMIT :startFrom,:resultsPerPage");
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

		public function getTotalRecords(){
			try {
				$stm = $this->pdo->prepare("SELECT up.Id, up.Nombre, up.Rubro_Id, up.Web, up.Telefono, up.Telefono_Anexo, up.Celular, up.Ubicacion, up.Ciudad_Id, re.Persona_Dni FROM UnidadesProductivas up, Responsables re where up.Id = re.Unidad_Id");
				$stm->execute();
				return $stm->rowCount();
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		public function getCiudadById($Id){
			try 
			{
				$stm = $this->pdo
				            ->prepare("SELECT * FROM Ciudades WHERE Id = ?");			          

				$stm->execute(array($Id));
				$row = $stm->fetch(PDO::FETCH_ASSOC);
				return $row['Nombre'];
			}
			catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function getRubroById($Id){
			try 
			{
				$stm = $this->pdo
				            ->prepare("SELECT * FROM Rubros WHERE Id = ?");			          

				$stm->execute(array($Id));
				$row = $stm->fetch(PDO::FETCH_ASSOC);
				return $row['Descripcion'];
			}
			catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}

		public function getResponsableByDni($Dni){
			try 
			{
				$stm = $this->pdo
				            ->prepare("SELECT * FROM Personas WHERE Dni = ?");			          

				$stm->execute(array($Dni));
				$row = $stm->fetch(PDO::FETCH_ASSOC);
				return $row['Nombres'].' '.$row['Apellidos'];
			}
			catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}
	}
?>