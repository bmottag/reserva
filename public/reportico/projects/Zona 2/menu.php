<?php
$menu_title = SW_PROJECT_TITLE;
$menu = array (
	array ( "language" => "es_es", "report" => ".*\.xml", "title" => "<AUTO>" )
	);
?>
<?php
$menu_title = SW_PROJECT_TITLE;
$menu = array (
	array ( "report" => "<p>En el menú superior encuentra los reportes que se pueden generar para verlos en pantalla, descargarlos a PDF, o CSV.</p><p><a style=\"text-decoration: underline !important\"  target=\"_self\" href=\"http://operativoicfes.com/zona2/solicitud/calendario\">Regresar</a></p>", "title" => "TEXT" ),
	);

$admin_menu = $menu;


$dropdown_menu = array(
                    array ( 
                        "project" => "Zona 2",
                        "title" => "Zona 2",
                        "items" => array (
							array ( "reportfile" => "Reservas.xml" )
                            )
                        ),
                );
?>