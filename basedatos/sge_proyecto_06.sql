--
-- Insertar nueva columna "nif" en la tabla gen_empleados
--
ALTER TABLE `gen_empleados` ADD `nif` VARCHAR(15) NOT NULL AFTER `id_departamento`;