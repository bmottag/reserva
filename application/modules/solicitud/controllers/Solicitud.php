<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solicitud extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
		$this->load->model("solicitud_model");
    }
	
	public function calendario()
	{
		$this->load->model("general_model");
		$arrParam = array("estado" => 1);
		$data['information'] = $this->general_model->get_solicitudes($arrParam);//info solicitudes
		
		$data["view"] = 'calendario';
		$this->load->view("layout", $data);
	}

	/**
	* Muestra form para seleccionar fecha
	* @since 30/3/2018
	* @author BMOTTAG
	*/	
	public function index()
	{
			$this->form_validation->set_rules('hddFecha', '"Fecha de solicitud"', 'required');
			if ($this->form_validation->run() === FALSE)
			{
				$arrParam = array();
				$data['view'] = 'fecha_reserva';
			} 
			else
			{				
				$data['fecha_apartada'] = $this->input->post('hddFecha');
				
				$this->load->model("general_model");

				$rol = $this->session->userdata("rol");//consulto rol para mostrar la lista de tipificacion
				
				$data['dataMensajeAlerta'] = FALSE;
				if($rol == 3){
					$usuario = "GESTOR";
					
					//revisar para rol GESTOR si es sabado o domingo la fecha de reserva	
					// si es domingo $dia tendra 0, si es sabado dia es 6			
					$dia=date("w", strtotime($data['fecha_apartada']));
					if($dia == 0 || $dia == 6){
						$data['dataMensajeAlerta'] = "Usted no tiene permisos para realizar reservas para los fines de semana.";
					}			
					
				}else{
					$usuario = "ADMON";
				}
				
				$arrParam = array("usuario" => $usuario);
				$data['tipificacion'] = $this->general_model->get_tipificacion($arrParam);
				
				//verifico el rol del usuario si es GESTOR solo se muestran las horas permitidas que estan configuradas
				//en la tabla de param_generales (hora inicio y hora fin)
				$arrParamFiltro = array();
				
				//BUSCO HORA INICIO Y HORA FINAL PARA USUARIO GESTOR y numero maximo de computadores
				$arrParamGeneral = array(
					"table" => "param_generales",
					"order" => "id_generales",
					"id" => "x"
				);
				$data['filtro'] = $this->general_model->get_basic_search($arrParamGeneral);
				
				if($rol == 3){
								
					$arrParamFiltro = array(
						"idHoraInicio" => $data['filtro'][0]['valor'],
						"idHoraFinal" => $data['filtro'][1]['valor']
					);
				}
				$data['horas'] = $this->general_model->get_horas($arrParamFiltro);//LISTA DE HORAS
				
				$data['examenes'] = $this->general_model->get_examenes();//listado de examenes
				
				//filtro de solicitudes por fecha
				$arrParam = array(
								"fecha" => $data['fecha_apartada'], 
								"estado" => 1
							);
				$data['solicitudes'] = $this->general_model->get_solicitudes($arrParam);//listado de solicitudes filtrado por fecha
				$data['information'] = FALSE;

				$data['view'] = 'form_solicitud';
			}			
			$this->load->view("layout",$data);
	}
	
	/**
	 * Save solicitud
     * @since 1/4/2018
	 */
	public function save_solicitud()
	{			
		header('Content-Type: application/json');
		$data = array();
		
		$this->load->model("general_model");
		$data["idRecord"] = $this->session->userdata("id");
		$bandera = FALSE;
		$bandera2 = FALSE;
		//DATOS DEL POST
		$idSolicitud = $this->input->post('hddIdInspeccion');
		$fechaReserva = $this->input->post('hddFecha');
		$numero_computadores = intval($this->input->post('numero_computadores'));
		$hora_inicio = intval($this->input->post('hora_inicio'));
		$hora_fin = intval($this->input->post('hora_final'));
		$no_items = $this->input->post('numero_items');
		$prueba = $this->input->post('prueba');
		$grupo_items = $this->input->post('grupo_items');
		$tipificacion = $this->input->post('tipificacion');
		$estado_historica = 1; //para estado NUEVA en el historico
		
		$numero_computadores_anterior = 0; //lo uso para la validacion que no se pase del numero maximo de computadores
		
		//revisar si es para editar, en ese caso verificar que sean datos diferentes
		if ($idSolicitud != '') 
		{
			$estado_historica = 3; //para estado MODIFICADA en el historico
			
			//busco informacion de la solicitud en la base de datos
			$arrParam = array("idSolicitud" => $idSolicitud);
			$information = $this->general_model->get_solicitudes($arrParam);
			
			$numero_computadores_anterior = intval($information[0]['numero_computadores']);

			//comparo valores uno a uno si hay cambios
			if($numero_computadores == $information[0]['numero_computadores'] && $hora_inicio == $information[0]['fk_id_hora_inicial'] && $hora_fin == $information[0]['fk_id_hora_final'] && $no_items == $information[0]['numero_items'] && $prueba == $information[0]['fk_codigo_examen'] && $grupo_items == $information[0]['fk_id_prueba'] && $tipificacion == $information[0]['fk_id_tipificacion'])
			{
				$bandera2 = TRUE;
			}
		}

		//filtro de solicitudes por fecha
		$arrParam = array(
						"fecha" => $fechaReserva, 
						"estado" => 1
					);
		$listadoSolicitudes = $this->general_model->get_solicitudes($arrParam);//listado de solicitudes filtrado por fecha
		
		//recorro las reservas
		if($listadoSolicitudes && !$bandera2){
			
			//BUSCO numero maximo de computadores
			$arrParamGeneral = array(
				"table" => "param_generales",
				"order" => "id_generales",
				"id" => "x"
			);
			$paramGenerales = $this->general_model->get_basic_search($arrParamGeneral);
						
			$numeroMaxComputadores = $paramGenerales[2]['valor'];
						
			$contadorDisponibleIgual = intval($numeroMaxComputadores);
			$contadorDisponibleEntre = intval($numeroMaxComputadores);
			$contadorDisponibleAntes = intval($numeroMaxComputadores);
			$contadorDisponibleDespues = intval($numeroMaxComputadores);
			
			$contadorDisponibleBDEntre = intval($numeroMaxComputadores);
			$contadorDisponibleBDAntes = intval($numeroMaxComputadores);
			$contadorDisponibleBDDespues = intval($numeroMaxComputadores);
			
			foreach ($listadoSolicitudes as $list):
				$hora_inicio_BD = $list['fk_id_hora_inicial'];
				$hora_fin_BD = $list['fk_id_hora_final'];
				$numero_computadores_BD = $list['numero_computadores'];
								
//1 --- revisar horas cuando son iguales
				if( $hora_inicio_BD == $hora_inicio && $hora_fin_BD == $hora_fin )
				{
					//consulto numero de computadores disponibles
					$contadorDisponibleIgual = $contadorDisponibleIgual - $numero_computadores_BD + $numero_computadores_anterior; 
					if($numero_computadores > $contadorDisponibleIgual){
						//error no hay computadores para apartar
						$bandera = TRUE;
					}
//2 --- revisar horas cuando hora estan dentro del rango de la base de datos	
				}elseif( $hora_inicio >= $hora_inicio_BD && $hora_inicio < $hora_fin_BD && $hora_fin <= $hora_fin_BD && $hora_fin > $hora_inicio_BD )
				{
					//consulto numero de computadores disponibles
					$contadorDisponibleEntre = $contadorDisponibleEntre - $numero_computadores_BD + $numero_computadores_anterior; 
					if($numero_computadores > $contadorDisponibleEntre){
						//error no hay computadores para apartar
						$bandera = TRUE;
					}
//3 --- revisar horas cuando hora empieza antes y terminan dentro o igual a la hora final
				}elseif( $hora_inicio_BD > $hora_inicio && $hora_fin <= $hora_fin_BD && $hora_fin > $hora_inicio_BD )
				{
					//consulto numero de computadores disponibles
					$contadorDisponibleAntes = $contadorDisponibleAntes - $numero_computadores_BD + $numero_computadores_anterior; 
					if($numero_computadores > $contadorDisponibleAntes){
						//error no hay computadores para apartar
						$bandera = TRUE;
					}					
//4 --- revisar horas cuando hora final despues y comienzan dentro o igual a la hora final
				}elseif( $hora_inicio >= $hora_inicio_BD && $hora_fin <= $hora_fin_BD  )
				{
					//consulto numero de computadores disponibles
					$contadorDisponibleDespues = $contadorDisponibleDespues - $numero_computadores_BD + $numero_computadores_anterior; 
					if($numero_computadores > $contadorDisponibleDespues){
						//error no hay computadores para apartar
						$bandera = TRUE;
					}					
//5 --- revisar horas cuando hora BD estan dentro del rango de la base de datos	
				}elseif( $hora_inicio_BD >= $hora_inicio && $hora_inicio_BD < $hora_fin && $hora_fin_BD <= $hora_fin && $hora_fin_BD > $hora_inicio )
				{
					//consulto numero de computadores disponibles
					$contadorDisponibleBDEntre = $contadorDisponibleBDEntre - $numero_computadores_BD + $numero_computadores_anterior; 
					if($numero_computadores > $contadorDisponibleBDEntre){
						//error no hay computadores para apartar
						$bandera = TRUE;
					}
//6 --- revisar horas cuando hora BD empieza antes y terminan dentro o igual a la hora final
				}elseif( $hora_inicio > $hora_inicio_BD && $hora_fin_BD <= $hora_fin && $hora_inicio < $hora_fin_BD )
				{
					//consulto numero de computadores disponibles
					$contadorDisponibleBDAntes = $contadorDisponibleBDAntes - $numero_computadores_BD + $numero_computadores_anterior; 
					if($numero_computadores > $contadorDisponibleBDAntes){
						//error no hay computadores para apartar
						$bandera = TRUE;
					}					
//7 --- revisar horas cuando hora final BD despues y comienzan dentro o igual a la hora final
				}elseif( $hora_inicio_BD >= $hora_inicio && $hora_fin_BD <= $hora_fin )
				{
					//consulto numero de computadores disponibles
					$contadorDisponibleBDDespues = $contadorDisponibleBDDespues - $numero_computadores_BD + $numero_computadores_anterior; 
					if($numero_computadores > $contadorDisponibleBDDespues){
						//error no hay computadores para apartar
						$bandera = TRUE;
					}					
				}
			endforeach;
		}
		
		if( $bandera || $bandera2 ){
			$data["result"] = "error";
			if($bandera){
				$data["mensaje"] = " La cantidad de equipos no esta disponible para la fecha y hora seleccionada.";
			}elseif($bandera2){
				$data["mensaje"] = " No se hicieron modificaciones.";
			}
		}else{
		
			if ($idSolicitud = $this->solicitud_model->saveSolicitud()) 
			{
				$this->solicitud_model->saveHistorico($idSolicitud, $estado_historica ); //Guardo el historico
				$data["result"] = true;
				$data["mensaje"] = "Se guardó la información con éxito.";
				$data["idSolicitud"] = $idSolicitud;
				$this->session->set_flashdata('retornoExito', 'Se guardó la información con éxito!!');
			} else {
				$data["result"] = "error";
				$data["mensaje"] = "Error!!! Ask for help.";
				$data["idSolicitud"] = "";
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
			}
		}
		
		echo json_encode($data);
    }
	
	/**
	 * Listado de solicitudes para un usuario
     * @since 1/4/2018
     * @author BMOTTAG
	 */
	public function solicitudes_usuario($idUser, $idSolicitud = 'x')
	{			
		$this->load->model("general_model");
		$data['information'] = FALSE;
		$data['informationHistorico'] = FALSE;
		
		//$arrParam = array("idUser" => $idUser);
		//$data['userInfo'] = $this->general_model->get_user_list($arrParam);//info cliente
				
		$arrParam = array();
		//consulto rol para filtrar por estados y por usuario
		$rol = $this->session->userdata("rol");
		if($rol == 3){
			$arrParam = array(
							"idUser" => $idUser,
							"estado" => 1
						);
		}
		$data['information'] = $this->general_model->get_solicitudes($arrParam);//info solicitudes
		
		//si envio el id, entonces busco la informacion 
		if ($idSolicitud != 'x') {
			$arrParam = array("idSolicitud" => $idSolicitud);
			$data['information'] = $this->general_model->get_solicitudes($arrParam);//info inspecciones
			
			//busco el historial
			$arrParam = array("idSolicitud" => $idSolicitud);
			$data['informationHistorico'] = $this->general_model->get_solicitudes_historico($arrParam);//info inspecciones
		}

		$data["view"] = 'solicitudes_usuario';
		$this->load->view("layout", $data);
	}
	
	/**
	 * Eliminar reserva
     * @since 16/4/2018
	 */
	public function eliminar_reserva()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$data["idRecord"] = $this->session->userdata("id");
			$idSolicitud = $this->input->post('identificador');
			
			if ($this->solicitud_model->eliminarRecord()) 
			{
				$this->load->model("general_model");
				//busco informacion de la solicitud en la base de datos
				$arrParam = array("idSolicitud" => $idSolicitud);
				$information = $this->general_model->get_solicitudes($arrParam);
				
				$estado_historica = 2; //para estado ELIMINADA en el historico
				$this->solicitud_model->saveHistorico_eliminar($information, $estado_historica); //Guardo el historico
				$data["result"] = true;
				$this->session->set_flashdata('retornoExito', 'Se eliminó el registro.');
			} else {
				$data["result"] = "error";
				$data["mensaje"] = "Error!!! Contactarse con el Administrador.";
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el Administrador.');
			}				

			echo json_encode($data);
    }
	
	/**
	 * Lista de pruebas pr examen
     * @since 16/4/2018
	 */
    public function pruebaList()
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos

			$arrParam['codigoExamen'] = $this->input->post('identificador');
			$this->load->model("general_model");
			$lista = $this->general_model->get_pruebas_by($arrParam);
		
			echo "<option value=''>Select...</option>";
			if ($lista) {
				foreach ($lista as $fila) {
					echo "<option value='" . $fila["idPrueba"] . "' >" . $fila["prueba"] . "</option>";
				}
			}
    }
	
	/**
	 * Form to update
     * @since 22/4/2018
     * @author BMOTTAG
	 */
	public function update_solicitud($idSolicitud = 'x')
	{			
			$this->load->model("general_model");
			
			//busco informacion de la solicitud
			$arrParam = array("idSolicitud" => $idSolicitud);
			$data['information'] = $this->general_model->get_solicitudes($arrParam);
			
			$data['fecha_apartada'] = $data['information'][0]["fecha_apartado"];
			
			$rol = $this->session->userdata("rol");//consulto rol para mostrar la lista de tipificacion
					
			$data['dataMensajeAlerta'] = FALSE;
			if($rol == 3){
				$usuario = "GESTOR";
				
				//revisar para rol GESTOR si es sabado o domingo la fecha de reserva	
				// si es domingo $dia tendra 0, si es sabado dia es 6			
				$dia=date("w", strtotime($data['fecha_apartada']));
				if($dia == 0 || $dia == 6){
					$data['dataMensajeAlerta'] = "Usted no tiene permisos para realizar reservas para los fines de semana.";
				}			
				
			}else{
				$usuario = "ADMON";
			}
			
			$arrParam = array("usuario" => $usuario);
			$data['tipificacion'] = $this->general_model->get_tipificacion($arrParam);
			
			//verifico el rol del usuario si es GESTOR solo se muestran las horas permitidas que estan configuradas
			//en la tabla de param_generales (hora inicio y hora fin)
			$arrParamFiltro = array();
			
			//BUSCO HORA INICIO Y HORA FINAL PARA USUARIO GESTOR y numero maximo de computadores
			$arrParamGeneral = array(
				"table" => "param_generales",
				"order" => "id_generales",
				"id" => "x"
			);
			$data['filtro'] = $this->general_model->get_basic_search($arrParamGeneral);
			
			if($rol == 3){
							
				$arrParamFiltro = array(
					"idHoraInicio" => $data['filtro'][0]['valor'],
					"idHoraFinal" => $data['filtro'][1]['valor']
				);
			}
			$data['horas'] = $this->general_model->get_horas($arrParamFiltro);//LISTA DE HORAS
			
			$data['examenes'] = $this->general_model->get_examenes();//listado de examenes
			
			//filtro de solicitudes por fecha
			$arrParam = array(
							"fecha" => $data['fecha_apartada'], 
							"estado" => 1
						);
			$data['solicitudes'] = $this->general_model->get_solicitudes($arrParam);//listado de solicitudes filtrado por fecha

			$data["view"] = 'form_solicitud';
			$this->load->view("layout", $data);
	}
	
	
	
}