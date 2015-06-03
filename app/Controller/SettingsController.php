<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Settings Controller
 *
 * @property Settings $Settings
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */

class SettingsController extends AppController {
/**
 * Components
 * @var array
 */ 
	public $components = array('Image','Paginator', 'Session');
	public function beforeFilter(){
		parent::beforeFilter();
	}


/**
 * index method
 *
 * @return void
 */

	public function index() {
		
		$this->paginate = array('order' => 'Setting.name ASC','limit' => 20);
		 
		 $this->set('settings', $this->paginate('Setting'));
	}





/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */

	public function edit($id = null) {
		
		
		if ($this->request->is(array('post', 'put'))) {
			
			$this->Setting->set($this->request->data['Setting']);
			if ($this->Setting->validates()) {
				
				$fileArr = $this->request->data['Setting']['logo'];
				
				if(is_uploaded_file($fileArr['tmp_name'])){
					
					//start upload file code.............................
					$uploaddir = WWW_ROOT.'uploads/';
					
					$filename='';
					
					$filename = $this->Image->upload_image($fileArr['name'],$fileArr['tmp_name'],$uploaddir);
					@unlink(WWW_ROOT.'uploads'.DS.$this->data['Setting']['old_logo']);
						
					$this->request->data['Setting']['logo'] = $filename;
						
					unset($this->request->data['Setting']['old_logo']);
					
				}else{
					
					$this->request->data['Setting']['logo'] = $this->data['Setting']['old_logo'];
					unset($this->request->data['Setting']['old_logo']);
				}
				
				
					$this->Setting->id=1;
					
					if ($this->Setting->save($this->request->data,false)) {
						
						$this->Session->setFlash(__('The setting has been updated.'),'flash_custom_success');
						
						return $this->redirect(array('action' => 'index','admin'=>true));
					
					} else {
					
						$this->Session->setFlash(__('The setting could not be updated. Please, try again.'),'flash_custom_error');
					
					}
			}else {
				$this->Session->setFlash(__('The setting could not be updated. Please, try again.'),'flash_custom_error');
			}
			
		
		} 
		
		$options = array('conditions' => array('Setting.' . $this->Setting->primaryKey => 1));
		$this->request->data = $this->Setting->find('first', $options);
		$this->request->data['Setting']['old_logo'] = $this->request->data['Setting']['logo'];

		
	}

	
}
