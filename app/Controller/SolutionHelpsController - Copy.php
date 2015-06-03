<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * SolutionHelps Controller
 *
 * @property SolutionHelps $solutionHelps
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */

class SolutionHelpsController extends AppController {
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
												'SolutionHelp.name LIKE'=>'%'. $this->params->query['search_criteria'] . '%'
											  )
									);
		
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
				'order' => 'SolutionHelp.name ASC',
				'limit' => 20	
			);
		}else{
		
		$this->paginate = array('order' => 'SolutionHelp.name ASC','limit' => 20);
		
		}
		 
		 $this->set('solutionHelps', $this->paginate('SolutionHelp'));
		
			
	}



/**
 * add method
 *
 * @return void
 */

	public function add() {
			
		//pr($this->request->data); die;
		if ($this->request->is('post')) {
			
			
			if($this->data['SolutionHelp']['parent_id'] == '')					
				$this->request->data['SolutionHelp']['parent_id'] = 0;
			//set pages slug......................................................
			if($this->data['SolutionHelp']['slug'] != '')
				$this->request->data['SolutionHelp']['slug'] = Inflector::slug(strtolower($this->data['SolutionHelp']['slug']), '-');
			else
				$this->request->data['SolutionHelp']['slug'] = Inflector::slug(strtolower($this->data['SolutionHelp']['name']), '-');
				
			$this->SolutionHelp->create();
			
			if ($this->SolutionHelp->save($this->request->data)) {

				$this->Session->setFlash(__('The SolutionHelp has been saved.'),'flash_custom_success');

				return $this->redirect(array('action' => 'index'));

			} else {

				$this->Session->setFlash(__('The SolutionHelp could not be saved. Please, try again.'),'flash_custom_error');

			}

		}

		$pcat = $this->SolutionHelp->find('list',array('conditions'=>array('SolutionHelp.parent_id'=>0)));
		
		//pr($pcat); die;
		$this->set(compact('pcat'));
		}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */

	public function edit($id = null) {
			
			

		if (!$this->SolutionHelp->exists($id)) {

			throw new NotFoundException(__('Invalid SolutionHelp'));

		}
		
		
		
		$this->SolutionHelp->id=$id;

		if ($this->request->is(array('post', 'put'))) {
			
			if($this->data['SolutionHelp']['parent_id'] == '')					
				$this->request->data['SolutionHelp']['parent_id'] = 0;
						
			//set pages slug......................................................
			if($this->data['SolutionHelp']['slug'] != '')
				$this->request->data['SolutionHelp']['slug'] = Inflector::slug(strtolower($this->data['SolutionHelp']['slug']), '-');
			else
				$this->request->data['SolutionHelp']['slug'] = Inflector::slug(strtolower($this->data['SolutionHelp']['name']), '-');
				
				
			if ($this->SolutionHelp->save($this->request->data)) {

				$this->Session->setFlash(__('The SolutionHelp has been saved.'),'flash_custom_success');

				return $this->redirect(array('action' => 'index'));

			} else {

				$this->Session->setFlash(__('The SolutionHelp could not be saved. Please, try again.'),'flash_custom_error');

			}

		} else {

			$options = array('conditions' => array('SolutionHelp.' . $this->SolutionHelp->primaryKey => $id));

			$this->request->data = $this->SolutionHelp->find('first', $options);

		}

		$pcat = $this->SolutionHelp->find('list');
		
		$this->set(compact('pcat'));
		
		}
		


/**

 * delete method

 *

 * @throws NotFoundException

 * @param string $id

 * @return void

 */

	public function delete($id = null) {

		$this->SolutionHelp->id = $id;

		if (!$this->SolutionHelp->exists()) {

			throw new NotFoundException(__('Invalid SolutionHelp'));

		}

		$this->request->onlyAllow('post', 'delete');

		if ($this->SolutionHelp->delete()) {

			$this->Session->setFlash(__('The SolutionHelp has been deleted.'),'flash_custom_success');

		} else {

			$this->Session->setFlash(__('The SolutionHelp could not be deleted. Please, try again.'),'flash_custom_error');

		}

		return $this->redirect(array('action' => 'index'));

	}

	
}
