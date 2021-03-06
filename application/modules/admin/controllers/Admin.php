<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
        $this->load->model("admin_model");
		$this->load->helper('form');
    }
	
	/**
	 * lista de usuarios
     * @since 29/3/2018
     * @author BMOTTAG
	 */
	public function usuarios()
	{
		$this->load->model("general_model");
		$arrParam = array();
		$data['info'] = $this->general_model->get_user_list($arrParam);

		$data["view"] = 'usuarios';
		$this->load->view("layout", $data);
	}
	
	/**
	 * Form usuario
     * @since 29/3/2018
     * @author BMOTTAG
	 */
	public function update_usuario($idUser = 'x')
	{			
		$this->load->model("general_model");
		$data['information'] = FALSE;
		
		//consultar lista de roles
		$arrParam = array(
			"table" => "param_rol",
			"order" => "rol_name",
			"id" => "x"
		);
		$data['roles'] = $this->general_model->get_basic_search($arrParam);

		//si envio el id, entonces busco la informacion 
		if ($idUser != 'x') {
			$arrParam = array("idUser" => $idUser);
			$data['information'] = $this->general_model->get_user_list($arrParam);//info cliente
		}

		$data["view"] = 'form_usuario';
		$this->load->view("layout", $data);
	}
	
	/**
	 * Guardar usuario
     * @since 29/3/2018
	 */
	public function save_usuario()
	{			
			header('Content-Type: application/json');
			
			$idUser = $this->input->post('hddId');
			$log_user = $this->input->post('usuario');
			$email = $this->input->post('email');

			$msj = "Se adicionó el Usuario con éxito.";
			if ($idUser != '') {
				$msj = "Se guardó el Usuario con éxito.";
			}	
			
			$result_user = false;
			$result_email = false;

			//verificar si ya existe el usuario
			$arrParam = array(
				"idUser" => $idUser,
				"column" => "log_user",
				"value" => $log_user
			);
			$result_user = $this->admin_model->verifyUser($arrParam);
			
			//verificar si ya existe el correo
			$arrParam = array(
				"idUser" => $idUser,
				"column" => "email",
				"value" => $email
			);
			$result_email = $this->admin_model->verifyUser($arrParam);

			if ($result_user || $result_email) {
				$data["result"] = "error";
				if($result_user){
					$data["mensaje"] = " Error. El nombre de usuario ya existe.";
					$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> El nombre de usuario ya existe.');
				}
				if($result_email){
					$data["mensaje"] = " Error. El correo ya existe.";
					$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> El correo ya existe.');
				}
				if($result_user && $result_email){
					$data["mensaje"] = " Error. El nombre de usuario y correo ya existen.";
					$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> El nombre de usuario y correo ya existen.');
				}
			} else {
			
				if ($idUser = $this->admin_model->saveUsuario()) {
					$data["result"] = true;
					$data["idRecord"] = $idUser;
					$this->session->set_flashdata('retornoExito', $msj);
				} else {
					$data["result"] = "error";
					$data["idRecord"] = '';
					$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el Administrador.');
				}
			
			}

			echo json_encode($data);
    }
	
	/**
	 * Change password
     * @since 29/3/2018
     * @author BMOTTAG
	 */
	public function change_password($idUser)
	{
			if (empty($idUser)) {
				show_error('ERROR!!! - You are in the wrong place. The ID USER is missing.');
			}
			
			$this->load->model("general_model");
			$arrParam = array("idUser" => $idUser);
			$data['information'] = $this->general_model->get_user_list($arrParam);//info cliente
		
			$data["view"] = "form_password";
			$this->load->view("layout", $data);
	}
	
	/**
	 * Update user´s password
	 */
	public function update_password()
	{
			$data = array();			
			
			$newPassword = $this->input->post("inputPassword");
			$confirm = $this->input->post("inputConfirm");
			$passwd = str_replace(array("<",">","[","]","*","^","-","'","="),"",$newPassword); 
			
			$data['linkBack'] = "admin/usuarios";
			$data['titulo'] = "<i class='fa fa-unlock fa-fw'></i>CAMBIO DE CONTRASEÑA";
			
			if($newPassword == $confirm)
			{					
					if ($this->admin_model->updatePassword()) {
						$data["msj"] = "Se actualizó la contraseña.";
						$data["msj"] .= "<br><strong>Usuario: </strong>" . $this->input->post("hddUser");
						$data["msj"] .= "<br><strong>Contraseña: </strong>" . $passwd;
						$data["clase"] = "alert-success";
					}else{
						$data["msj"] = "<strong>Error!!!</strong> Ask for help.";
						$data["clase"] = "alert-danger";
					}
			}else{
				//definir mensaje de error
				echo "pailas no son iguales";
			}
						
			$data["view"] = "template/answer";
			$this->load->view("layout", $data);
	}
	
	/**
	 * tipificacion List
     * @since 22/4/2018
     * @author BMOTTAG
	 */
	public function tipificacion()
	{
			$this->load->model("general_model");

			$arrParam = array();
			$data['info'] = $this->general_model->get_tipificacion($arrParam);
			
			$data["view"] = 'tipificacion';
			$this->load->view("layout", $data);
	}
	
    /**
     * Cargo modal - formulario tipificación
     * @since 23/4/2018
     */
    public function cargarModalTipificacion() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			$data["idTipificacion"] = $this->input->post("idTipificacion");	
			
			if ($data["idTipificacion"] != 'x') {
				$this->load->model("general_model");
				$arrParam = array("idTipificacion" => $data["idTipificacion"]);
				$data['information'] = $this->general_model->get_tipificacion($arrParam);
			}
			
			$this->load->view("tipificacion_modal", $data);
    }
	
	/**
	 * Update tipificacion
     * @since 23/4/2018
     * @author BMOTTAG
	 */
	public function save_tipificacion()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idTipificacion = $this->input->post('hddId');
			
			$msj = "Se adicionó un nuevo registro!!";
			if ($idTipificacion != '') {
				$msj = "Se actualizó un registro!!";
			}

			if ($idCompany = $this->admin_model->saveTipificacion()) {
				$data["result"] = true;
				$this->session->set_flashdata('retornoExito', $msj);
			} else {
				$data["result"] = "error";
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
			}

			echo json_encode($data);	
    }

	/**
	 * Prueba List
     * @since 22/4/2018
     * @author BMOTTAG
	 */
	public function prueba()
	{
			$this->load->model("general_model");
			
			$arrParam = array();
			$data['info'] = $this->general_model->get_pruebas($arrParam);
			
			$data["view"] = 'pruebas';
			$this->load->view("layout", $data);
	}
	
    /**
     * Cargo modal - formulario prueba
     * @since 23/4/2018
     */
    public function cargarModalPrueba() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			$data["idPrueba"] = $this->input->post("idPrueba");	
			
			$this->load->model("general_model");
			//listado de examenes
			$arrParam = array();
			$data['examenes'] = $this->general_model->get_examenes($arrParam);
			
			if ($data["idPrueba"] != 'x') {
				$arrParam = array("idPrueba" => $data["idPrueba"]);
				$data['information'] = $this->general_model->get_pruebas($arrParam);
			}
			
			$this->load->view("pruebas_modal", $data);
    }
	
	/**
	 * Update prueba
     * @since 23/4/2018
     * @author BMOTTAG
	 */
	public function save_prueba()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idPrueba = $this->input->post('hddId');
			
			//averiguo info del examen
			$this->load->model("general_model");
			$arrParam = array("codigoExamen" => $this->input->post('examen'));
			$infoExamen = $this->general_model->get_pruebas($arrParam);
			
			$msj = "Se adicionó un nuevo registro!!";
			if ($idPrueba != '') {
				$msj = "Se actualizó un registro!!";
			}

			if ($idCompany = $this->admin_model->savePrueba($infoExamen)) {
				$data["result"] = true;
				$this->session->set_flashdata('retornoExito', $msj);
			} else {
				$data["result"] = "error";
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
			}

			echo json_encode($data);	
    }
	
	/**
	 * Form para actualizar datos de la tabla param general
     * @since 23/4/2018
     * @author BMOTTAG
	 */
	public function update_parametricas()
	{			
		$this->load->model("general_model");
		
		$arrParam = array();
		$data['horas'] = $this->general_model->get_horas($arrParam);//LISTA DE HORAS
		
		//informacion tabla param general
		$arrParam = array(
			"table" => "param_generales",
			"order" => "id_generales",
			"id" => "x"
		);
		$data['information'] = $this->general_model->get_basic_search($arrParam);
	
		$data["view"] = 'form_parametricas';
		$this->load->view("layout", $data);
	}

	/**
	 * Guardar parametricas
     * @since 23/4/2018
	 */
	public function save_parametricas()
	{			
			header('Content-Type: application/json');

			if ($this->admin_model->saveParametricas()) {
				$data["result"] = true;
				$this->session->set_flashdata('retornoExito', "Se actualizó la información.");
			} else {
				$data["result"] = "error";
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el Administrador.');
			}


			echo json_encode($data);
    }
	
	/**
	 * Vista para cargar informacion de usuarios a la base de datos
     * @since 10/6/2018
	 */
	public function subir_usuarios($error="", $success="")
	{		
	
			$data["error"] = $error;
			$data["success"] = $success;
			$data["view"] = 'cargar_usuarios';
			$this->load->view("layout", $data);
	}
	
	/**
	 * Subir archivo
     * @since 11/6/2018
	 */
	public function do_upload()
	{		
            $config['upload_path'] = './tmp/';
            $config['overwrite'] = true;
            $config['allowed_types'] = 'csv';
            $config['max_size'] = '5000';
            $config['file_name'] = 'cargar_informacion_usuarios.csv';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = $this->upload->display_errors();
                $msgError = html_escape(substr($error, 3, -4));
                $this->subir_usuarios($msgError);
            }else {				
                $file_info = $this->upload->data();
                $data = array('upload_data' => $this->upload->data());

                $archivo = $file_info['file_name'];

				$registros = array();
				if (($fichero = fopen(FCPATH . 'tmp/' . $archivo, "a+")) !== FALSE) {
					// Lee los nombres de los campos
					$nombres_campos = fgetcsv($fichero, 0, ";");
					$num_campos = count($nombres_campos);
					// Lee los registros

					while (($datos = fgetcsv($fichero, 0, ";")) !== FALSE) {
						// Crea un array asociativo con los nombres y valores de los campos
						for ($icampo = 0; $icampo < $num_campos; $icampo++) {
							$registro[$nombres_campos[$icampo]] = $datos[$icampo];
						}
						// Añade el registro leido al array de registros
						$registros[] = $registro;
					}
					fclose($fichero);
					
					foreach ($registros as $lista) {
						$idUsuario = $this->admin_model->cargar_informacion_usuarios($lista);
					}
				}

            }
			
			$success = 'El archivo se cargo correctamente.';
			$this->subir_usuarios('', $success);
			
    }
	
	/**
	 * Examen List
     * @since 12/6/2018
     * @author BMOTTAG
	 */
	public function examen()
	{
			$this->load->model("general_model");
			
			$arrParam = array();
			$data['info'] = $this->general_model->get_examenes($arrParam);
			
			$data["view"] = 'examen';
			$this->load->view("layout", $data);
	}
	
    /**
     * Cargo modal - formulario examen
     * @since 12/6/2018
     */
    public function cargarModalExamen() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			$data["codigoExamen"] = $this->input->post("codigoExamen");	
			
			$this->load->model("general_model");
			
			if ($data["codigoExamen"] != 'x') {
				$arrParam = array("codigoExamen" => $data["codigoExamen"]);
				$data['information'] = $this->general_model->get_examenes($arrParam);
			}
			
			$this->load->view("examen_modal", $data);
    }
	
	/**
	 * Update examen
     * @since 12/6/2018
     * @author BMOTTAG
	 */
	public function save_examen()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$codigoExamen = $this->input->post('hddId');
						
			$msj = "Se adicionó un nuevo registro!!";
			if ($codigoExamen != '') {
				$msj = "Se actualizó un registro!!";
			}

			if ($this->admin_model->saveExamen()) {
				$data["result"] = true;
				$this->session->set_flashdata('retornoExito', $msj);
			} else {
				$data["result"] = "error";
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
			}

			echo json_encode($data);	
    }


	
}