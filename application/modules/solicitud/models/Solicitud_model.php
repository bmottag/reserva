<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Solicitud_model extends CI_Model {

		
		/**
		 * Add/Edit Solicitud
		 * @since 1/4/2018
		 */
		public function saveSolicitud() 
		{
			$idUser = $this->session->userdata("id");
			$idSolicitud = $this->input->post('hddIdInspeccion');
		
			$data = array(
				'fecha_apartado' => $this->input->post('hddFecha'),
				'numero_computadores' => $this->input->post('numero_computadores'),
				'fk_id_hora_inicial' => $this->input->post('hora_inicio'),
				'fk_id_hora_final' => $this->input->post('hora_final'),
				'numero_items' => $this->input->post('numero_items'),
				'fk_id_prueba' => $this->input->post('grupo_items'),
				'cual' => $this->input->post('cual'),
				'fk_id_tipificacion' => $this->input->post('tipificacion'),
				'estado_solicitud' => 1
			);
			
			//revisar si es para adicionar o editar
			if ($idSolicitud == '') {
				$data['fk_id_user'] = $idUser;
				$data['fecha_solicitud'] = date("Y-m-d G:i:s");			

				$query = $this->db->insert('solicitud', $data);	
				$idSolicitud = $this->db->insert_id();				
			} else {				
				$this->db->where('id_solicitud', $idSolicitud);
				$query = $this->db->update('solicitud', $data);
			}
			
			if ($query) {
				return $idSolicitud;
			} else {
				return false;
			}
		}
				
	    
	}