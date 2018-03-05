<?php

class Instalador extends Tabla {

    public function __construct($fea) {
        parent::__construct($fea);
    }

    public function instalar($datos = false) {
        $sql = "
        SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS inv_historicos;
DROP TABLE IF EXISTS inv_tipos_productos;
DROP TABLE IF EXISTS inv_productos;
DROP TABLE IF EXISTS inv_propas;
DROP TABLE IF EXISTS inv_categorias;
DROP TABLE IF EXISTS inv_catatr;
DROP TABLE IF EXISTS inv_atributos;
DROP TABLE IF EXISTS inv_valores;
DROP TABLE IF EXISTS inv_recepciones;
DROP TABLE IF EXISTS inv_estadorecepciones;
DROP TABLE IF EXISTS inv_inventarios;
DROP TABLE IF EXISTS inv_transferencias;
DROP TABLE IF EXISTS inv_estadotransferencias;
DROP TABLE IF EXISTS inv_pasillos;
DROP TABLE IF EXISTS inv_secciones;
DROP TABLE IF EXISTS inv_almacenes;
DROP TABLE IF EXISTS inv_almsec;
DROP TABLE IF EXISTS inv_secpas;
DROP TABLE IF EXISTS inv_invalm;
SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE `inv_historicos` (
  `id_historico` int(10) AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `modulo` varchar(20) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `accion` varchar(140) NOT NULL,
  PRIMARY KEY (`id_historico`)
);

CREATE TABLE inv_tipos_productos(
id_tipo_producto INT AUTO_INCREMENT,
tipo varchar(50) NOT NULL,
descripcion VARCHAR(50),
PRIMARY KEY (id_tipo_producto));

CREATE TABLE inv_productos (
id_producto INT(10) AUTO_INCREMENT,
nombre VARCHAR(20) NOT NULL,
descripcion VARCHAR(100), 
fecha_alta DATE NOT NULL, 
fecha_baja DATE,
imagen VARCHAR(200),
cod_barras VARCHAR(50),
precio INT,
coste INT,
peso INT,
volumen INT,
id_categoria INT(10),
id_tipo_producto INT,
PRIMARY KEY (id_producto)
);

CREATE TABLE inv_propas(
id_propas INT(10) AUTO_INCREMENT,
id_producto INT(10),
id_pasillo INT(10),
cantidad INT,
PRIMARY KEY (id_propas)
);


CREATE TABLE inv_categorias(
id_categoria INT(10) AUTO_INCREMENT,
nombre VARCHAR(20) NOT NULL,
PRIMARY KEY (id_categoria)
);

CREATE TABLE inv_catatr(
id_catatr INT(10) AUTO_INCREMENT,
id_categoria INT(10),
id_atributo INT(10),
PRIMARY KEY (id_catatr)
);

CREATE TABLE inv_atributos(
id_atributo INT(10) AUTO_INCREMENT,
nombre VARCHAR(20) NOT NULL,
descripcion VARCHAR(50),
PRIMARY KEY (id_atributo)
);

CREATE TABLE inv_valores(
id_valor INT(10) AUTO_INCREMENT,
valor VARCHAR(20) NOT NULL,
id_producto INT(10),
id_atributo INT(10),
PRIMARY KEY (id_valor)
);

CREATE TABLE inv_recepciones(
id_recepcion INT(10) AUTO_INCREMENT,
nombre VARCHAR(20) NOT NULL,
cantidad INT NOT NULL,
fecha_recepcion DATE,
id_producto INT(10),
id_pasillo INT(10),
id_estado INT(10),
PRIMARY KEY(id_recepcion)
);

CREATE TABLE inv_estadorecepciones(
id_estado INT(10) AUTO_INCREMENT,
estado VARCHAR(20) NOT NULL,
PRIMARY KEY (id_estado)
);

CREATE TABLE inv_inventarios(
id_inventario INT(10) AUTO_INCREMENT,
nombre VARCHAR(20) NOT NULL,
PRIMARY KEY(id_inventario)
);

CREATE TABLE inv_transferencias(
id_transferencia INT(10)AUTO_INCREMENT,
nombre VARCHAR(20) NOT NULL,
cantidad INT,
plazo_entrega INT,
id_producto INT(10),
id_pasillo_origen INT(10),
id_pasillo_destino INT(10),
id_estado INT(10),
PRIMARY KEY (id_transferencia)
);

CREATE TABLE inv_estadotransferencias(
id_estado INT(10) AUTO_INCREMENT,
estado VARCHAR(20) NOT NULL,
PRIMARY KEY (id_estado)
);

CREATE TABLE inv_pasillos(
id_pasillo INT(10) AUTO_INCREMENT,
nombre VARCHAR(20) NOT NULL,
cantPro INT,
PRIMARY KEY (id_pasillo)
);

CREATE TABLE inv_secciones(
id_seccion INT(10) AUTO_INCREMENT,
nombre VARCHAR(20) NOT NULL,
cantProPas INT,
PRIMARY KEY (id_seccion)
);

CREATE TABLE inv_almacenes(
id_almacen INT(10) AUTO_INCREMENT,
nombre VARCHAR(20) NOT NULL,
cantProSec INT,
PRIMARY KEY (id_almacen)
);

CREATE TABLE inv_almsec(
id_almsec INT(10) AUTO_INCREMENT,
id_almacen INT(10),
id_seccion INT(10),
PRIMARY KEY (id_almsec)
);

CREATE TABLE inv_secpas(
id_secpas INT(10) AUTO_INCREMENT,
id_seccion INT(10),
id_pasillo INT(10),
PRIMARY KEY (id_secpas)
);

CREATE TABLE inv_invalm(
id_invalm INT(10) AUTO_INCREMENT,
id_inventario INT(10),
id_almacen INT(10),
PRIMARY KEY (id_invalm)
);


ALTER TABLE inv_productos
ADD FOREIGN KEY (id_categoria) REFERENCES inv_categorias(id_categoria),
ADD FOREIGN KEY (id_tipo_producto) REFERENCES inv_tipos_productos(id_tipo_producto);

ALTER TABLE inv_propas
ADD FOREIGN KEY (id_producto) REFERENCES inv_productos(id_producto),
ADD FOREIGN KEY (id_pasillo) REFERENCES inv_pasillos(id_pasillo);

ALTER TABLE inv_almsec
ADD FOREIGN KEY (id_almacen) REFERENCES inv_almacenes(id_almacen),
ADD FOREIGN KEY (id_seccion) REFERENCES inv_secciones(id_seccion);

ALTER TABLE inv_secpas
ADD FOREIGN KEY (id_seccion) REFERENCES inv_secciones(id_seccion),
ADD FOREIGN KEY (id_pasillo) REFERENCES inv_pasillos(id_pasillo);

ALTER TABLE inv_invalm
ADD FOREIGN KEY (id_inventario) REFERENCES inv_inventarios(id_inventario),
ADD FOREIGN KEY (id_almacen) REFERENCES inv_almacenes(id_almacen);

ALTER TABLE inv_catatr
ADD FOREIGN KEY (id_categoria) REFERENCES inv_categorias(id_categoria),
ADD FOREIGN KEY (id_atributo) REFERENCES inv_atributos(id_atributo);

ALTER TABLE inv_valores
ADD FOREIGN KEY (id_producto) REFERENCES inv_productos(id_producto),
ADD FOREIGN KEY (id_atributo) REFERENCES inv_atributos(id_atributo);

ALTER TABLE inv_recepciones
ADD FOREIGN KEY (id_producto) REFERENCES inv_productos(id_producto),
ADD FOREIGN KEY (id_pasillo) REFERENCES inv_pasillos(id_pasillo),
ADD FOREIGN KEY (id_estado) REFERENCES inv_estadorecepciones(id_estado);

ALTER TABLE inv_transferencias
ADD FOREIGN KEY (id_producto) REFERENCES inv_productos(id_producto),
ADD FOREIGN KEY (id_pasillo_origen) REFERENCES inv_pasillos(id_pasillo),
ADD FOREIGN KEY (id_pasillo_destino) REFERENCES inv_pasillos(id_pasillo),
ADD FOREIGN KEY (id_estado) REFERENCES inv_estadotransferencias(id_estado);



        -- Secciones
        DELETE FROM `gen_modulos` WHERE nombre = 'Inventario';
        INSERT INTO `gen_modulos` (nombre, descripcion, orden) VALUES ('Inventario', 'Módulo de Inventario.', '2000');
        SET @id_modulo = LAST_INSERT_ID();

        DELETE FROM `gen_secciones` WHERE nombre = 'Tablero';
        INSERT INTO `gen_secciones` (nombre, descripcion, permiso, orden, id_modulo, identificador) VALUES ('Tablero', 'Tablero resumen.', '0', '1', @id_modulo, 'tablero');

        DELETE FROM `gen_secciones` WHERE nombre = 'Productos';
        INSERT INTO `gen_secciones` (nombre, descripcion, permiso, orden, id_modulo, identificador) VALUES ('Productos', 'Gestión de productos.', '0', '1', @id_modulo, 'productos');
        SET @id_sec_pro = LAST_INSERT_ID();

        DELETE FROM `gen_secciones` WHERE nombre = 'Categorías';
        INSERT INTO `gen_secciones` (nombre, descripcion, permiso, orden, id_modulo, identificador) VALUES ('Categorías', 'Gestión de categorías.', '0', '1', @id_modulo, 'categorias');
        SET @id_sec_cat = LAST_INSERT_ID();

        DELETE FROM `gen_secciones` WHERE nombre = 'Inventario';
        INSERT INTO `gen_secciones` (nombre, descripcion, permiso, orden, id_modulo, identificador) VALUES ('Inventario', 'Gestión de Inventario.', '0', '1', @id_modulo, 'list_inventario');
        SET @id_sec_inv = LAST_INSERT_ID();

        DELETE FROM `gen_secciones` WHERE nombre = 'Transferencias';
        INSERT INTO `gen_secciones` (nombre, descripcion, permiso, orden, id_modulo, identificador) VALUES ('Transferencias', 'Gestión de Transferencias.', '0', '1', @id_modulo, 'transferencias');
        SET @id_sec_tra = LAST_INSERT_ID();

        DELETE FROM `gen_secciones` WHERE nombre = 'Recepciones';
        INSERT INTO `gen_secciones` (nombre, descripcion, permiso, orden, id_modulo, identificador) VALUES ('Recepciones', 'Gestión de recepciones.', '0', '1', @id_modulo, 'recepciones');
        SET @id_sec_rec = LAST_INSERT_ID();

        DELETE FROM `gen_secciones` WHERE nombre = 'Informes';
        INSERT INTO `gen_secciones` (nombre, descripcion, permiso, orden, id_modulo, identificador) VALUES ('Informes', 'Gestión de Informes.', '0', '1',@id_modulo, 'informes');
        SET @id_sec_inf = LAST_INSERT_ID();


        -- Subsecciones
        DELETE FROM `gen_subsecciones` WHERE nombre = 'Crear Producto';
        INSERT INTO `gen_subsecciones` (nombre, descripcion, permiso, orden, id_seccion, identificador) VALUES ('Crear Producto', 'Formulario para crear un producto.', '0','1',  @id_sec_pro,'crearProducto');

        DELETE FROM `gen_subsecciones` WHERE nombre = 'Extraer Productos CSV';
        INSERT INTO `gen_subsecciones` (nombre, descripcion, permiso, orden, id_seccion, identificador) VALUES ('Extraer Productos CSV', 'Permite la descarga de un fichero CSV con todos los productos.', '0','1',  @id_sec_pro,'extraerCsv');

        DELETE FROM `gen_subsecciones` WHERE nombre = 'Crear Atributos';
        INSERT INTO `gen_subsecciones` (nombre, descripcion, permiso, orden, id_seccion, identificador) VALUES ('Crear Atributos', 'Formulario para crear atributos.', '0','1', @id_sec_cat,'crearAtributos');

        DELETE FROM `gen_subsecciones` WHERE nombre = 'Asignar Valores';
        INSERT INTO `gen_subsecciones` (nombre, descripcion, permiso, orden, id_seccion, identificador) VALUES ('Asignar Valores', 'Asigna valores a atributos de un producto.', '0','1', @id_sec_cat,'asignarValores');

        DELETE FROM `gen_subsecciones` WHERE nombre = 'Almacenes';
        INSERT INTO `gen_subsecciones` (nombre, descripcion, permiso, orden, id_seccion, identificador) VALUES ('Almacenes', 'Gestión de Almacenes.', '0', '1', @id_sec_inv, 'mostrarAlmacenes');

        DELETE FROM `gen_subsecciones` WHERE nombre = 'Secciones';
        INSERT INTO `gen_subsecciones` (nombre, descripcion, permiso, orden, id_seccion, identificador) VALUES ('Secciones', 'Gestión de Secciones.', '0', '1', @id_sec_inv, 'mostrarSecciones');

        DELETE FROM `gen_subsecciones` WHERE nombre = 'Pasillos';
        INSERT INTO `gen_subsecciones` (nombre, descripcion, permiso, orden, id_seccion, identificador) VALUES ('Pasillos', 'Gestión de Pasillos.', '0', '1', @id_sec_inv, 'mostrarPasillos');

        DELETE FROM `gen_subsecciones` WHERE nombre = 'Crear Transferencia';
        INSERT INTO `gen_subsecciones` (nombre, descripcion, permiso, orden, id_seccion, identificador) VALUES ('Crear Transferencia', 'Formulario para crear una transferencia.', '0', '1', @id_sec_tra, 'crearTransferencia');

        DELETE FROM `gen_subsecciones` WHERE nombre = 'Informe Productos';
        INSERT INTO `gen_subsecciones` (nombre, descripcion, permiso, orden, id_seccion, identificador) VALUES ('Informe Productos', 'Muestra un informe de productos', '0', '1', @id_sec_inf, 'informeProductos');


        -- Tipos producto
        INSERT INTO `inv_tipos_productos` ( `tipo`, `descripcion`) VALUES ( 'Comprable', 'Puede ser comprado a proveedores.');
        INSERT INTO `inv_tipos_productos` ( `tipo`, `descripcion`) VALUES ('Vendible' , 'El producto puede ser vendido a clientes.');
        INSERT INTO `inv_tipos_productos` ( `tipo`, `descripcion`) VALUES ( 'Comprable/Vendible', 'El producto puede ser comprado a proveedores y vendido a clientes.');
        ";
        if($datos){
            $sql.="
                
            INSERT INTO `inv_almacenes` (`id_almacen`, `nombre`, `cantProSec`) VALUES
            (1, 'Hardware', 0),
            (2, 'Software', 0);

                        INSERT INTO `inv_almsec` (`id_almsec`, `id_almacen`, `id_seccion`) VALUES
            (1, 1, 1),
            (2, 1, 2),
            (3, 1, 3),
            (4, 2, 4),
            (5, 2, 5);

            INSERT INTO `inv_atributos` (`id_atributo`, `nombre`, `descripcion`) VALUES
            (1, 'Color', '...'),
            (2, 'Tamaño', '...'),
            (3, 'Peso', '...'),
            (4, 'Altura', '....');

            INSERT INTO `inv_catatr` (`id_catatr`, `id_categoria`, `id_atributo`) VALUES
            (1, 1, 1),
            (2, 1, 2),
            (3, 2, 3),
            (4, 3, 4);

            INSERT INTO `inv_categorias` (`id_categoria`, `nombre`) VALUES
            (1, 'categoria1'),
            (2, 'Categoria2'),
            (3, 'Categoria3');

            INSERT INTO `inv_estadotransferencias` (`id_estado`, `estado`) VALUES
            (1, 'Solicitud'),
            (2, 'Preparación'),
            (3, 'Tramitado');

            INSERT INTO `inv_invalm` (`id_invalm`, `id_inventario`, `id_almacen`) VALUES
            (1, 1, 1),
            (2, 1, 2);

            INSERT INTO `inv_inventarios` (`id_inventario`, `nombre`) VALUES
            (1, 'PCGames');

            INSERT INTO `inv_pasillos` (`id_pasillo`, `nombre`, `cantPro`) VALUES
            (1, 'Pas1', 0),
            (2, 'Pas2', 0),
            (3, 'Pas3', 0),
            (4, 'Pas1', 0),
            (5, 'Pas2', 0);

            INSERT INTO `inv_productos` (`id_producto`, `nombre`, `descripcion`, `fecha_alta`, `fecha_baja`, `imagen`, `cod_barras`, `precio`, `coste`, `peso`, `volumen`, `id_categoria`, `id_tipo_producto`) VALUES
            (1, 'Windows 7', '123', '2018-03-03', '0000-00-00', '', '123', 123, 123, 123, 123, 1, 2),
            (2, 'BenQ 21.5', '123', '2018-03-03', '0000-00-00', '', '123', 123, 123, 123, 123, 2, 3);

            INSERT INTO `inv_propas` (`id_propas`, `id_producto`, `id_pasillo`, `cantidad`) VALUES
            (1, 1, 1, 5),
            (2, 2, 1, 5);

            INSERT INTO `inv_secciones` (`id_seccion`, `nombre`, `cantProPas`) VALUES
            (1, 'Pantalla', 0),
            (2, 'Teclados', 0),
            (3, 'Ratones', 0),
            (4, 'Antivirus', 0),
            (5, 'Sistema Operativo', 0);

            INSERT INTO `inv_secpas` (`id_secpas`, `id_seccion`, `id_pasillo`) VALUES
            (1, 1, 1),
            (2, 2, 2),
            (3, 3, 3),
            (4, 4, 4),
            (5, 5, 5);

            
        ";
            
        }
        $conexion = $this->conectar();
        $rs = $conexion->multi_query($sql);
        return $rs;
    }
}
