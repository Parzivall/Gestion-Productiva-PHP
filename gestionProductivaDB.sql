
CREATE TABLE Usuarios (
                Username VARCHAR NOT NULL,
                Password VARCHAR NOT NULL,
                UltimaConexion DATE,
                PRIMARY KEY (Username)
);


CREATE TABLE Ciudades (
                Id INT NOT NULL,
                Nombre VARCHAR NOT NULL,
                PRIMARY KEY (Id)
);


CREATE TABLE TipoProductoServicio (
                Id INT NOT NULL,
                Descripcion VARCHAR NOT NULL,
                PRIMARY KEY (Id)
);


CREATE TABLE ProductoServicio (
                Id INT NOT NULL,
                TipoProductoServicio_Id INT NOT NULL,
                Descripcion VARCHAR NOT NULL,
                Imagen BINARY NOT NULL,
                Tipo TINYINT NOT NULL,
                PRIMARY KEY (Id)
);


CREATE TABLE Actividades (
                Id INT NOT NULL,
                FechaInicio DATE NOT NULL,
                FechaFin DATE NOT NULL,
                Descripcion VARCHAR NOT NULL,
                PRIMARY KEY (Id)
);


CREATE TABLE Cargos (
                Id INT NOT NULL,
                Descripcion VARCHAR NOT NULL,
                CargoSuperior INT NOT NULL,
                PRIMARY KEY (Id)
);


CREATE TABLE Rubros (
                Id INT NOT NULL,
                Descripcion VARCHAR NOT NULL,
                PRIMARY KEY (Id)
);


CREATE TABLE Detalles (
                Id INT NOT NULL,
                Descripcion VARCHAR NOT NULL,
                Monto DOUBLE PRECISION NOT NULL,
                PRIMARY KEY (Id)
);


CREATE TABLE Personas (
                Dni VARCHAR NOT NULL,
                Username VARCHAR NOT NULL,
                Nombres VARCHAR NOT NULL,
                Apelidos VARCHAR NOT NULL,
                Direccion VARCHAR NOT NULL,
                Telefono VARCHAR NOT NULL,
                Email VARCHAR NOT NULL,
                Web VARCHAR NOT NULL,
                Nacimiento DATE NOT NULL,
                PRIMARY KEY (Dni)
);


CREATE TABLE Cronogramas (
                Id INT NOT NULL,
                Fecha DATE NOT NULL,
                Cumplido BOOLEAN NOT NULL,
                PRIMARY KEY (Id)
);


CREATE TABLE Cronogramas_Actividades (
                Id INT NOT NULL,
                Cumplido BOOLEAN NOT NULL,
                Actividad_Id INT NOT NULL,
                Cronograma_Id INT NOT NULL,
                Vencido BOOLEAN NOT NULL,
                PRIMARY KEY (Id)
);


CREATE TABLE UnidadesProductivas (
                Id INT NOT NULL,
                Nombre VARCHAR NOT NULL,
                Rubro_Id INT NOT NULL,
                Web VARCHAR NOT NULL,
                Telefono INT NOT NULL,
                Telefono_Anexo INT NOT NULL,
                Fax VARCHAR NOT NULL,
                Celular VARCHAR NOT NULL,
                Ubicacion VARCHAR NOT NULL,
                Ciudad_Id INT NOT NULL,
                PRIMARY KEY (Id)
);


CREATE TABLE Responsables (
                Id INT NOT NULL,
                Unidad_Id INT NOT NULL,
                Persona_Dni VARCHAR NOT NULL,
                PRIMARY KEY (Id)
);


CREATE TABLE Unidades_Cronogramas (
                Id INT NOT NULL,
                Unidad_Id INT NOT NULL,
                Cronograma_Id INT NOT NULL,
                PRIMARY KEY (Id)
);


CREATE TABLE Operaciones (
                Id INT NOT NULL,
                Tipo TINYINT NOT NULL,
                Monto DOUBLE PRECISION NOT NULL,
                Unidad_Id INT NOT NULL,
                PRIMARY KEY (Id)
);


CREATE TABLE Detalle_Operacion (
                Id INT NOT NULL,
                Operacion_Id INT NOT NULL,
                Detalle_Id INT NOT NULL,
                PRIMARY KEY (Id)
);


CREATE TABLE Unidades_ProductosServicios (
                Id INT NOT NULL,
                Unidad_Id INT NOT NULL,
                ProductoServicio_Id INT NOT NULL,
                PRIMARY KEY (Id)
);


CREATE TABLE Unidades_Personas (
                Id INT NOT NULL,
                Persona_Dni VARCHAR NOT NULL,
                Unidad_Id INT NOT NULL,
                Cargo_Id INT NOT NULL,
                PRIMARY KEY (Id)
);


ALTER TABLE Personas ADD CONSTRAINT usuarios_personas_fk
FOREIGN KEY (Username)
REFERENCES Usuarios (Username)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE UnidadesProductivas ADD CONSTRAINT ciudades_unidadesproductivas_fk
FOREIGN KEY (Ciudad_Id)
REFERENCES Ciudades (Id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE ProductoServicio ADD CONSTRAINT tipoproductoservicio_productoservicio_fk
FOREIGN KEY (TipoProductoServicio_Id)
REFERENCES TipoProductoServicio (Id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Unidades_ProductosServicios ADD CONSTRAINT productoservicio_unidades_productosservicios_fk
FOREIGN KEY (ProductoServicio_Id)
REFERENCES ProductoServicio (Id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Cronogramas_Actividades ADD CONSTRAINT hitos_cronogramas_hitos_fk
FOREIGN KEY (Actividad_Id)
REFERENCES Actividades (Id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Cargos ADD CONSTRAINT cargos_cargos_fk
FOREIGN KEY (CargoSuperior)
REFERENCES Cargos (Id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Unidades_Personas ADD CONSTRAINT cargos_unidades_personas_fk
FOREIGN KEY (Cargo_Id)
REFERENCES Cargos (Id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE UnidadesProductivas ADD CONSTRAINT rubros_unidadesproductivas_fk
FOREIGN KEY (Rubro_Id)
REFERENCES Rubros (Id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Detalle_Operacion ADD CONSTRAINT detalles_detalle_operacion_fk
FOREIGN KEY (Detalle_Id)
REFERENCES Detalles (Id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Unidades_Personas ADD CONSTRAINT personas_unidades_personas_fk
FOREIGN KEY (Persona_Dni)
REFERENCES Personas (Dni)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Responsables ADD CONSTRAINT personas_responsables_fk
FOREIGN KEY (Persona_Dni)
REFERENCES Personas (Dni)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Cronogramas_Actividades ADD CONSTRAINT cronogramas_cronogramas_hitos_fk
FOREIGN KEY (Cronograma_Id)
REFERENCES Cronogramas (Id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Unidades_Cronogramas ADD CONSTRAINT cronogramas_unidades_cronogramas_fk
FOREIGN KEY (Cronograma_Id)
REFERENCES Cronogramas (Id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Unidades_Personas ADD CONSTRAINT unidadesproductivas_unidades_personas_fk
FOREIGN KEY (Unidad_Id)
REFERENCES UnidadesProductivas (Id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Unidades_ProductosServicios ADD CONSTRAINT unidadesproductivas_unidades_productosservicios_fk
FOREIGN KEY (Unidad_Id)
REFERENCES UnidadesProductivas (Id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Operaciones ADD CONSTRAINT unidadesproductivas_operaciones_fk
FOREIGN KEY (Unidad_Id)
REFERENCES UnidadesProductivas (Id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Unidades_Cronogramas ADD CONSTRAINT unidadesproductivas_unidades_cronogramas_fk
FOREIGN KEY (Unidad_Id)
REFERENCES UnidadesProductivas (Id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Responsables ADD CONSTRAINT unidadesproductivas_responsables_fk
FOREIGN KEY (Unidad_Id)
REFERENCES UnidadesProductivas (Id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Detalle_Operacion ADD CONSTRAINT operaciones_detalle_operacion_fk
FOREIGN KEY (Operacion_Id)
REFERENCES Operaciones (Id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;
