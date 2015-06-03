<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Category Controller
 *
 * @property Category $Category
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */

class CategoriesController extends AppController {
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
 * This function display the listing of categories and searching categories according to search fields
 * REI Technology Jaipur
 * Rajeev Rathore
 */

	public function index() {
	
		//check searching conditions and fetch record according searching fields.................
		$orConditions=array();
		$andConditions=array();
		$finalConditions=array();
		
		
		if(array_key_exists('search_criteria',$this->params->query) && $this->params->query['search_criteria']!=''){
				$orConditions=array('OR'=>array(
												'Category.name LIKE'=>'%'. $this->params->query['search_criteria'] . '%',
												'Parent.name LIKE'=>'%'. $this->params->query['search_criteria'] . '%'
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
				'order' => 'Category.parent_id ASC,Category.name ASC',
				'limit' => 20	
			);
		}else{
		
		$this->paginate = array('order' => 'Category.parent_id ASC,Category.name ASC','limit' => 20);
		
		}
		 
		 $this->set('categories', $this->paginate('Category'));
		
			
	}



/**
 * add method
 * This function is used to add the categories
 * REI Technology Jaipur
 * Rajeev Rathore
 */

	public function add() {
		if ($this->request->is('post')) {
		//pr($this->request->data);die;
			
			$this->Category->set($this->request->data['Category']);
		
			if ($this->Category->validates()) {
		
				$fileArr = $this->request->data['Category']['image'];
				
				if(is_uploaded_file($fileArr['tmp_name'])){
					
					//start upload file code.............................
					$uploaddir = WWW_ROOT.'uploads/category/';
					
					$filename='';
					
					if($fileArr['name']!=''){ 
					
						$filename = $this->Image->upload_image($fileArr['name'],$fileArr['tmp_name'],$uploaddir);
					
						$this->Image->resize_image($uploaddir.$filename,150,100,$uploaddir.'150x100/'.$filename);
					
						$this->Image->resize_image($uploaddir.$filename,600,400,$uploaddir.'600x400/'.$filename);
					}
				
					$this->request->data['Category']['image'] = $filename;
					
					
					
				}else{
					$this->request->data['Category']['image'] = '';
				}
				
				
					if($this->data['Category']['parent_id'] == '')					
						$this->request->data['Category']['parent_id'] = 0;
						
					//set category slug......................................................
					if($this->data['Category']['slug'] != '')
						$this->request->data['Category']['slug'] = Inflector::slug(strtolower($this->data['Category']['slug']), '-');
					else
						$this->request->data['Category']['slug'] = Inflector::slug(strtolower($this->data['Category']['name']), '-');
						
					
					$this->Category->create();
					
					if ($this->Category->save($this->request->data,false)) {
						
						$this->Session->setFlash(__('The category has been saved.'),'flash_custom_success');
						
						return $this->redirect(array('action' => 'index'));
					
					} else {
					
						$this->Session->setFlash(__('The category could not be saved. Please, try again.'),'flash_custom_error');
					
					}
					
				
			} else {
				$this->Session->setFlash(__('The category could not be saved. Please, try again.'),'flash_custom_error');
			}
		}
		
		$pcat = $this->Category->find('list');
		
		$this->set(compact('pcat'));
	}

/**
 * edit method
 * @throws NotFoundException
 * @param string $id
 * @return void
 * This function edit the categories
 * REI Technology Jaipur
 * Rajeev Rathore
 */

	public function edit($id = null) {
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Invalid Category'));
		}
		$this->Category->exists=$id;
		if ($this->request->is(array('post', 'put'))) {
		//pr($this->request->data);die;
			$this->Category->set($this->request->data['Category']);
			if ($this->Category->validates()) {
				
				$fileArr = $this->request->data['Category']['image'];
				
				if(is_uploaded_file($fileArr['tmp_name'])){
					
					//start upload file code.............................
					$uploaddir = WWW_ROOT.'uploads/category/';
					
					$filename='';
					
					$filename = $this->Image->upload_image($fileArr['name'],$fileArr['tmp_name'],$uploaddir);
					
					$this->Image->resize_image($uploaddir.$filename,150,100,$uploaddir.'150x100/'.$filename);
					
					$this->Image->resize_image($uploaddir.$filename,600,400,$uploaddir.'600x400/'.$filename);
						
					@unlink(WWW_ROOT.'uploads'.DS.'category'.DS. $this->data['Category']['old_image']);
					
					@unlink(WWW_ROOT.'uploads'.DS.'category'.DS.'150x100'.DS.$this->data['Category']['old_image']);
						
					@unlink(WWW_ROOT.'uploads'.DS.'category'.DS.'600x400'.DS.$this->data['Category']['old_image']);
						
					$this->request->data['Category']['image'] = $filename;
						
					unset($this->request->data['Category']['old_image']);
					
				}else{
					
					$this->request->data['Category']['image'] = $this->data['Category']['old_image'];
					unset($this->request->data['Category']['old_image']);
				}
				
					if($this->data['Category']['parent_id'] == '')
						$this->request->data['Category']['parent_id'] = 0;
					
					//set category slug......................................................
					if($this->data['Category']['slug'] != '')
						$this->request->data['Category']['slug'] = Inflector::slug(strtolower($this->data['Category']['slug']), '-');
					else
						$this->request->data['Category']['slug'] = Inflector::slug(strtolower($this->data['Category']['name']), '-');
					
					
					$this->Category->id=$id;
					
					if ($this->Category->save($this->request->data,false)) {
						
						$this->Session->setFlash(__('The category has been updated.'),'flash_custom_success');
						
						return $this->redirect(array('action' => 'index'));
					
					} else {
					
						$this->Session->setFlash(__('The category could not be updated. Please, try again.'),'flash_custom_error');
					
					}
			}else {
				$this->Session->setFlash(__('The category could not be updated. Please, try again.'),'flash_custom_error');
			}
			
		} 
		
		$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
		$this->request->data = $this->Category->find('first', $options);
		$this->request->data['Category']['old_image'] = $this->request->data['Category']['image']; 

		$pcat = $this->Category->find('list',array('conditions'=>array('Category.id !='=>$id)));
		$this->set(compact('pcat'));
	}

	
}
