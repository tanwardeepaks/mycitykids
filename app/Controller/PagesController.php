<?php 

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**

 * Pages Controller

 *

 * @property Page $Page

 * @property PaginatorComponent $Paginator

 * @property SessionComponent $Session

 */

class PagesController extends AppController {



/**

 * Components

 *

 * @var array

 */

	public $components = array('Paginator', 'Session');

	 public function beforeFilter() {

        parent::beforeFilter();

        $this->Auth->allow('display','getPageContent','getDetails','contact');

    }



	


/**

 * index method
 * This function display the listing of pages and searching pages according to search fields
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
												'Page.name LIKE'=>'%'. $this->params->query['search_criteria'] . '%'
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
				'order' => 'Page.id DESC',
				'limit' => 20	
			);
		}else{
		
		$this->paginate = array('order' => 'Page.id DESC','limit' => 20);
		
		}
		 
		 $this->set('pages', $this->paginate('Page'));

	}



/**

 * view method

 *

 * @throws NotFoundException
 * @param string $id
 * @return void
 * This function display the view	
 * REI Technology Jaipur
 * Rajeev Rathore
 */

	public function view($id = null) {

		if (!$this->Page->exists($id)) {

			throw new NotFoundException(__('Invalid page'));

		}

		$options = array('conditions' => array('Page.' . $this->Page->primaryKey => $id));

		$this->set('page', $this->Page->find('first', $options));

	}



/**

 * add method
 * @return void
 * This function add the pages
 * REI Technology Jaipur
 * Rajeev Rathore
 */

	public function add() {

		if ($this->request->is('post')) {
			
			//set pages slug......................................................
			if($this->data['Page']['slug'] != '')
				$this->request->data['Page']['slug'] = Inflector::slug(strtolower($this->data['Page']['slug']), '-');
			else
				$this->request->data['Page']['slug'] = Inflector::slug(strtolower($this->data['Page']['name']), '-');
				
			$this->Page->create();
			
			if ($this->Page->save($this->request->data)) {

				$this->Session->setFlash(__('The page has been saved.'));

				return $this->redirect(array('action' => 'index'));

			} else {

				$this->Session->setFlash(__('The page could not be saved. Please, try again.'));

			}

		}

	}



/**

 * edit method
 * @throws NotFoundException
 * @param string $id
 * @return void
 * This function edit the pages
 * REI Technology Jaipur
 * Rajeev Rathore
 */ 

	public function edit($id = null) {

		if (!$this->Page->exists($id)) {

			throw new NotFoundException(__('Invalid page'));

		}
		
		
		
		$this->Page->id=$id;

		if ($this->request->is(array('post', 'put'))) {
			
			//set pages slug......................................................
			if($this->data['Page']['slug'] != '')
				$this->request->data['Page']['slug'] = Inflector::slug(strtolower($this->data['Page']['slug']), '-');
			else
				$this->request->data['Page']['slug'] = Inflector::slug(strtolower($this->data['Page']['name']), '-');
				
				
			if ($this->Page->save($this->request->data)) {

				$this->Session->setFlash(__('The page has been saved.'));

				return $this->redirect(array('action' => 'index'));

			} else {

				$this->Session->setFlash(__('The page could not be saved. Please, try again.'));

			}

		} else {

			$options = array('conditions' => array('Page.' . $this->Page->primaryKey => $id));

			$this->request->data = $this->Page->find('first', $options);

		}

	}



/**

 * delete method
 * @throws NotFoundException
 * @param string $id
 * @return void
 * This function delete the pages
 * REI Technology Jaipur
 * Rajeev Rathore
 */

	public function delete($id = null) {

		$this->Page->id = $id;

		if (!$this->Page->exists()) {

			throw new NotFoundException(__('Invalid page'));

		}

		$this->request->onlyAllow('post', 'delete');

		if ($this->Page->delete()) {

			$this->Session->setFlash(__('The page has been deleted.'));

		} else {

			$this->Session->setFlash(__('The page could not be deleted. Please, try again.'));

		}

		return $this->redirect(array('action' => 'index'));

	}
	

	
}

