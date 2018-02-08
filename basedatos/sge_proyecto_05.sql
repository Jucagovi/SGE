--
-- Volcado de datos para la tabla `gen_tipo_mensaje`
--
INSERT INTO `gen_tipo_mensaje` (`id_tipo_mensaje`, `nombre`, `descripcion`) VALUES
(1, 'Individual', 'Mensaje dirigido específicamente a un empleado'),
(2, 'Público', 'Mensaje enviado a todos los empleados sin distinción de módulo ni permisos.'),
(3, 'Módulo', 'Mensaje enviado a todos los integrantres del módulo desde el que se envía');