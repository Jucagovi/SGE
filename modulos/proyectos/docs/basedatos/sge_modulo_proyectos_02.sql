ALTER TABLE `pro_historico` CHANGE `fecha` `fecha` DATE NOT NULL;
ALTER TABLE `pro_historico` CHANGE `id_empleado` `id_empleado` INT(11) NOT NULL COMMENT 'empleado que realizo la accion';