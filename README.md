# SQL Database

CREATE DATABASE [laravel]
CREATE TABLE [dbo].[estudiantes](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[carnet] [nvarchar](255) NOT NULL,
	[nombre_completo] [nvarchar](255) NOT NULL,
	[fecha_nacimiento] [date] NOT NULL,
	[created_at] [datetime] NULL,
	[updated_at] [datetime] NULL
)


CREATE TABLE [dbo].[materias](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[codigo] [nvarchar](255) NOT NULL,
	[nombre] [nvarchar](255) NOT NULL,
	[created_at] [datetime] NULL,
	[updated_at] [datetime] NULL
	) 

CREATE TABLE [dbo].[matriculas](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[id_estudiante] [bigint] NOT NULL,
	[id_materia] [bigint] NOT NULL,
	[created_at] [datetime] NULL,
	[updated_at] [datetime] NULL,
) 

ALTER TABLE [dbo].[matriculas]  WITH CHECK ADD  CONSTRAINT [matriculas_id_estudiante_foreign] FOREIGN KEY([id_estudiante])
REFERENCES [dbo].[estudiantes] ([id])
GO
ALTER TABLE [dbo].[matriculas] CHECK CONSTRAINT [matriculas_id_estudiante_foreign]
GO
ALTER TABLE [dbo].[matriculas]  WITH CHECK ADD  CONSTRAINT [matriculas_id_materia_foreign] FOREIGN KEY([id_materia])
REFERENCES [dbo].[materias] ([id])
GO
ALTER TABLE [dbo].[matriculas] CHECK CONSTRAINT [matriculas_id_materia_foreign]
GO

# PROCEDIMIENTO ALMACENADO

CREATE PROCEDURE [dbo].[sp_matricular_estudiante]
	@Codigo VARCHAR(50),
	@Carnet VARCHAR(50)
AS
BEGIN
   DECLARE @IDM INT;
   DECLARE @IDE INT;
   DECLARE @EXISTEN INT;
   SET @IDM = (SELECT m.id FROM materias AS m WHERE m.codigo  = @Codigo);
   SET @IDE = (SELECT e.id FROM estudiantes AS e WHERE e.carnet  = @Carnet);
   
   SET @EXISTEN = (SELECT COUNT(id) FROM Matriculas WHERE id_estudiante = @IDE AND id_materia = @IDM)
 IF (@EXISTEN = 0)

   BEGIN
   INSERT INTO matriculas(id_estudiante, id_materia) VALUES ( @IDE , @IDM);
   SELECT'Agregado'
    
   END
 ELSE
BEGIN
   SELECT'Ya existe'
END
END


# DATOS DE PRUEBA


INSERT INTO estudiantes (carnet, nombre_completo, fecha_nacimiento)
VALUES ('CC19114', 'Erichsen', '06/03/2025');


INSERT INTO estudiantes (carnet, nombre_completo, fecha_nacimiento)
VALUES ('AA19114', 'Erichsen', '06/03/2025');


INSERT INTO materias(codigo, nombre)
VALUES ('MAT115', 'Matematica');


INSERT INTO materias(codigo, nombre)
VALUES ('MET115', 'Metodos');


EXEC sp_matricular_estudiante @Carnet='AA19114', @Codigo='MET115'

EXEC sp_matricular_estudiante @Carnet='AA19114', @Codigo='MAT115'

Si el estudiante no esta matriculado arroja un mensaje de "Agregado"
Si el estudiante si esta matriculado arroja un mensaje de "Ya existe"




----------------------------------------------------------------------------------------------------
# APLICACION CON LIVEWIRE

El ENV del a app es

DB_CONNECTION=sqlsrv
DB_HOST=ANALISTAP01-174\\SQLEXPRESS
DB_PORT=1433
DB_DATABASE=laravel
DB_USERNAME=evaluacion
DB_PASSWORD=evaluacion

//Para poder usarlo deben de crear una cuenta de usuario por el Started KIT, luego podran acceder

La aplicación le hizo falta el mensaje de cuando se agregan la matricula, de cuando ya hay una existente y un mensaje al eliminar la matricula, mostrar mensajes de las acciones, 

De ahi la funcionalidad, de mostrar las materias matriculadas, de eliminarlas, y de agregarlas estan

Pueden probar con los datos de pruebas de:

CARNET: AA19114
CARNET: CC19114

CODIGO MATERIA:  MAT115
CODIGO MATERIA:  MET115




