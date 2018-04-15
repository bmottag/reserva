<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Clase para consultas generales a una tabla
 */
class General_model extends CI_Model {

		/**
		 * Consulta BASICA A UNA TABLA
		 * @param $TABLA: nombre de la tabla
		 * @param $ORDEN: orden por el que se quiere organizar los datos
		 * @param $COLUMNA: nombre de la columna en la tabla para realizar un filtro (NO ES OBLIGATORIO)
		 * @param $VALOR: valor de la columna para realizar un filtro (NO ES OBLIGATORIO)
		 * @since 8/11/2016
		 */
		public function get_basic_search($arrData) {
			if ($arrData["id"] != 'x')
				$this->db->where($arrData["column"], $arrData["id"]);
			$this->db->order_by($arrData["order"], "ASC");
			$query = $this->db->get($arrData["table"]);

			if ($query->num_rows() >= 1) {
				return $query->result_array();
			} else
				return false;
		}
		
		/**
		 * Update field in a table
		 * @since 25/5/2017
		 */
		public function updateRecord($arrDatos) {
				$data = array(
					$arrDatos ["column"] => $arrDatos ["value"]
				);
				$this->db->where($arrDatos ["primaryKey"], $arrDatos ["id"]);
				$query = $this->db->update($arrDatos ["table"], $data);
				if ($query) {
					return true;
				} else {
					return false;
				}
		}
		
		/**
		 * Delete Record
		 * @since 25/5/2017
		 */
		public function deleteRecord($arrDatos) 
		{
				$query = $this->db->delete($arrDatos ["table"], array($arrDatos ["primaryKey"] => $arrDatos ["id"]));
				if ($query) {
					return true;
				} else {
					return false;
				}
		}
		
		/**
		 * Active User list
		 * @since 25/3/2018
		 */
		public function get_user_list($arrData) 
		{
			if (array_key_exists("idUser", $arrData)) {
				$this->db->where('U.id_user', $arrData["idUser"]);
			}
			if (array_key_exists("idRol", $arrData)) {
				$this->db->where('U.fk_id_rol', $arrData["idRol"]);
			}
			if (array_key_exists("state", $arrData)) {
				$this->db->where('U.state', $arrData["state"]);
			}
			$this->db->join('param_rol R', 'R.id_rol = U.fk_id_rol', 'INNER');
			$this->db->order_by("U.first_name, U.last_name", "ASC");
			$query = $this->db->get("user U");

			if ($query->num_rows() >= 1) {
				return $query->result_array();
			} else
				return false;
		}
		
		/**
		 * Lista de solicitudes
		 * @since 31/3/2018
		 */
		public function get_solicitudes($arrData) 
		{
			$this->db->select("S.*, U.*, I.hora hora_inicial, F.hora hora_final, T.tipificacion");
			if (array_key_exists("idUser", $arrData)) {
				$this->db->where('S.fk_id_user', $arrData["idUser"]);
			}
			if (array_key_exists("idSolicitud", $arrData)) {
				$this->db->where('S.id_solicitud', $arrData["idSolicitud"]);
			}
			if (array_key_exists("fecha", $arrData)) {
				$this->db->where('S.fecha_apartado', $arrData["fecha"]);
			}
			$this->db->join('user U', 'U.id_user = S.fk_id_user', 'INNER');
			$this->db->join('param_horas I', 'I.id_hora = S.fk_id_hora_inicial', 'INNER');
			$this->db->join('param_horas F', 'F.id_hora = S.fk_id_hora_final', 'INNER');
			$this->db->join('param_tipificacion T', 'T.id_tipificacion = S.fk_id_tipificacion', 'INNER');

			$this->db->order_by("S.id_solicitud", "DESC");
			$query = $this->db->get("solicitud S");

			if ($query->num_rows() >= 1) {
				return $query->result_array();
			} else
				return false;
		}
	
		

}