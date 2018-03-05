INSERT INTO `gen_secciones` (`nombre`, `descripcion`, `permiso`, `orden`, `id_modulo`, `identificador`) VALUES ('Inicio', 'Ver el tablón del módulo', 0, 1, 2, 'tablonProyectos');
INSERT INTO `gen_secciones` (`nombre`, `descripcion`, `permiso`, `orden`, `id_modulo`, `identificador`) VALUES ('Proyectos', 'Ver los proyectos', 0, 1, 2, 'verProyectos');
INSERT INTO `gen_secciones` (`nombre`, `descripcion`, `permiso`, `orden`, `id_modulo`, `identificador`) VALUES ('Presupuestos', 'Ver los presupuestos', 0, 1, 2, 'verPresupuestos');
/* Sección Herramientas y sus dos subsecciones */
INSERT INTO `gen_secciones` (`nombre`, `descripcion`, `permiso`, `orden`, `id_modulo`, `identificador`) VALUES ('Herramientas', 'Herramientas del módulo', 0, 1, 2, 'herramientas');
INSERT INTO `gen_subsecciones` ( `nombre`, `descripcion`, `permiso`, `orden`, `id_seccion`, `identificador`) VALUES ('Crear tipo de proyecto', 'Herramienta de generación de tipos de proyecto', 0, 1, 6, 'crearTipoProyecto');
INSERT INTO `gen_subsecciones` ( `nombre`, `descripcion`, `permiso`, `orden`, `id_seccion`, `identificador`) VALUES ('Crear presupuesto', 'Herramienta para crear un presupuesto', 0, 2, 6, 'crearPresupuesto');