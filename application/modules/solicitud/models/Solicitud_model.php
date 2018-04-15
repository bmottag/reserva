<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Solicitud_model extends CI_Model {

		
		/**
		 * Lista de computadores
		 * @author BMOTTAG
		 * @since 23/3/2018
		 */	
		public function get_computadores($arrDatos)
		{			
			if (array_key_exists("idComputador", $arrDatos)) {
				$this->db->where('id_computador', $arrDatos["idComputador"]);
			}
			
			if (array_key_exists("estado", $arrDatos)) {
				$this->db->where('estado', $arrDatos["estado"]);
			}
			
			$this->db->order_by("computador_nombre", "asc"); 
			$query = $this->db->get('computadores');

			if ($query->num_rows() > 0) {
				return $query->result_array();
			} else {
				return false;
			}
		}
		
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
				'grupo_items' => $this->input->post('grupo_items'),
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