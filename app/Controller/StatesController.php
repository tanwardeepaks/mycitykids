<?php

App::uses('AppController', 'Controller');

/**

 * Dashboard Controller

 *

 * @property Dashboard $Dashboard

 * @property PaginatorComponent $Paginator

 * @property SessionComponent $Session

 */

class StatesController extends AppController {



/**

 * Components

 *

 * @var array

 */

	public $components = array('Paginator', 'Session');



/**

 * index method

 *

 * @return void

 */

	public function index() {

		//$this->User->bindModel(array('belongsTo'=>array('Role')));
		//$this->User->recursive = 0;
		$this->paginate = array(

				'limit' => 10	

			);
			
	
		$this->set('states', $this->Paginator->paginate());

	}
	
		public function add() {
		if ($this->request->is('post')) {
			$this->State->create();
			if ($this->State->save($this->request->data)) {
				$this->Session->setFlash(__('The state has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The state could not be saved. Please, try again.'));
			}
		}

		//$this->State->bindModel(array('belongsTo'=>array('Role')));
		//$roles = $this->State->Role->find('list',array('fields'=>array('id','role'),'conditions'=>array('Role.role !='=>array('State','Seller'))));
		
		//$this->set(compact('roles'));
	}

public function edit($id = null) {
		
		if (!$this->State->exists($id)) {
			throw new NotFoundException(__('Invalid state'));
		}
		$this->State->exists=$id;
		if ($this->request->is(array('post', 'put'))) {
			/*if($this->request->data['State']['password']==''){
				unset($this->request->data['User']['password']);
				unset($this->request->data['User']['cpassword']);
			}*/
			if ($this->State->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('State.' . $this->State->primaryKey => $id));
			$this->request->data = $this->State->find('first', $options);
		}

		//$this->User->bindModel(array('belongsTo'=>array('Role')));
		//$roles = $this->User->Role->find('list',array('fields'=>array('id','role')));
		//$this->set(compact('roles'));
	}

	



}

