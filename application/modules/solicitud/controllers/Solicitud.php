<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solicitud extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
		$this->load->model("solicitud_model");
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
	
	
}