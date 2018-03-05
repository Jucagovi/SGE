INSERT INTO `pro_tipo_proyecto` (`id_tipo_proyecto`, `nombre`, `descripcion`, `imagen`) VALUES
	(1, 'Desarrollo Software', 'La empresa llevará a cabo un desarrollo de software', 'desarrollo_software.png');

	INSERT INTO `pro_tipo_etapa` (`id_tipo_etapa`, `nombre`, `descripcion`, `id_tipo_proyecto`) VALUES
	(1, 'Especificación de los requerimientos', 'Se concretaran todos los requerimientos para la correcta elaboración del software.', 1),
	(2, 'Diseño', 'Se llevará a cabo el apartado de diseño del software.', 1),
	(3, 'Implementación', 'Comenzará la implementación del software.', 1),
	(4, 'Integración', 'Comenzaran las pruebas de forma individual de todos los módulos', 1),
	(5, 'Validación y Verificación', 'Se llevarán a cabo pruebas más concretas al software en busca de posibles errores.', 1),
	(6, 'Mantenimiento', 'Una vez finalizado el software, se llevará a cabo un mantemiento del mismo.', 1);
	
	INSERT INTO `pro_tipo_tarea` (`id_tipo_tarea`, `nombre`, `descripcion`, `precio`, `id_tipo_etapa`) VALUES
	(1, 'Entrevista con el cliente', 'Se llevará a cabo una entrevista con el cliente para conocer sus requisitos.', 30.00000, 1),
	(2, 'Análisis del entorno de implantación', 'Se hará un estudio del entorno donde se va a desarrollar la aplicación', 100.00000, 1),
	(3, 'Programación de Fases', 'Se realizará el programa a seguir para el correcto desarrollo del software', 50.00000, 1),
	(4, 'Asignación de tareas', 'Se asignará a toda la plantilla las tareas que deberá realizar', 45.00000, 1),
	(5, 'Diagrama de clases', 'Se creará el diagrama de clases para planificar el proyecto.', 47.00000, 2),
	(6, 'Diagrama Entidad Relación', 'Se creará el diagrama entidad/relación de la base de datos a utilizar en el proyecto.', 150.00000, 2),
	(7, 'División de subsistemas', 'Se realiza la división de subsistemas.', 70.00000, 2),
	(8, 'Calendario de aplicación', 'Se organizará el calendario a seguir para la elaboración del proyecto.', 30.00000, 2),
	(9, 'Creación de la base de datos', 'Se creará la base de datos para el proyecto.', 15.00000, 3),
	(10, 'Inserción de datos', 'Se insertaran en la base de datos los valores necesarios.', 10.00000, 3),
	(11, 'Conversión de datos previos', 'Se hará la conversión de datos previos.', 10.00000, 3),
	(12, 'Programación', 'Se realizará toda la programación del software.', 25.00000, 3),
	(13, 'Pruebas unitarias por módulo', 'Se llevarán a cabo pruebas de forma individual de cada módulo', 10.00000, 4),
	(14, 'Unión de los subsistemas', 'Se unirán todos los subsistemas.', 10.00000, 4),
	(15, 'Pruebas de interfaz', 'Se llevarán a cabo pruebas de la interfaz gráfica del software.', 5.00000, 5),
	(16, 'Pruebas en conjunto alfa', 'Se llevarán a cabo pruebas en fase alfa', 10.00000, 5),
	(17, 'Pruebas beta', 'Se llevarán a cabo pruebas en versión beta', 10.00000, 5),
	(18, 'Modificación de software', 'Se llevarán a cabo modificaciones que puedan ser necesarias.', 20.00000, 6),
	(19, 'Asistencia', 'Labores de asistencia para la empresa.', 15.00000, 6),
	(20, 'Formación', 'Se formará a la empresa en el software desarrollado.', 20.00000, 6),
	(21, 'Periodo de garantía', 'Periodo de garantía dado a la empresa contratante.', 5.00000, 6);