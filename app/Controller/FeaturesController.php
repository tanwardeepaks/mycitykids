<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Features Controller
 *
 * @property Features $Features
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */

class FeaturesController extends AppController {
/**
 * Components
 * @var array
 */ 
	public $components = array('Image','Paginator', 'Session');
	public $uses  = array('Category','FeatureGroup','Feature','FeatureValue');
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
												'Feature.name LIKE'=>'%'. $this->params->query['search_criteria'] . '%',
												'Category.name LIKE'=>'%'. $this->params->query['search_criteria'] . '%',
												'FeatureGroup.name LIKE'=>'%'. $this->params->query['search_criteria'] . '%'
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
				'order' => 'Feature.name ASC',
				'limit' => 20	
			);
		}else{
		
		$this->paginate = array('order' => 'Feature.name ASC','limit' => 20);
		
		}
		 
		 $this->set('features', $this->paginate('Feature'));
	}



/**
 * add method
 *
 * @return void
 */

	public function add() {
		
		if ($this->request->is(array('post', 'put'))) {
			
			//set feature slug......................................................
			if($this->data['Feature']['slug'] != ''){
				
				$this->request->data['Feature']['slug'] = Inflector::slug(strtolower($this->data['Feature']['slug']), '-');
				
			
			}else{
			
				$this->request->data['Feature']['slug'] = Inflector::slug(strtolower($this->data['Feature']['name']), '-');
			
			}
			$this->Feature->set($this->request->data['Feature']);
			
			$this->Feature->create();
			
			if ($this->Feature->save($this->request->data)) {
			
				$this->Session->setFlash(__('The Feature has been saved.'),'flash_custom_success');
			
				return $this->redirect(array('action' => 'index'));
			
			} else {
			
				$this->Session->setFlash(__('The Feature could not be saved. Please, try again.'),'flash_custom_error');
			
			}
		}
		
		$categories = $this->Feature->Category->find('list');
		
		$featuregroups = $this->Feature->FeatureGroup->find('list');
		
		$this->set(compact('categories','featuregroups'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */

	public function edit($id = null) {

		if (!$this->Feature->exists($id)) {
			throw new NotFoundException(__('Invalid Feature'));
		}
	
		$this->Feature->exists=$id;
	
		if ($this->request->is(array('post', 'put'))) {
			
			//set feature slug......................................................
			if($this->data['Feature']['slug'] != ''){
				
				$this->request->data['Feature']['slug'] = Inflector::slug(strtolower($this->data['Feature']['slug']), '-');
				
			
			}else{
			
				$this->request->data['Feature']['slug'] = Inflector::slug(strtolower($this->data['Feature']['name']), '-');
			
			}
			$this->Feature->set($this->request->data['Feature']);
			
			$this->Feature->id = $id;
			
			if ($this->Feature->save($this->request->data)) {
			
				$this->Session->setFlash(__('The Feature has been updated.'),'flash_custom_success');
			
				return $this->redirect(array('action' => 'index'));
			
			} else {
			
				$this->Session->setFlash(__('The Feature could not be updated. Please, try again.'),'flash_custom_error');
			
			}
		}
		
		$options = array('conditions' => array('Feature.' . $this->Feature->primaryKey => $id));
		
		$this->request->data = $this->Feature->find('first', $options);
		
		$categories = $this->Feature->Category->find('list');
		
		$featuregroups = $this->Feature->FeatureGroup->find('list');
		
		$this->set(compact('categories','featuregroups'));
	}


/**

 * delete method

 *

 * @throws NotFoundException

 * @param string $id

 * @return void

 */

	public function delete($id = null) {

		$this->Feature->id = $id;

		if (!$this->Feature->exists()) {

			throw new NotFoundException(__('Invalid feature'));

		}

		$this->request->onlyAllow('post', 'delete');

		if ($this->Feature->deleteAll(array('Feature.id' => $id), true)) {

			$this->Session->setFlash(__('The feature has been deleted.'));

		} else {

			$this->Session->setFlash(__('The feature could not be deleted. Please, try again.'));

		}

		return $this->redirect(array('action' => 'index'));

	}
	

/**
 * addFeatureValues method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */

	public function addFeatureValues($id = null) {

		if (!$this->Feature->exists($id)) {
			throw new NotFoundException(__('Invalid Feature'));
		}
	
		$this->Feature->exists=$id;
	
		if ($this->request->is(array('post', 'put'))) {
				$featureValueArr=array();
				$i = 0;
				foreach($this->request->data['FeatureValue']['value'] as $value){
				
					$featureValueArr[$i]['FeatureValue']['feature_id'] = $id;
					$featureValueArr[$i]['FeatureValue']['value'] = $value;
				
				$i++;
				}
				
				if(!empty($featureValueArr)){
					$this->FeatureValue->saveAll($featureValueArr, array('deep' => true));
					$this->Session->setFlash(__('Feature values been inserted successfully.'),'flash_custom_success');
					return $this->redirect(array('action' => 'addFeatureValues',$id));
				}
		}
		
		$options = array('fields'=>array('id','name'),'conditions' => array('Feature.' . $this->Feature->primaryKey => $id));
		
		$this->Feature->bindModel(array('hasMany'=>array('FeatureValue')));
		
		$this->request->data = $this->Feature->find('first', $options);
		
		//pr($this->request->data);die;
		
		
	}
	
	public function removeAjaxFeatureValue(){
		$this->autoRender = false;
		
		if ($this->request->is('ajax')){
			$this->FeatureValue->id = $this->request->data['feature_value_id'];
			
			if ($this->FeatureValue->delete()) {
				echo 'suceess';
			}			   
		}
	}
	
	
	
	public function angular(){
		
		
	
	}
	
	public function getFeatureList(){
		$this->autoRender = false;
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json; charset=UTF-8");
		
		$featureList = $this->Feature->find('all');
		
		echo (json_encode($featureList));
	}
	
}
