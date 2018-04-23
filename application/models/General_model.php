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
			$this->db->select("S.*, U.*, I.hora hora_inicial, I.formato_24 hora_inicial_24, F.hora hora_final, F.formato_24 hora_final_24, T.tipificacion, P.examen, P.prueba");
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
			$this->db->join('param_prueba P', 'P.id_prueba = S.fk_id_prueba', 'INNER');

			$this->db->order_by("S.fecha_apartado DESC, S.fk_id_hora_inicial ASC"); 
			$query = $this->db->get("solicitud S");

			if ($query->num_rows() >= 1) {
				return $query->result_array();
			} else
				return false;
		}
		
		/**
		 * Lista de pruebas
		 * @since 16/4/2018
		 */
		public function get_examenes() 
		{
				$this->db->select('DISTINCT(codigo_examen), examen');

				$this->db->order_by('codigo_examen', 'asc');
				$query = $this->db->get('param_prueba P');

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}
		
		/**
		 * Lista de pruebas
		 * @since 23/4/2018
		 */
		public function get_pruebas($arrData) 
		{
			if (array_key_exists("idPrueba", $arrData)) {
				$this->db->where('id_prueba', $arrData["idPrueba"]);
			}
			if (array_key_exists("codigoExamen", $arrData)) {
				$this->db->where('codigo_examen', $arrData["codigoExamen"]);
			}
			$this->db->order_by("examen, prueba", "ASC");
			$query = $this->db->get("param_prueba");

			if ($query->num_rows() >= 1) {
				return $query->result_array();
			} else
				return false;
		}
		
		/**
		 * Lista de pruebas por examen
		 * @since 16/4/2018
		 */
		public function get_pruebas_by($arrDatos)
		{			
				$pruebas = array();
				
				$this->db->select();
				if (array_key_exists("codigoExamen", $arrDatos)) {
					$this->db->where('codigo_examen', $arrDatos["codigoExamen"]);
				}
				$this->db->order_by('prueba', 'asc');
				$query = $this->db->get('param_prueba');
					
				if ($query->num_rows() > 0) {
					$i = 0;
					foreach ($query->result() as $row) {
						$pruebas[$i]["idPrueba"] = $row->id_prueba;
						$pruebas[$i]["prueba"] = $row->prueba;
						$i++;
					}
				}
				$this->db->close();
				return $pruebas;
		}

		/**
		 * Lista de tipificacion
		 * @since 22/4/2018
		 */
		public function get_tipificacion($arrData) 
		{
			if (array_key_exists("idTipificacion", $arrData)) {
				$this->db->where('id_tipificacion', $arrData["idTipificacion"]);
			}
			if (array_key_exists("usuario", $arrData)) {
				$this->db->where('usuario', $arrData["usuario"]);
			}
			$this->db->order_by("usuario, tipificacion", "ASC");
			$query = $this->db->get("param_tipificacion");

			if ($query->num_rows() >= 1) {
				return $query->result_array();
			} else
				return false;
		}
		
		/**
		 * Lista de horas
		 * si es un usuario gestor se filtra por las horas configuradas en la tabla param generales
		 * @since 22/4/2018
		 * @review 23/4/2018
		 */
		public function get_horas($arrData) 
		{
			if (array_key_exists("idHoraInicio", $arrData)) {
				$this->db->where('id_hora >=', $arrData["idHoraInicio"]);
			}
			if (array_key_exists("idHoraFinal", $arrData)) {
				$this->db->where('id_hora <=', $arrData["idHoraFinal"]);
			}
			$this->db->order_by("id_hora", "ASC");
			$query = $this->db->get("param_horas");

			if ($query->num_rows() >= 1) {
				return $query->result_array();
			} else
				return false;
		}
		

}