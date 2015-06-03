<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Banners Controller
 *
 * @property Banners $Banners
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */

class BannersController extends AppController {
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
		
		//check searching conditions and fetch record according.................
		$orConditions=array();
		$andConditions=array();
		$finalConditions=array();
		
		
		if(array_key_exists('search_criteria',$this->params->query) && $this->params->query['search_criteria']!=''){
				$orConditions=array('OR'=>array(
												'Banner.name LIKE'=>'%'. $this->params->query['search_criteria'] . '%'
											  ));
		
		}
		
		
		
		if(!empty($orConditions)){
				$finalConditions=array_merge($finalConditions,$orConditions);
		}
		
		
		if(!empty($andConditions)){
				$finalConditions=array_merge($finalConditions,array('AND'=>$andConditions));
		}
		
			
		//pr($finalConditions);die;			
		//check if listing is in searching mode....................
		if(!empty($finalConditions)){
		
				$this->paginate = array(
				'conditions' => $finalConditions,
				'order' => 'Banner.name ASC',
				'limit' => 20	
			);
		}else{
		
		$this->paginate = array('order' => 'Banner.name ASC','limit' => 20);
		
		}
		 
		 $this->set('banners', $this->paginate('Banner'));
	}



/**
 * add method
 *
 * @return void
 */

	public function add() {
		if ($this->request->is('post')) {
			
			$this->Banner->set($this->request->data['Banner']);
		
			if ($this->Banner->validates()) {
		
				$fileArr = $this->request->data['Banner']['image'];
				
				if(is_uploaded_file($fileArr['tmp_name'])){
					
					//start upload file code.............................
					$uploaddir = WWW_ROOT.'uploads/banner/';
					
					$filename='';
					
					if($fileArr['name']!=''){ 
						$filename = $this->Image->upload_image($fileArr['name'],$fileArr['tmp_name'],$uploaddir);
					}
					$this->request->data['Banner']['image'] = $filename;
					
				}else{
					$this->request->data['Banner']['image'] = '';
				}
	
					$this->Banner->create();
					if ($this->Banner->save($this->request->data,false)) {
						
						$this->Session->setFlash(__('The banner has been saved.'),'flash_custom_success');
						
						return $this->redirect(array('action' => 'index'));
					
					} else {
					
						$this->Session->setFlash(__('The banner could not be saved. Please, try again.'),'flash_custom_error');
					
					}
					
				
			} else {
				$this->Session->setFlash(__('The banner could not be saved. Please, try again.'),'flash_custom_error');
			}
		}
		
	
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */

	public function edit($id = null) {
		if (!$this->Banner->exists($id)) {
			throw new NotFoundException(__('Invalid Banner'));
		}
		$this->Banner->exists=$id;
		if ($this->request->is(array('post', 'put'))) {
			$this->Banner->set($this->request->data['Banner']);
			if ($this->Banner->validates()) {
				
				$fileArr = $this->request->data['Banner']['image'];
				
				if(is_uploaded_file($fileArr['tmp_name'])){
					
					//start upload file code.............................
					$uploaddir = WWW_ROOT.'uploads/banner/';
					
					$filename='';
					
					$filename = $this->Image->upload_image($fileArr['name'],$fileArr['tmp_name'],$uploaddir);
						
					@unlink(WWW_ROOT.'uploads'.DS.'banner'.DS. $this->data['Category']['old_image']);
						
					$this->request->data['Banner']['image'] = $filename;
						
					unset($this->request->data['Banner']['old_image']);
					
				}else{
					
					$this->request->data['Banner']['image'] = $this->data['Banner']['old_image'];
					unset($this->request->data['Banner']['old_image']);
				}
				
				
					$this->Banner->id=$id;
					
					if ($this->Banner->save($this->request->data,false)) {
						
						$this->Session->setFlash(__('The banner has been updated.'),'flash_custom_success');
						
						return $this->redirect(array('action' => 'index'));
					
					} else {
					
						$this->Session->setFlash(__('The banner could not be updated. Please, try again.'),'flash_custom_error');
					
					}
			}else {
				$this->Session->setFlash(__('The banner could not be updated. Please, try again.'),'flash_custom_error');
			}
			
		} 
		
		$options = array('conditions' => array('Banner.' . $this->Banner->primaryKey => $id));
		$this->request->data = $this->Banner->find('first', $options);
		$this->request->data['Banner']['old_image'] = $this->request->data['Banner']['image']; 

		
	}


/**

 * delete method

 *

 * @throws NotFoundException

 * @param string $id

 * @return void

 */

	public function delete($id = null) {

		$this->Banner->id = $id;

		if (!$this->Banner->exists()) {

			throw new NotFoundException(__('Invalid Banner'));

		}

		$this->request->onlyAllow('post', 'delete');

		if ($this->Banner->delete(array('Banner.id' => $id), true)) {

			$this->Session->setFlash(__('The banner has been deleted.'));

		} else {

			$this->Session->setFlash(__('The banner could not be deleted. Please, try again.'));

		}

		return $this->redirect(array('action' => 'index'));

	}
	
	
}
