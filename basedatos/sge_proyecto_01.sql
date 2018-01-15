--
-- Tabla: `gen_empleados` añadir columna curriculum
--
ALTER TABLE `gen_empleados` ADD `curriculum` VARCHAR(512) CHARACTER SET latin1 COLLATE latin1_general_cs NULL AFTER `contrasena`;
--
-- Tabla: `gen_empleados` añadir columna foto
--
ALTER TABLE `gen_empleados` ADD `foto` VARCHAR(512) CHARACTER SET latin1 COLLATE latin1_general_ci NULL AFTER `curriculum`;