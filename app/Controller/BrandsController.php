<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Brands Controller
 *
 * @property Brands $Brands
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */

class BrandsController extends AppController {
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
 * @return void
 * This function display the listing of brands
 * REI Technology Jaipur
 * Rajeev Rathore
 */

	public function index() {
		
		//check searching conditions and fetch record according.................
		$orConditions=array();
		$andConditions=array();
		$finalConditions=array();
		
		
		if(array_key_exists('search_criteria',$this->params->query) && $this->params->query['search_criteria']!=''){
				$orConditions=array('OR'=>array(
												'Brand.name LIKE'=>'%'. $this->params->query['search_criteria'] . '%'
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
				'order' => 'Brand.name ASC',
				'limit' => 20	
			);
		}else{
		
		$this->paginate = array('order' => 'Brand.name ASC','limit' => 20);
		
		}
		 
		 $this->set('brands', $this->paginate('Brand'));
	}



/**
 * add method
 * @return void
 * This function add the brands
 * REI Technology Jaipur
 * Rajeev Rathore
 */

	public function add() {
		if ($this->request->is('post')) {
			
			$this->Brand->set($this->request->data['Brand']);
		
			if ($this->Brand->validates()) {
		
				$fileArr = $this->request->data['Brand']['image'];
				
				if(is_uploaded_file($fileArr['tmp_name'])){
					
					//start upload file code.............................
					$uploaddir = WWW_ROOT.'uploads/brand/';
					
					$filename='';
					
					if($fileArr['name']!=''){ 
					
						$filename = $this->Image->upload_image($fileArr['name'],$fileArr['tmp_name'],$uploaddir);
					
						$this->Image->resize_image($uploaddir.$filename,150,100,$uploaddir.'150x100/'.$filename);
					
						$this->Image->resize_image($uploaddir.$filename,600,400,$uploaddir.'600x400/'.$filename);
					}
				
					$this->request->data['Brand']['image'] = $filename;
					
					
					
				}else{
					$this->request->data['Brand']['image'] = '';
				}
				
				
					
						
					//set category slug......................................................
					if($this->data['Brand']['slug'] != '')
						$this->request->data['Brand']['slug'] = Inflector::slug(strtolower($this->data['Brand']['slug']), '-');
					else
						$this->request->data['Brand']['slug'] = Inflector::slug(strtolower($this->data['Brand']['name']), '-');
						
					
					$this->Brand->create();
					
					if ($this->Brand->save($this->request->data,false)) {
						
						$this->Session->setFlash(__('The brand has been saved.'),'flash_custom_success');
						
						return $this->redirect(array('action' => 'index'));
					
					} else {
					
						$this->Session->setFlash(__('The brand could not be saved. Please, try again.'),'flash_custom_error');
					
					}
					
				
			} else {
				$this->Session->setFlash(__('The brand could not be saved. Please, try again.'),'flash_custom_error');
			}
		}
		
	
	}

/**
 * edit method
 * @throws NotFoundException
 * @param string $id
 * @return void
 * This function edit the brands
 * REI Technology Jaipur
 * Rajeev Rathore
 */

	public function edit($id = null) {
		if (!$this->Brand->exists($id)) {
			throw new NotFoundException(__('Invalid Brand'));
		}
		$this->Brand->exists=$id;
		if ($this->request->is(array('post', 'put'))) {
			$this->Brand->set($this->request->data['Brand']);
			if ($this->Brand->validates()) {
				
				$fileArr = $this->request->data['Brand']['image'];
				
				if(is_uploaded_file($fileArr['tmp_name'])){
					
					//start upload file code.............................
					$uploaddir = WWW_ROOT.'uploads/brand/';
					
					$filename='';
					
					$filename = $this->Image->upload_image($fileArr['name'],$fileArr['tmp_name'],$uploaddir);
					
					$this->Image->resize_image($uploaddir.$filename,150,100,$uploaddir.'150x100/'.$filename);
					
					$this->Image->resize_image($uploaddir.$filename,600,400,$uploaddir.'600x400/'.$filename);
						
					@unlink(WWW_ROOT.'uploads'.DS.'category'.DS. $this->data['Category']['old_image']);
					
					@unlink(WWW_ROOT.'uploads'.DS.'category'.DS.'150x100'.DS.$this->data['Category']['old_image']);
						
					@unlink(WWW_ROOT.'uploads'.DS.'category'.DS.'600x400'.DS.$this->data['Category']['old_image']);
						
					$this->request->data['Brand']['image'] = $filename;
						
					unset($this->request->data['Brand']['old_image']);
					
				}else{
					
					$this->request->data['Brand']['image'] = $this->data['Brand']['old_image'];
					unset($this->request->data['Brand']['old_image']);
				}
				
				
					//set category slug......................................................
					if($this->data['Brand']['slug'] != '')
						$this->request->data['Brand']['slug'] = Inflector::slug(strtolower($this->data['Brand']['slug']), '-');
					else
						$this->request->data['Brand']['slug'] = Inflector::slug(strtolower($this->data['Brand']['name']), '-');
					
					
					$this->Brand->id=$id;
					
					if ($this->Brand->save($this->request->data,false)) {
						
						$this->Session->setFlash(__('The brand has been updated.'),'flash_custom_success');
						
						return $this->redirect(array('action' => 'index'));
					
					} else {
					
						$this->Session->setFlash(__('The brand could not be updated. Please, try again.'),'flash_custom_error');
					
					}
			}else {
				$this->Session->setFlash(__('The brand could not be updated. Please, try again.'),'flash_custom_error');
			}
			
		} 
		
		$options = array('conditions' => array('Brand.' . $this->Brand->primaryKey => $id));
		$this->request->data = $this->Brand->find('first', $options);
		$this->request->data['Brand']['old_image'] = $this->request->data['Brand']['image']; 

		
	}

	
}
