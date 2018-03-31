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
				
	    
	}