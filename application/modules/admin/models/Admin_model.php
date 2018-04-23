<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Admin_model extends CI_Model {

	    
		/**
		 * Verify if the user already exist by the social insurance number
		 * @author BMOTTAG
		 * @since  27/3/2018
		 */
		public function verifyUser($arrData) 
		{
				if (array_key_exists("idUser", $arrData)) {
					$this->db->where('id_user !=', $arrData["idUser"]);
				}			

				$this->db->where($arrData["column"], $arrData["value"]);
				$query = $this->db->get("user");

				if ($query->num_rows() >= 1) {
					return true;
				} else{ return false; }
		}
				
		/**
		 * Add/Edit USUARIO
		 * @since 29/3/2018
		 */
		public function saveUsuario() 
		{
				$idUser = $this->input->post('hddId');
				
				$data = array(
					'first_name' => $this->input->post('nombres'),
					'last_name' => $this->input->post('apellidos'),
					'log_user' => $this->input->post('usuario'),
					'email' => $this->input->post('email'),
					'movil' => $this->input->post('celular'),
					'fk_id_rol' => $this->input->post('rol'),
					'state' => $this->input->post('state')
				);	

				//revisar si es para adicionar o editar
				if ($idUser == '') {
					$data['birthdate'] = date("Y-m-d");
					$data['password'] = 'e10adc3949ba59abbe56e057f20f883e';//123456
					$data['address'] = '';
					$query = $this->db->insert('user', $data);
					$idUser = $this->db->insert_id();
				} else {
					$this->db->where('id_user', $idUser);
					$query = $this->db->update('user', $data);
				}
				if ($query) {
					return $idUser;
				} else {
					return false;
				}
		}
		
	    /**
	     * Update user's password
	     * @author BMOTTAG
	     * @since  29/3/2018
	     */
	    public function updatePassword()
		{
				$idUser = $this->input->post("hddId");
				$newPassword = $this->input->post("inputPassword");
				$passwd = str_replace(array("<",">","[","]","*","^","-","'","="),"",$newPassword); 
				$passwd = md5($passwd);
				
				$data = array(
					'password' => $passwd
				);

				$this->db->where('id_user', $idUser);
				$query = $this->db->update('user', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
	    }
		
		/**
		 * Add/Edit TIPIFICACION
		 * @since 23/4/2018
		 */
		public function saveTipificacion() 
		{
				$idTipificacion = $this->input->post('hddId');
				
				$data = array(
					'tipificacion' => $this->input->post('tipificacion'),
					'usuario' => $this->input->post('usuario')
				);
				
				//revisar si es para adicionar o editar
				if ($idTipificacion == '') {
					$query = $this->db->insert('param_tipificacion', $data);				
				} else {
					$this->db->where('id_tipificacion', $idTipificacion);
					$query = $this->db->update('param_tipificacion', $data);
				}
				if ($query) {
					return true;
				} else {
					return false;
				}
		}
		
		/**
		 * Add/Edit PRUEBA
		 * @since 23/4/2018
		 */
		public function savePrueba($infoExamen) 
		{
				$idPrueba = $this->input->post('hddId');
				
				$data = array(
					'codigo_examen' => $infoExamen[0]['codigo_examen'],
					'examen' => $infoExamen[0]['examen'],
					'prueba' => $this->input->post('prueba'),
					'codigo_prueba' => $this->input->post('codigo_prueba')
				);
				
				//revisar si es para adicionar o editar
				if ($idPrueba == '') {
					$query = $this->db->insert('param_prueba', $data);				
				} else {
					$this->db->where('id_prueba', $idPrueba);
					$query = $this->db->update('param_prueba', $data);
				}
				if ($query) {
					return true;
				} else {
					return false;
				}
		}
	
		/**
		 * Edit TABLA PARAM GENERALES
		 * @since 29/3/2018
		 */
		public function saveParametricas() 
		{		
				//actualizar hora inicio
				$data = array('valor' => $this->input->post('hora_inicio'));	
				$this->db->where('id_generales', 1);
				$query = $this->db->update('param_generales', $data);
				
				//actualizar hora final
				$data = array('valor' => $this->input->post('hora_final'));	
				$this->db->where('id_generales', 2);
				$query = $this->db->update('param_generales', $data);
				
				//actualizar numero computadores
				$data = array('valor' => $this->input->post('numero_computadores'));	
				$this->db->where('id_generales', 3);
				$query = $this->db->update('param_generales', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
		}	
		
	    
	}