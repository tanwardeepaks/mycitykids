<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * User Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */

class UsersController extends AppController {
/**
 * Components
 * @var array
 */ 
	public $components = array('Image','Paginator', 'Session');
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('login');
	}



/**
 * login method
 *
 * @return void
 */
	public function login() {
		$this->layout = 'login';
		if($this->Session->read('Auth.User')!="" ){
			$this->redirect(array('controller'=>'dashboards', 'action'=>'index'));
		} 
		if(!empty($this->request->data)){
			if($this->Session->check('Auth.User.User.id')){
				$this->Session->destroy();
			}
			$username = $this->request->data['User']['email'];
			$password = AuthComponent::password($this->request->data['User']['password']);			
			$this->User->recursive = -1;
			$record = $this->User->find('first',array(
										 
										 'conditions'=>array(
										 					'User.email'=>$username,
															'User.password'=>$password,
															'User.role_id'=>array(1,3),
															'User.status'=>1
															)
													)
									    );	
		   if(!empty($record)){
				if($this->Auth->login($record)){					
					$this->Session->setFlash(__('Login successfully'),'flash_custom_success');
					$this->redirect(array('controller'=>'dashboards','action'=>'index'));
				}else{
					$this->Session->setFlash(__('The username / password credentials are incorrect. Please try again.'),'flash_custom_error');
				}
			}else{
				$this->Session->setFlash(__('The username / password credentials are incorrect. Please try again.'),'flash_custom_error');
			}
		}
		$this->set('title_for_layout','Admin Login');
	}


/**
* logout function for  admin panel
* 
*/

	public function logout () {
		if($this->Session->check('Auth.User')){
			$this->Session->setFlash('', null, null, 'auth');
			$this->Session->delete('Auth.User');
		}
		$this->Session->setFlash(__('Logout Successfully. Please try again.'),'flash_custom_success');
		$this->redirect($this->Auth->logout());
	}	



/**
 * index method
 *
 * @return void
 */

	public function index() {
		
		$this->User->bindModel(array('belongsTo'=>array('Role')));
		$this->User->recursive = 0;
		$this->paginate = array(

				'limit' => 10	

			);
			
	
		$this->set('users', $this->Paginator->paginate());
	}


/**
 * add method
 *
 * @return void
 */

	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}

		$this->User->bindModel(array('belongsTo'=>array('Role')));
		$roles = $this->User->Role->find('list',array('fields'=>array('id','role'),'conditions'=>array('Role.role !='=>array('User','Seller'))));
		
		$this->set(compact('roles'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */

	public function edit($id = null) {
		
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->User->exists=$id;
		if ($this->request->is(array('post', 'put'))) {
			if($this->request->data['User']['password']==''){
				unset($this->request->data['User']['password']);
				unset($this->request->data['User']['cpassword']);
			}
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}

		$this->User->bindModel(array('belongsTo'=>array('Role')));
		$roles = $this->User->Role->find('list',array('fields'=>array('id','role')));
		$this->set(compact('roles'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */

	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}

		return $this->redirect(array('action' => 'index'));
	}
	

	
	
}
