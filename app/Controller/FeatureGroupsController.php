<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * FeatureGroups Controller
 *
 * @property FeatureGroups $FeatureGroups
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */

class FeatureGroupsController extends AppController {
/**
 * Components
 * @var array
 */ 
	public $components = array('Image','Paginator', 'Session');
	public $uses  = array('Category','FeatureGroup');
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
												'FeatureGroup.name LIKE'=>'%'. $this->params->query['search_criteria'] . '%',
												'Category.name LIKE'=>'%'. $this->params->query['search_criteria'] . '%'
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
				'order' => 'FeatureGroup.name ASC',
				'limit' => 20	
			);
		}else{
		
		$this->paginate = array('order' => 'FeatureGroup.name ASC','limit' => 20);
		
		}
		 
		 $this->set('feature_groups', $this->paginate('FeatureGroup'));
	}



/**
 * add method
 *
 * @return void
 */

	public function add() {
		
		if ($this->request->is(array('post', 'put'))) {
			
			$this->FeatureGroup->set($this->request->data['FeatureGroup']);
			
			$this->FeatureGroup->create();
			
			if ($this->FeatureGroup->save($this->request->data)) {
			
				$this->Session->setFlash(__('The Feature Group has been saved.'),'flash_custom_success');
			
				return $this->redirect(array('action' => 'index'));
			
			} else {
			
				$this->Session->setFlash(__('The Feature Group could not be saved. Please, try again.'),'flash_custom_error');
			
			}
		}
		
		$categories = $this->Category->find('list');
		
		$this->set(compact('categories'));
		
		
		  
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */

	public function edit($id = null) {

		if (!$this->FeatureGroup->exists($id)) {
		
			throw new NotFoundException(__('Invalid FeatureGroup'));
		
		}
		
		$this->FeatureGroup->exists=$id;
		
		if ($this->request->is(array('post', 'put'))) {
		
			$this->FeatureGroup->set($this->request->data['FeatureGroup']);
		
			$this->FeatureGroup->id = $id;
		
			if ($this->FeatureGroup->save($this->request->data)) {
		
				$this->Session->setFlash(__('The Feature Group has been saved.'),'flash_custom_success');
		
				return $this->redirect(array('action' => 'index'));
		
			} else {
		
				$this->Session->setFlash(__('The Feature Group could not be saved. Please, try again.'),'flash_custom_error');
		
			}
		}
		$options = array('conditions' => array('FeatureGroup.' . $this->FeatureGroup->primaryKey => $id));
		$this->request->data = $this->FeatureGroup->find('first', $options);
		$categories = $this->Category->find('list');
		$this->set(compact('categories'));
	}
	
	
	public function getAjaxFeatureGroupList(){
		$this->layout = false;	
		
		if ($this->request->is('ajax')){
			$category_id = $this->request->data['category_id'];
			
			$featureGroups = $this->FeatureGroup->find('list', array(
																	'fields'=>array('id','name'),
																	'conditions'=>array(
																						'FeatureGroup.category_id'=>$category_id
																						)
																	)
													   );
													   
			$this->set(compact('featureGroups'));							   
		}
	}

	
}
