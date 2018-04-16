<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solicitud extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
		$this->load->model("solicitud_model");
    }
	
	public function calendario()
	{			
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
				$this->load->model("general_model");
				//LISTA DE TIPIFICACION
				$arrParam = array(
					"table" => "param_tipificacion",
					"order" => "tipificacion",
					"id" => "x"
				);
				$data['tipificacion'] = $this->general_model->get_basic_search($arrParam);
				
				//LISTA DE HORAS
				$arrParam = array(
					"table" => "param_horas",
					"order" => "id_hora",
					"id" => "x"
				);
				$data['horas'] = $this->general_model->get_basic_search($arrParam);
				
				//filtro de solicitudes por fecha
				$arrParam = array("fecha" => $this->input->post('hddFecha'));
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
		$fechaReserva = $this->input->post('hddFecha');
		$numero_computadores = intval($this->input->post('numero_computadores'));
		$hora_inicio = intval($this->input->post('hora_inicio'));
		$hora_fin = intval($this->input->post('hora_final'));
		$bandera = FALSE;
				
		//filtro de solicitudes por fecha
		$arrParam = array("fecha" => $fechaReserva);
		$listadoSolicitudes = $this->general_model->get_solicitudes($arrParam);//listado de solicitudes filtrado por fecha
		
		//recorro las reservas
		if($listadoSolicitudes){
			
			$contadorDisponibleIgual = intval(10);
			$contadorDisponibleEntre = intval(10);
			$contadorDisponibleAntes = intval(10);
			$contadorDisponibleDespues = intval(10);
			
			$contadorDisponibleBDEntre = intval(10);
			$contadorDisponibleBDAntes = intval(10);
			$contadorDisponibleBDDespues = intval(10);
			
			foreach ($listadoSolicitudes as $list):
				$hora_inicio_BD = $list['fk_id_hora_inicial'];
				$hora_fin_BD = $list['fk_id_hora_final'];
				$numero_computadores_BD = $list['numero_computadores'];
								
//1 --- revisar horas cuando son iguales
				if( $hora_inicio_BD == $hora_inicio && $hora_fin_BD == $hora_fin )
				{
					//consulto numero de computadores disponibles
					$contadorDisponibleIgual = $contadorDisponibleIgual - $numero_computadores_BD; 
					if($numero_computadores > $contadorDisponibleIgual){
						//error no hay computadores para apartar
						$bandera = TRUE;
					}
//2 --- revisar horas cuando hora estan dentro del rango de la base de datos	
				}elseif( $hora_inicio >= $hora_inicio_BD && $hora_inicio < $hora_fin_BD && $hora_fin <= $hora_fin_BD && $hora_fin > $hora_inicio_BD )
				{
					//consulto numero de computadores disponibles
					$contadorDisponibleEntre = $contadorDisponibleEntre - $numero_computadores_BD; 
					if($numero_computadores > $contadorDisponibleEntre){
						//error no hay computadores para apartar
						$bandera = TRUE;
					}
//3 --- revisar horas cuando hora empieza antes y terminan dentro o igual a la hora final
				}elseif( $hora_inicio_BD > $hora_inicio && $hora_fin <= $hora_fin_BD && $hora_fin > $hora_inicio_BD )
				{
					//consulto numero de computadores disponibles
					$contadorDisponibleAntes = $contadorDisponibleAntes - $numero_computadores_BD; 
					if($numero_computadores > $contadorDisponibleAntes){
						//error no hay computadores para apartar
						$bandera = TRUE;
					}					
//4 --- revisar horas cuando hora final despues y comienzan dentro o igual a la hora final
				}elseif( $hora_inicio >= $hora_inicio_BD && $hora_fin <= $hora_fin_BD  )
				{
					//consulto numero de computadores disponibles
					$contadorDisponibleDespues = $contadorDisponibleDespues - $numero_computadores_BD; 
					if($numero_computadores > $contadorDisponibleDespues){
						//error no hay computadores para apartar
						$bandera = TRUE;
					}					
//5 --- revisar horas cuando hora BD estan dentro del rango de la base de datos	
				}elseif( $hora_inicio_BD >= $hora_inicio && $hora_inicio_BD < $hora_fin && $hora_fin_BD <= $hora_fin && $hora_fin_BD > $hora_inicio )
				{
					//consulto numero de computadores disponibles
					$contadorDisponibleBDEntre = $contadorDisponibleBDEntre - $numero_computadores_BD; 
					if($numero_computadores > $contadorDisponibleBDEntre){
						//error no hay computadores para apartar
						$bandera = TRUE;
					}
//6 --- revisar horas cuando hora BD empieza antes y terminan dentro o igual a la hora final
				}elseif( $hora_inicio > $hora_inicio_BD && $hora_fin_BD <= $hora_fin && $hora_inicio < $hora_fin_BD )
				{
					//consulto numero de computadores disponibles
					$contadorDisponibleBDAntes = $contadorDisponibleBDAntes - $numero_computadores_BD; 
					if($numero_computadores > $contadorDisponibleBDAntes){
						//error no hay computadores para apartar
						$bandera = TRUE;
					}					
//7 --- revisar horas cuando hora final BD despues y comienzan dentro o igual a la hora final
				}elseif( $hora_inicio_BD >= $hora_inicio && $hora_fin_BD <= $hora_fin )
				{
					//consulto numero de computadores disponibles
					$contadorDisponibleBDDespues = $contadorDisponibleBDDespues - $numero_computadores_BD; 
					if($numero_computadores > $contadorDisponibleBDDespues){
						//error no hay computadores para apartar
						$bandera = TRUE;
					}					
				}
			endforeach;
		}
		
		if( $bandera ){
			$data["result"] = "error";
			$data["mensaje"] = " La cantidad de equipos no esta disponible para la fecha y hora seleccionada.";
		}else{
		
			if ($idSolicitud = $this->solicitud_model->saveSolicitud()) 
			{
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
		
		$arrParam = array("idUser" => $idUser);
		$data['userInfo'] = $this->general_model->get_user_list($arrParam);//info cliente
		
		$arrParam = array("idUser" => $idUser);
		$data['information'] = $this->general_model->get_solicitudes($arrParam);//info solicitudes
		
		//si envio el id, entonces busco la informacion 
		if ($idSolicitud != 'x') {
			$arrParam = array("idSolicitud" => $idSolicitud);
			$data['information'] = $this->general_model->get_solicitudes($arrParam);//info inspecciones
		}

		$data["view"] = 'solicitudes_usuario';
		$this->load->view("layout", $data);
	}
	
	
	
}