<?php

/**
 * Clase para manejar el módulo Ayuda.
 * Hereda de la clase Herramientas.
 * 
 * @author   Juan Carlos Gómez Vicente <gvjc@iesseveroochoa.net>
 * @license  Generic Public License
 *
 * ***************************************************************
 * * LISTADO DE PROCEDIMIENTOS DE LA CLASE                       *
 * ***************************************************************
 * obtenerTablas()                  Muestra las tablas de la base de datos [vacío]
 * 
 * 
 */

class Ayuda extends Herramientas{
    
    function __construct() {
        
    }
    
    function obtenerTablas() {
        try {
            $conexion = $this->conectar();
            $rs = $conexion->query("SHOW TABLES;");
            $html = "<div id='ayuda'><h3>Listado de tablas de la aplicación.</h3>";
            while ($fila = $rs->fetch_array()){
                $html .= "<p class='gen_tabla'>".$fila["Tables_in_sge_proyecto"]."</p>";
            }
            $html .= "</div>";
            echo $html;

        } catch(Exception $e) {
            echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
        }
    }    
} # Fin de la clase