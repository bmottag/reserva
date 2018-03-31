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
			$this->form_validation->set_rules('fecha', '"Fecha de solicitud"', 'required');
			if ($this->form_validation->run() === FALSE)
			{
				$arrParam = array();
				$data['computadores'] = $this->solicitud_model->get_computadores($arrParam);
				$data['view'] = 'computadores';
			} 
			else
			{
				$salaId = $this->input->post('salaId');
				$fecha = $this->input->post('fecha');
				
				$data['solicitudes'] = $this->consultas_salas_model->get_solicitudes($salaId,$fecha);
				$data['solicitud'] = $this->consultas_salas_model->get_solbyID();

				$data["fullName"] = $this->session->userdata("nom_usuario") . ' ' . $this->session->userdata("ape_usuario");
				$data['view'] = 'form_solicitud';
			}			
			$this->load->view("layout",$data);
	}
	
	
}