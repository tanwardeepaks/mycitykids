<?php 

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**

 * Notification Controller

 *

 * @property PaginatorComponent $Paginator

 * @property SessionComponent $Session

 */

class NotificationsController extends AppController {



/**

 * Components

 *

 * @var array

 */

	public $components = array('Paginator', 'Session', 'Image');

	 public function beforeFilter() {

        parent::beforeFilter();

        $this->Auth->allow();

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
		
		//pr($this->params->query['search_criteria']); die;
		if(array_key_exists('search_criteria',$this->params->query) && $this->params->query['search_criteria']!=''){
				$orConditions=array('OR'=>array(
												'Notification.name LIKE'=>'%'. $this->params->query['search_criteria'] . '%'
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
				'order' => 'Notification.name ASC',
				'limit' => 20	
			);
		}else{
		
		$this->paginate = array('order' => 'Notification.name ASC','limit' => 20);
		
		}
		 
		 $this->set('notifications', $this->paginate('Notification'));
		
			
	
	}






/**

 * add method

 *

 * @return void

 */

	public function add() {
			
		if ($this->request->is('post')) {
			
			$this->Notification->set($this->request->data['Notification']);
		
			if ($this->Notification->validates()) {
		
				$fileArr = $this->request->data['Notification']['image'];
				
				if(is_uploaded_file($fileArr['tmp_name'])){
					
					//start upload file code.............................
					$uploaddir = WWW_ROOT.'uploads/notification/';
					
					$filename='';
					
					if($fileArr['name']!=''){ 
					
						$filename = $this->Image->upload_image($fileArr['name'],$fileArr['tmp_name'],$uploaddir);
					
						$this->Image->resize_image($uploaddir.$filename,150,100,$uploaddir.'150x100/'.$filename);
					
						$this->Image->resize_image($uploaddir.$filename,600,400,$uploaddir.'600x400/'.$filename);
					}
				
					$this->request->data['Notification']['image'] = $filename;
					
					
					
				}else{
					$this->request->data['Notification']['image'] = '';
				}
				
				
					
						
					//set Notification slug......................................................
					if($this->data['Notification']['slug'] != '')
						$this->request->data['Notification']['slug'] = Inflector::slug(strtolower($this->data['Notification']['slug']), '-');
					else
						$this->request->data['Notification']['slug'] = Inflector::slug(strtolower($this->data['Notification']['name']), '-');
						
					
					$this->Notification->create();
					
					if ($this->Notification->save($this->request->data,false)) {
						
						$this->Session->setFlash(__('The notification has been saved.'),'flash_custom_success');
						
						return $this->redirect(array('action' => 'index'));
					
					} else {
					
						$this->Session->setFlash(__('The notification could not be saved. Please, try again.'),'flash_custom_error');
					
					}
					
				
			} else {
				$this->Session->setFlash(__('The notification could not be saved. Please, try again.'),'flash_custom_error');
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
			
		if (!$this->Notification->exists($id)) {
			throw new NotFoundException(__('Invalid Notification'));
		}
		$this->Notification->exists=$id;
		if ($this->request->is(array('post', 'put'))) {
			$this->Notification->set($this->request->data['Notification']);
			if ($this->Notification->validates()) {
				
				$fileArr = $this->request->data['Notification']['image'];
				
				if(is_uploaded_file($fileArr['tmp_name'])){
					
					//start upload file code.............................
					$uploaddir = WWW_ROOT.'uploads/notification/';
					
					$filename='';
					
					$filename = $this->Image->upload_image($fileArr['name'],$fileArr['tmp_name'],$uploaddir);
					
					$this->Image->resize_image($uploaddir.$filename,150,100,$uploaddir.'150x100/'.$filename);
					
					$this->Image->resize_image($uploaddir.$filename,600,400,$uploaddir.'600x400/'.$filename);
						
					@unlink(WWW_ROOT.'uploads'.DS.'notification'.DS. $this->data['Notification']['old_image']);
					
					@unlink(WWW_ROOT.'uploads'.DS.'notification'.DS.'150x100'.DS.$this->data['Notification']['old_image']);
						
					@unlink(WWW_ROOT.'uploads'.DS.'notification'.DS.'600x400'.DS.$this->data['Notification']['old_image']);
						
					$this->request->data['Notification']['image'] = $filename;
						
					unset($this->request->data['Notification']['old_image']);
					
				}else{
					
					$this->request->data['Notification']['image'] = $this->data['Notification']['old_image'];
					unset($this->request->data['Notification']['old_image']);
				}
				
					
					//set category slug......................................................
					if($this->data['Notification']['slug'] != '')
						$this->request->data['Notification']['slug'] = Inflector::slug(strtolower($this->data['Notification']['slug']), '-');
					else
						$this->request->data['Notification']['slug'] = Inflector::slug(strtolower($this->data['Notification']['name']), '-');
					
					
					$this->Notification->id=$id;
					
					if ($this->Notification->save($this->request->data,false)) {
						
						$this->Session->setFlash(__('The notification has been updated.'),'flash_custom_success');
						
						return $this->redirect(array('action' => 'index'));
					
					} else {
					
						$this->Session->setFlash(__('The notification could not be updated. Please, try again.'),'flash_custom_error');
					
					}
			}else {
				$this->Session->setFlash(__('The notification could not be updated. Please, try again.'),'flash_custom_error');
			}
			
		} 
		
		$options = array('conditions' => array('Notification.' . $this->Notification->primaryKey => $id));
		$this->request->data = $this->Notification->find('first', $options);
		$this->request->data['Notification']['old_image'] = $this->request->data['Notification']['image']; 

	
		
	}



/**

 * delete method

 *

 * @throws NotFoundException

 * @param string $id

 * @return void

 */

	public function delete($id = null) {
			

		$this->Notification->id = $id;

		if (!$this->Notification->exists()) {

			throw new NotFoundException(__('Invalid Notification'));

		}

		$this->request->onlyAllow('post', 'delete');

		if ($this->Notification->delete()) {

			$this->Session->setFlash(__('The Notification has been deleted.'));

		} else {

			$this->Session->setFlash(__('The Notification could not be deleted. Please, try again.'));

		}

		return $this->redirect(array('action' => 'index'));

	
	}
	

	
}

