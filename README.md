#SQL Database

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

##PROCEDIMIENTO ALMACENADO

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


