<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Blogs Controller
 *
 * @property Blogs $Blogs
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */

class BlogsController extends AppController {
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
												'Blog.name LIKE'=>'%'. $this->params->query['search_criteria'] . '%'
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
				'order' => 'Blog.name ASC',
				'limit' => 20	
			);
		}else{
		
		$this->paginate = array('order' => 'Blog.name ASC','limit' => 20);
		
		}
		 
		 $this->set('blogs', $this->paginate('Blog'));
		
			
	}



/**
 * add method
 *
 * @return void
 */

	public function add() {
		if ($this->request->is('post')) {
			// pr($this->request->data); die;
			$this->Blog->set($this->request->data['Blog']);
		
			if ($this->Blog->validates()) {
		
				$fileArr = $this->request->data['Blog']['image'];
				
				if(is_uploaded_file($fileArr['tmp_name'])){
					
					//start upload file code.............................
					$uploaddir = WWW_ROOT.'uploads/blog/';
					
					$filename='';
					
					if($fileArr['name']!=''){ 
					
						$filename = $this->Image->upload_image($fileArr['name'],$fileArr['tmp_name'],$uploaddir);
					
						$this->Image->resize_image($uploaddir.$filename,150,100,$uploaddir.'150x100/'.$filename);
					
						$this->Image->resize_image($uploaddir.$filename,600,400,$uploaddir.'600x400/'.$filename);
					}
				
					$this->request->data['Blog']['image'] = $filename;
					
					
					
				}else{
					$this->request->data['Blog']['image'] = '';
				}
				
				

					//set category slug......................................................
					if($this->data['Blog']['slug'] != '')
						$this->request->data['Blog']['slug'] = Inflector::slug(strtolower($this->data['Blog']['slug']), '-');
					else
						$this->request->data['Blog']['slug'] = Inflector::slug(strtolower($this->data['Blog']['name']), '-');
						
					
					$this->Blog->create();
					
					if ($this->Blog->save($this->request->data,false)) {
						
						$this->Session->setFlash(__('The Blog has been saved.'),'flash_custom_success');
						
						return $this->redirect(array('action' => 'index'));
					
					} else {
					
						$this->Session->setFlash(__('The Blog could not be saved. Please, try again.'),'flash_custom_error');
					
					}
					
				
			} else {
				$this->Session->setFlash(__('The Blog could not be saved. Please, try again.'),'flash_custom_error');
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
		if (!$this->Blog->exists($id)) {
			throw new NotFoundException(__('Invalid Blog'));
		}
		$this->Blog->exists=$id;
		if ($this->request->is(array('post', 'put'))) {
			$this->Blog->set($this->request->data['Blog']);
			if ($this->Blog->validates()) {
				
				$fileArr = $this->request->data['Blog']['image'];
				
				if(is_uploaded_file($fileArr['tmp_name'])){
					
					//start upload file code.............................
					$uploaddir = WWW_ROOT.'uploads/blog/';
					
					$filename='';
					
					$filename = $this->Image->upload_image($fileArr['name'],$fileArr['tmp_name'],$uploaddir);
					
					$this->Image->resize_image($uploaddir.$filename,150,100,$uploaddir.'150x100/'.$filename);
					
					$this->Image->resize_image($uploaddir.$filename,600,400,$uploaddir.'600x400/'.$filename);
						
					@unlink(WWW_ROOT.'uploads'.DS.'blog'.DS. $this->data['Blog']['old_image']);
					
					@unlink(WWW_ROOT.'uploads'.DS.'blog'.DS.'150x100'.DS.$this->data['Blog']['old_image']);
						
					@unlink(WWW_ROOT.'uploads'.DS.'blog'.DS.'600x400'.DS.$this->data['Blog']['old_image']);
						
					$this->request->data['Blog']['image'] = $filename;
						
					unset($this->request->data['Blog']['old_image']);
					
				}else{
					
					$this->request->data['Blog']['image'] = $this->data['Blog']['old_image'];
					unset($this->request->data['Blog']['old_image']);
				}
				

					//set category slug......................................................
					if($this->data['Blog']['slug'] != '')
						$this->request->data['Blog']['slug'] = Inflector::slug(strtolower($this->data['Blog']['slug']), '-');
					else
						$this->request->data['Blog']['slug'] = Inflector::slug(strtolower($this->data['Blog']['name']), '-');
					
					
					$this->Blog->id=$id;
					
					if ($this->Blog->save($this->request->data,false)) {
						
						$this->Session->setFlash(__('The Blog has been updated.'),'flash_custom_success');
						
						return $this->redirect(array('action' => 'index'));
					
					} else {
					
						$this->Session->setFlash(__('The category could not be updated. Please, try again.'),'flash_custom_error');
					
					}
			}else {
				$this->Session->setFlash(__('The category could not be updated. Please, try again.'),'flash_custom_error');
			}
			
		} 
		
		$options = array('conditions' => array('Blog.' . $this->Blog->primaryKey => $id));
		$this->request->data = $this->Blog->find('first', $options);
		$this->request->data['Blog']['old_image'] = $this->request->data['Blog']['image'];


	}



/**

* delete method

*

* @throws NotFoundException

* @param string $id

* @return void

*/

public function delete($id = null) {

        $this->Blog->id = $id;

        if (!$this->Blog->exists()) {

        throw new NotFoundException(__('Invalid Blog'));

        }

        $this->request->onlyAllow('post', 'delete');

        if ($this->Blog->delete()) {

            $this->Session->setFlash(__('The page has been deleted.'));

            } else {

            $this->Session->setFlash(__('The page could not be deleted. Please, try again.'));

            }

        return $this->redirect(array('action' => 'index'));

}



}
