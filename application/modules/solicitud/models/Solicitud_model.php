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
				'fk_codigo_examen' => $this->input->post('prueba'),
				'fk_id_prueba' => $this->input->post('grupo_items'),
				'cual_prueba' => $this->input->post('cual_prueba'),
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
		
		/**
		 * Add HISTORICO
		 * @since 31/5/2018
		 */
		public function saveHistorico($idSolicitud ) 
		{
			$idUser = $this->session->userdata("id");
		
			$data = array(
				'fecha_apartado' => $this->input->post('hddFecha'),
				'numero_computadores' => $this->input->post('numero_computadores'),
				'fk_id_hora_inicial' => $this->input->post('hora_inicio'),
				'fk_id_hora_final' => $this->input->post('hora_final'),
				'numero_items' => $this->input->post('numero_items'),
				'fk_codigo_examen' => $this->input->post('prueba'),
				'fk_id_prueba' => $this->input->post('grupo_items'),
				'cual_prueba' => $this->input->post('cual_prueba'),
				'cual' => $this->input->post('cual'),
				'fk_id_tipificacion' => $this->input->post('tipificacion'),
				'estado_solicitud' => 1,
				'fk_id_user' => $idUser,
				'fecha_solicitud' => date("Y-m-d G:i:s"),
				'fk_id_solicitud' => $idSolicitud
			);
						
			$query = $this->db->insert('log_solicitud', $data);
			
			if ($query) {
				return true;
			} else {
				return false;
			}
		}
		
		/**
		 * Add HISTORICO de una eliminacion
		 * @since 1/6/2018
		 */
		public function saveHistorico_eliminar($datosBD) 
		{
			$idUser = $this->session->userdata("id");
			$idSolicitud = $this->input->post('identificador');
		
			$data = array(
				'fecha_apartado' => $datosBD[0]['fecha_apartado'],
				'numero_computadores' => $datosBD[0]['numero_computadores'],
				'fk_id_hora_inicial' => $datosBD[0]['fk_id_hora_inicial'],
				'fk_id_hora_final' => $datosBD[0]['fk_id_hora_final'],
				'numero_items' => $datosBD[0]['numero_items'],
				'fk_codigo_examen' => $datosBD[0]['fk_codigo_examen'],
				'fk_id_prueba' => $datosBD[0]['fk_id_prueba'],
				'cual_prueba' => $datosBD[0]['cual_prueba'],
				'cual' => $datosBD[0]['cual'],
				'fk_id_tipificacion' => $datosBD[0]['fk_id_tipificacion'],
				'estado_solicitud' => 2,
				'fk_id_user' => $idUser,
				'fecha_solicitud' => date("Y-m-d G:i:s"),
				'fk_id_solicitud' => $idSolicitud
			);
						
			$query = $this->db->insert('log_solicitud', $data);
			
			if ($query) {
				return true;
			} else {
				return false;
			}
		}
		
		/**
		 * Eliminar registro
		 * @since 1/6/2018
		 */
		public function eliminarRecord() 
		{
			$idSolicitud = $this->input->post('identificador');
		
			$data = array(
				'estado_solicitud' => 2
			);
			
			$this->db->where('id_solicitud', $idSolicitud);
			$query = $this->db->update('solicitud', $data);
						
			if ($query) {
				return true;
			} else {
				return false;
			}
		}
		
				
	    
	}