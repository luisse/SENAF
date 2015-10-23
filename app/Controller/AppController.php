<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    	public $components = array(
        	'Acl',
        	'Auth' => array(
            	'authorize' => array(
                	'Actions' => array('actionPath' => 'controllers')
            	)
        	),
        	'Session'
    		);
	
	public function beforeRender(){
		/***try{
			$result =	$this->Acl->check(array(
				'model' => 'Group',       # The name of the Model to check agains
				'foreign_key' => $this->Session->read('tipousr') # The foreign key the Model is bind to
				), ucfirst($this->params['controller']).'/'.$this->params['action']);
	       	if(!$result)
	       		$this->redirect(array('controller' => 'accesorapidos','action'=>'seguridaderror','Users-'.$this->params['action']));
		}catch(Exeption $e){
			
		}****/
	}
	
	/**
	 * uploads files to the server
	 * @params:
	 *		$folder 	= the folder to upload the files e.g. 'img/files'
	 *		$formdata 	= the array containing the form files
	 *		$itemId 	= id of the item (optional) will create a new sub folder
	 * @return:
	 *		will return an array with the success of each file upload
	 */
	 
	public function  beforeFilter(){
		$this->Auth->actionPath = 'controllers/';
		$this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');
	    $this->Auth->allow('userajaxlogin');
   	    $this->Auth->allow('confirmarusuario');
   	    $this->Auth->allow('usersactive');  
		$this->Auth->allow('seguridaderror');
		$this->Auth->allow('addusuario');
		$this->Auth->allow('listproductos');
		$this->Auth->allow('autocompletarpv');
		$this->Auth->allow('editimage');
		$this->Auth->allow('mostrarfoto');
		$this->Auth->allow('mostrarusuario');
		$this->Auth->allow('add');
		$this->Auth->allow('seguridaderror');
		//Usuario siempre debe tener una sesion para operar en el sistema
		if($this->action != 'userajaxlogin' &&
				$this->action != 'confirmarusuario' &&
				$this->action != 'confirmarusuario' &&
				$this->action != 'usersactive' &&
				$this->action != 'login'){
				if($this->Session->check('username')==false){
					$this->redirect(array('controller'=>'users','action'=>'login'));
					$this->Session->setFlash(__('La direccion requerida requiere de login'));
				}
				
		}
		$this->set('acl',$this->Acl);
		//$this->Auth->allowedActions = array('*');
	}
	
/**
 * Reconstruye el Acl basado en los controladores actuales de la aplicación.
 *
 * @return void
 */
    function buildAcl() {
        $log = array();

        $aco =& $this->Acl->Aco;
        $root = $aco->node('controllers');
        if (!$root) {
            $aco->create(array('parent_id' => null, 'model' => null, 'alias' => 'controllers'));
            $root = $aco->save();
            $root['Aco']['id'] = $aco->id;
            $log[] = 'Creado el nodo Aco para los controladores';
        } else {
            $root = $root[0];
        }

        App::import('Core', 'File');
        $Controllers = Configure::listObjects('controller');
        $appIndex = array_search('App', $Controllers);
        if ($appIndex !== false ) {
            unset($Controllers[$appIndex]);
        }
        $baseMethods = get_class_methods('Controller');
        $baseMethods[] = 'buildAcl';

        // miramos en cada controlador en app/controllers
        foreach ($Controllers as $ctrlName) {
            App::import('Controller', $ctrlName);
            $ctrlclass = $ctrlName . 'Controller';
            $methods = get_class_methods($ctrlclass);

            //buscar / crear nodo de controlador
            $controllerNode = $aco->node('controllers/'.$ctrlName);
            if (!$controllerNode) {
                $aco->create(array('parent_id' => $root['Aco']['id'], 'model' => null, 'alias' => $ctrlName));
                $controllerNode = $aco->save();
                $controllerNode['Aco']['id'] = $aco->id;
                $log[] = 'Creado el nodo Aco del controlador '.$ctrlName;
            } else {
                $controllerNode = $controllerNode[0];
            }

            //Limpieza de los metodos, para eliminar aquellos en el controlador
            //y en las acciones privadas
            foreach ($methods as $k => $method) {
                if (strpos($method, '_', 0) === 0) {
                    unset($methods[$k]);
                    continue;
                }
                if (in_array($method, $baseMethods)) {
                    unset($methods[$k]);
                    continue;
                }
                $methodNode = $aco->node('controllers/'.$ctrlName.'/'.$method);
                if (!$methodNode) {
                    $aco->create(array('parent_id' => $controllerNode['Aco']['id'], 'model' => null, 'alias' => $method));
                    $methodNode = $aco->save();
                    $log[] = 'Creado el nodo Aco para '. $method;
                }
            }
        }
        debug($log);
    }

	
	
	/*
	*Function: valida las aplicaciones que pueden ejecutar sin necesidad de estar logueados.
	*/
    function __validateLoginStatus(){
        
		if($this->action != 'login' &&
                $this->action != 'logout' &&
                $this->action != 'userajaxlogin' &&
				$this->action != 'confirmarusuario' &&
				$this->action != 'usersactive' &&
				$this->action != 'mostrarimagen'){
            if($this->Session->check('username') == false){
                    $this->redirect(array('controller'=>'users','action'=>'login'));
                    $this->Session->setFlash('La direccion requerida requiere de login');
                }
        }else{
			//$this->set('usuario',$this->Session->read('username');
		}
    }
	 
	function uploadFiles($folder, $formdata, $itemId = null) {
		// setup dir names absolute and relative
		$folder_url = WWW_ROOT.$folder;
		$rel_url = $folder;
		
		// create the folder if it does not exist
		if(!is_dir($folder_url)) {
			mkdir($folder_url);
		}
			
		// if itemId is set create an item folder
		if($itemId) {
			// set new absolute folder
			$folder_url = WWW_ROOT.$folder.'/'.$itemId; 
			// set new relative folder
			$rel_url = $folder.'/'.$itemId;
			// create directory
			if(!is_dir($folder_url)) {
				mkdir($folder_url);
			}
		}
		
		// list of permitted file types, this is only images but documents can be added
		$permitted = array('image/gif','image/jpeg','image/pjpeg','image/png','application/pdf','application/vnd.openxmlformats-officedocument.wordprocessingml.document','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');		
		// loop through and deal with the files
		
		foreach($formdata as $file) {
			// replace spaces with underscores
			$filename = str_replace(' ', '_', $file['name']);
			// assume filetype is false
			$typeOK = false;
			// check filetype is ok
			foreach($permitted as $type) {
				if($type == $file['type']) {
					$typeOK = true;
					break;
				}
			}
			// if file type ok upload the file
			if($typeOK) {
				// switch based on error code
				switch($file['error']) {
					case 0:
						// check filename already exists
						if(!file_exists($folder_url.'/'.$filename)) {
							// create full filename
							$full_url = $folder_url.'/'.$filename;
							$url = $rel_url.'/'.$filename;
							// upload the file
							$success = move_uploaded_file($file['tmp_name'], $url);
						} else {
							// create unique filename and upload file
							ini_set('date.timezone', 'Europe/London');
							$now = date('Y-m-d-His');
							$full_url = $folder_url.'/'.$now.$filename;
							$url = $rel_url.'/'.$now.$filename;
							$success = move_uploaded_file($file['tmp_name'], $url);
						}
						// if upload was successful
						if($success) {
							// save the url of the file
							$result['urls'][] = $url;
						} else {
							$result['errors'][] = "Error al subir el archivo $filename. Por favor intente de nuevo.";
						}
						break;
					case 3:
						// an error occured
						$result['errors'][] = "Error al cargar archivo $filename. Por favor intente de nuevo.";
						break;
					default:
						// an error occured
						$result['errors'][] = "Error del sistema al subir el archivo $filename. Contacte con el Administrador del Sitio Web.";
						break;
				}
			} elseif($file['error'] == 4) {
				// no file was selected for upload
				$result['nofiles'][] = "No se selecciono un archivo";
			} else {
				// unacceptable file type
				$result['errors'][] = "$filename no se pudo subir el archivo. Se Aceptan Archivos: gif, jpg, png,pdf.,xls,docx";
			}
		}
	return $result;
	}
	
		/*
	*Funcion: permite convertir la fecha en un formato determinado para guardar la misma
	*/
	function formatDate($dateToFormat){
	    $pattern1 = '/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/i';
	    $pattern2 = '/^([0-9]{4})\/([0-9]{2})\/([0-9]{2})$/i';
	    $pattern3 = '/^([0-9]{2})-([0-9]{2})-([0-9]{4})$/i';
	    $pattern4 = '/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/i';
	
	    $coincidences = array();
	    
	    if(preg_match($pattern1, $dateToFormat)){
	        $newDate = $dateToFormat; 
	    }elseif(preg_match($pattern2, $dateToFormat, $coincidences)){
	        $newDate = $coincidences[1] . '-' . $coincidences[2] . '-' . $coincidences[3];
	    }elseif(preg_match($pattern3, $dateToFormat, $coincidences)){
	        $newDate = $coincidences[3] . '-' . $coincidences[2] . '-' . $coincidences[1];
	    }elseif(preg_match($pattern4, $dateToFormat, $coincidences)){
	        $newDate = $coincidences[3] . '-' . $coincidences[2] . '-' . $coincidences[1];
	    }else{
	        $newDate = null;
	    }
	    return $newDate;
	}
}
