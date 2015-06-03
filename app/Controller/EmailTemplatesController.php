<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * EmailTemplates Controller
 *
 * @property EmailTemplate $EmailTemplate
 */
class EmailTemplatesController extends AppController {

/**
 * Components
 *
 * @var array
 */

public $components = array('Email','Image');

public function beforeFilter() {
    parent::beforeFilter();
	
	
}


/*
* index method
*List all email templates  or
*List all email templates after filter
*/
public function index() {
	
	 //check searching conditions and fetch record according.................
		$andConditions=array();
		
		if(array_key_exists('search_criteria',$this->params->query) && $this->params->query['search_criteria']!=''){
				
				$andConditions=array_merge($andConditions,array('EmailTemplate.subject LIKE'=>'%'. $this->params->query['search_criteria'] . '%'));							  
		
		}
		
		if(array_key_exists('from_date',$this->params->query) && $this->params->query['from_date']!=''){

	    		$andConditions=array_merge($andConditions,array('DATE_FORMAT(EmailTemplate.created,"%Y-%m-%d") >='=>date('Y-m-d',strtotime($this->params->query['from_date']))));
		
		}
		
		if(array_key_exists('to_date',$this->params->query) && $this->params->query['to_date']!=''){
		
				$andConditions=array_merge($andConditions,array('DATE_FORMAT(EmailTemplate.created,"%Y-%m-%d") <='=>date('Y-m-d',strtotime($this->params->query['to_date']))));
		
		}
		
		if(array_key_exists('status',$this->params->query) && $this->params->query['status']!=''){
				
				$andConditions=array_merge($andConditions,array('EmailTemplate.status'=>$this->params->query['is_active']));
				
		}	
			
		//check if listing is in searching mode....................
		if(!empty($andConditions)){
		
				$this->paginate = array(
				'conditions' => $andConditions,
				'order' => 'EmailTemplate.id DESC',
				'limit' => 20	
			);
		}else{
		
		$this->paginate = array('order' => 'EmailTemplate.id DESC','limit' => 20);
		
		}
	
	
	$this->set('email_templates', $this->paginate('EmailTemplate'));
	
	$this->set('title_for_layout','Email Templates');
}


/**
 * add method
 *
 * @return void
 */
public function add() {
	
		if ($this->request->is('post') || $this->request->is('put')) {
				
				if(!array_key_exists('is_active',$this->request->data['EmailTemplate']))
					$this->request->data['EmailTemplate']['is_active']=0;
				
				$this->EmailTemplate->create();
				if($this->EmailTemplate->save($this->request->data)){
				
					$this->Session->setFlash(__('Email template has been saved'),'flash_custom_success');
				
					$this->redirect(array('action' => 'index'));
				}else{
					$this->Session->setFlash(__('Email template could not be saved. Please, try again.'),'flash_custom_error');
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
		
		$this->EmailTemplate->id = $id;
		//check category exist
		if (!$this->EmailTemplate->exists()) {
			$this->Session->setFlash(__('Invalid Email Template.'),'flash_custom_error');
			$this->redirect(array('action' => 'index'));
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			
			if(!array_key_exists('is_active',$this->request->data['EmailTemplate']))
				$this->request->data['EmailTemplate']['is_active']=0;
			
			if($this->EmailTemplate->save($this->request->data)){
				
					$this->Session->setFlash(__('Email template has been saved'),'flash_custom_success');
				
					$this->redirect(array('action' => 'index'));
				}else{
					$this->Session->setFlash(__('Email template could not be saved. Please, try again.'),'flash_custom_error');
				}
		}
	
		$this->request->data = $this->EmailTemplate->read(null, $id);
			
	}

	
/**
 * admin_delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->EmailTemplate->id = $id;
		if (!$this->EmailTemplate->exists()) {
			$this->Session->setFlash(__('Invalid Email Template.'),'flash_custom_error');
			$this->redirect(array('action' => 'index'));
		}
		if ($this->EmailTemplate->delete()) {
			$this->Session->setFlash(__('Email Template  deleted'),'flash_custom_success');
			$this->redirect(array('action' => 'index'));
		}
		
		$this->Session->setFlash(__('Email Template was not deleted'),'flash_custom_error');
		$this->redirect(array('action' => 'index'));
	}
	
	
	
	
}
