<?php
session_start();
require_once "funciones.php";

if(isset($_SESSION['id_usuario'])){
$empleado = obtener_empleados_ids([$_SESSION['id_usuario']])[0];
$nombre = $empleado->nombre." ".$empleado->apellidos;
$fecha = $empleado->fecha_inc;
$imagen = $empleado->foto;

if($imagen == null){
    $imagen = "https://png.icons8.com/metro/1600/gender-neutral-user.png";
}

?>
<link rel="stylesheet" type="text/css" href="modulos/proyectos/Datatables/css/jquery.dataTables.css">
<script type="text/javascript" language="javascript" src="modulos/proyectos/Datatables/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="modulos/proyectos/Datatables/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" >
    $(document).ready(function() {
        var dataTable = $('#tableroPrincipal').DataTable( {
            "order": [[ 0, "desc" ]],
            "language": {
                url :"modulos/proyectos/Datatables/esp.json"
            },
            "bFilter": false,
            "processing": true,
            "serverSide": true,
            "ajax":{
                url :"modulos/proyectos/includes/tablonProyectos_tableroPrincipal.php", // json datasource
                type: "post",  // method  , by default get
                error: function(){  // error handling
                    /*$(".tableroPrincipal-error").html("");
                    $("#tableroPrincipal").append('<tbody class="tablon-error"><tr><th class="col-6" style="padding: 0" colspan="2">No se han encontrado registros.</th></tr></tbody>');*/
                    $("#tableroPrincipal_processing").css("display","none");
                }
            }
        } );
    } );
</script>
<div id="moduloproyectos">
    <div class="contenedor">
        <div class="fila">
            <div class="col-1">
                <div class="col-2 en-medio" style="width: 100%;height: 100%">

                    <img src="<?=$imagen?>" style="max-height: 75px;border: 1px solid black">
                </div>
            </div>
            <div class="col-5">
                <div class="col-6 upper_case" style="margin-left: 5px;margin-bottom: 5px;float:left;">
                   <p><?=$nombre?></p>
                </div>
                <div class="col-6 upper_case" style="margin-left: 5px;margin-bottom: 5px;float: left">Fecha de Ingreso: <?=$fecha?></div>
            </div>
        </div>
        <hr class="hr">
        <div class="fila">
            <div class="col-6">
                <table id="tableroPrincipal" class="display col-6">
                    <thead>
                    <tr>
                        <th style="padding: 0">Fecha</th>
                        <th style="padding: 0">Contenido</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
}else{
    $arrayEmpleados = obtener_empleados();
    ?>
    <div id="moduloproyectos">
        <label for="selectEmpleado">Seleccione un  empleado : </label>
        <select id="selectEmpleado">
            <?php
            for ($i=0;$i<count($arrayEmpleados);$i++){
                $idE = $arrayEmpleados[$i]->id_empleado;
                $nomE = $arrayEmpleados[$i]->nombre;
                ?>
                <option id="<?=$idE?>"><?=$nomE?></option>
                <?php
            }
            ?>
        </select>
        <button id="seleccionarEmpleado"> Seleccionar </button>
    </div>
    <script>
        let nid=1;
        $("#selectEmpleado").change(function() {
            nid = $(this).children(":selected").attr("id");
        });
        $('#seleccionarEmpleado').click(function () {
            //alert(nid);
            //$('#proyectos').trigger('click');
            $.ajax({
                url: './modulos/proyectos/includes/backend_seleccionarUsuario.php',
                type: 'POST',
                data: {id: nid},
                error: function () {
                    alert("Ha habido un error.");
                },
                success: function (result) {
                    //alert(result);
                    $('#tablonProyectos').trigger('click');
                }
            });// Fin ajax
            }
        )
    </script>
    <?php
}