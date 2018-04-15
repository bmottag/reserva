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
	* Muestra lista de computadores
	* @since 30/3/2018
	* @author BMOTTAG
	*/	
	public function index()
	{
			$this->form_validation->set_rules('hddFecha', '"Fecha de solicitud"', 'required');
			if ($this->form_validation->run() === FALSE)
			{
				$arrParam = array();
				$data['computadores'] = $this->solicitud_model->get_computadores($arrParam);
				$data['view'] = 'computadores';
			} 
			else
			{				
				$data['idComputador'] = $this->input->post('hddIdComputador');
				
				$this->load->model("general_model");
				//LISTA DE TIPIFICACION
				$arrParam = array(
					"table" => "param_tipificacion",
					"order" => "tipificacion",
					"id" => "x"
				);
				$data['tipificacion'] = $this->general_model->get_basic_search($arrParam);
				
				//filtro de solicitudes por computador y fecha
				$arrParam = array(
					"idComputador" => $this->input->post('hddIdComputador'),
					"fecha" => $this->input->post('hddFecha')
				);
				$data['solicitudes'] = $this->general_model->get_solicitudes($arrParam);//listado de solicitudes filtrado por computador y fecha
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
			
			$data["idRecord"] = $this->session->userdata("id");

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
		
		$arrParam = array(
						"idUser" => $idUser,
						"tipoInspeccion" => 1
					);
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