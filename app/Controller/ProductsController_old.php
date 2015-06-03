<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::uses('Folder', 'Utility');
/**
 * Product Controller
 *
 * @property Product $Product
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */

class ProductsController extends AppController {
/**
 * Components
 * @var array
 */ 
	public $components = array('Image','Paginator', 'Session');
	public $uses = array('Product','Category', 'Brand','User','ProductImage','Feature','FeatureGroup','FeatureValue','ProductFeature','CameraFeature', 'getCameraTypeFroms', 'NvrFeature','DvrFeature');
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
												'Product.name LIKE'=>'%'. $this->params->query['search_criteria'] . '%',
												'Category.name LIKE'=>'%'. $this->params->query['search_criteria'] . '%',
												'Brand.name LIKE'=>'%'. $this->params->query['search_criteria'] . '%'
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
				'recursive' => 1,
				'order' => 'Product.name ASC',
				'limit' => 20	
			);
		}else{
		
		$this->paginate = array('order' => 'Product.name ASC','limit' => 20);
		
		}
		 
		 $this->set('products', $this->paginate('Product'));
		
			
	}

/**
 * add method
 *
 * @return void
 */

	public function add() {
		
		if ($this->request->is('post') || $this->request->is('put')) {


			$this->Product->set($this->request->data['Product']);
			
			if ($this->Product->validates()) {
					
					$uploaddir = 'uploads/product/';
					
					$fileArr = $this->request->data['Product']['image'];
				
					$filename = ''; 
					if(is_uploaded_file($fileArr['tmp_name'])){
						
						if($fileArr['name']!=''){ 
						
							$filename = $this->Image->upload_image($fileArr['name'],$fileArr['tmp_name'],$uploaddir);
						
							$this->Image->resize_image($uploaddir.$filename,150,100,$uploaddir.'150x100/'.$filename);
						
							$this->Image->resize_image($uploaddir.$filename,600,400,$uploaddir.'600x400/'.$filename);
							
							
						}
					
					}
					
					$this->request->data['Product']['image'] = $filename;
					
					$this->Product->create();
					
					if($this->Product->save($this->request->data,false)){
						
						$product_id = $this->Product->id;
						$this->uploadProductImages($product_id,$uploaddir);



						$this->Session->setFlash(__('The product has been saved.'),'flash_custom_success');

                        if($this->request->data['Product']['category_id'] != 20 && $this->request->data['Product']['category_id'] != 16){
                            if(Configure::read('ProductExtraFeatureLayout.'.$this->request->data['Product']['category_id']) == 'camera_feature'){

                                return $this->redirect(array('action' => 'cameraFeature',$product_id));

                            }else{
                                return $this->redirect(array('admin' =>false,'controller' => 'products','action'=>'addProductFeature',$product_id));

                        }
                        }

                        // if product category is NVR
                        if($this->request->data['Product']['category_id'] == 20) {

                            return $this->redirect(array('action' => 'nvrFeature',$this->Product->id));
                        }


                        if($this->request->data['Product']['category_id'] == 16) {

                            return $this->redirect(array('action' => 'dvrFeature',$this->Product->id));
                        }



						
					
					}else{
					
					
						$this->Session->setFlash(__('The product could not be saved. Please, try again.'),'flash_custom_error');
					
					}
					
					return $this->redirect(array('action' => 'index'));
				
				
			}else{
				$this->Session->setFlash(__('The product could not be saved. Please, try again.'),'flash_custom_error');
			}
			
		}
		
		$categories = $this->Category->find('list');
		
		$brands = $this->Brand->find('list');
		
		$this->set(compact('categories','brands'));
	}
	

// get camera type form example analog or Ip cameras
public function getCameraTypeFroms() {


   $cameraTypeValues = $this->CameraFeature->find('first', array('fields' => array('id', 'hard_disk','camera_type'),'conditions' => array('CameraFeature.id' => $this->data['cameraFeatureId'])));

    $this->set(compact('cameraTypeValues'));
}


/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */

	public function edit($id = null) {
		
		if (!$this->Product->exists($id)) {
		
			throw new NotFoundException(__('Invalid Product'));
		
		}
		
		$this->Product->bindModel(array('hasMany'=>array('ProductImage')));
		
		$this->Product->exists=$id;
		
		if ($this->request->is(array('post', 'put'))) {
			
			$this->Product->set($this->request->data['Product']);
		
			if ($this->Product->validates()) {
				
				$uploaddir = 'uploads/product/';
		
				$fileArr = $this->request->data['Product']['image'];
		
				$filename = ''; 
				
				if($this->request->data['Product']['image']['name'] != ''){
		
					if(is_uploaded_file($fileArr['tmp_name'])){
		
						if($fileArr['name']!=''){ 
						
							$filename = $this->Image->upload_image($fileArr['name'],$fileArr['tmp_name'],$uploaddir);
						
							$this->Image->resize_image($uploaddir.$filename,150,100,$uploaddir.'150x100/'.$filename);
						
							$this->Image->resize_image($uploaddir.$filename,600,400,$uploaddir.'600x400/'.$filename);
							
						}
					
					}
					
					$this->request->data['Product']['image'] = $filename;
		
					unset($this->request->data['Product']['old_image']);
		
				}else{
		
					$this->request->data['Product']['image'] =$this->request->data['Product']['old_image'];
		
					unset($this->request->data['Product']['old_image']);
		
				}
					
					
					if($this->Product->save($this->request->data,false)){
						
						$this->uploadProductImages($id,$uploaddir);
						
						$this->Session->setFlash(__('The product has been saved.'),'flash_custom_success');


                        /// if category is not NVR
                        if($this->request->data['Product']['category_id'] != 20 && $this->request->data['Product']['category_id'] != 16){
                            if(Configure::read('ProductExtraFeatureLayout.'.$this->request->data['Product']['category_id']) == 'camera_feature'){

                                return $this->redirect(array('action' => 'cameraFeature',$this->Product->id));

                            }else{

                                return $this->redirect(array('admin' =>false,'controller' => 'products','action'=>'addProductFeature',$this->Product->id));

                            }
                        }

                        // if product category is NVR
                        if($this->request->data['Product']['category_id'] == 20) {

                            return $this->redirect(array('action' => 'nvrFeature',$this->Product->id));
                        }


                        if($this->request->data['Product']['category_id'] == 16) {

                            return $this->redirect(array('action' => 'dvrFeature',$this->Product->id));
                        }
					
					}else{
					
					
						$this->Session->setFlash(__('The product could not be saved. Please, try again.'),'flash_custom_error');
					
					}
					
				
				
			}else{
				$this->Session->setFlash(__('The product could not be saved. Please, try again.'),'flash_custom_error');
			}
		} 
		
		$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
		$this->request->data = $this->Product->find('first', $options);
		$this->request->data['Product']['old_image'] = $this->request->data['Product']['image']; 
		//pr($this->request->data);die;
		$categories = $this->Category->find('list');
		
		$brands = $this->Brand->find('list');
		
		$this->set(compact('categories','brands'));
	}


    /**
     * cameraFeature method
     *
     * @return void
     */
    public function cameraFeature($id = null){


        if (!$this->Product->exists($id)) {

            throw new NotFoundException(__('Invalid Product'));

        }

        if ($this->request->is('post') || $this->request->is('put')) {

            // pr($this->request->data); die;

            $this->CameraFeature->set($this->request->data['CameraFeature']);

            if ($this->CameraFeature->validates()) {

                if($this->CameraFeature->save($this->request->data,false)){

                    $this->Session->setFlash(__('Camera Feature saved successfully.'),'flash_custom_success');

                    return $this->redirect(array('admin' =>false,'controller' => 'products','action'=>'addProductFeature',$this->request->data['CameraFeature']['product_id']));
                }

            }

        }

        $cameraFeature = $this->CameraFeature->find('first',array('conditions'=>array('CameraFeature.product_id'=>$id)));

        //check if camrea feature in update mode..............
        $this->set('requireAction','save');
        if(!empty($cameraFeature)){
            $this->set('requireAction','update');
            $this->request->data = $cameraFeature;

        }else{
            $this->request->data['CameraFeature']['product_id'] = $id;
        }

    }


    /**
     * nvrFeature method
     *
     * @return void
     */
    public function nvrFeature($id = null){

        if (!$this->Product->exists($id)) {

            throw new NotFoundException(__('Invalid Product'));

        }
        $this->loadModel('NvrFeature');
        if ($this->request->is('post') || $this->request->is('put')) {

            // pr($this->request->data); die;

            $this->NvrFeature->set($this->request->data['NvrFeature']);

            if ($this->NvrFeature->validates()) {

                if($this->NvrFeature->save($this->request->data,false)){

                    $this->Session->setFlash(__('NvrFeature saved successfully.'),'flash_custom_success');

                    return $this->redirect(array('admin' =>false,'controller' => 'products','action'=>'addProductFeature',$this->request->data['NvrFeature']['product_id']));
                }

            }

        }

        $cameraFeature = $this->NvrFeature->find('first',array('conditions'=>array('NvrFeature.product_id'=>$id)));

        //check if camrea feature in update mode..............
        $this->set('requireAction','save');
        if(!empty($cameraFeature)){
            $this->set('requireAction','update');
            $this->request->data = $cameraFeature;

        }else{
            $this->request->data['NvrFeature']['product_id'] = $id;
        }

    }



    /**
     * nvrFeature method
     *
     * @return void
     */
    public function dvrFeature($id = null){

        if (!$this->Product->exists($id)) {

            throw new NotFoundException(__('Invalid Product'));

        }
        $this->loadModel('DvrFeature');
        if ($this->request->is('post') || $this->request->is('put')) {

            // pr($this->request->data); die;

            $this->DvrFeature->set($this->request->data['DvrFeature']);

            if ($this->DvrFeature->validates()) {

                if($this->DvrFeature->save($this->request->data,false)){

                    $this->Session->setFlash(__('DvrFeature saved successfully.'),'flash_custom_success');

                    return $this->redirect(array('admin' =>false,'controller' => 'products','action'=>'addProductFeature',$this->request->data['DvrFeature']['product_id']));
                }

            }

        }

        $cameraFeature = $this->DvrFeature->find('first',array('conditions'=>array('DvrFeature.product_id'=>$id)));

        //check if camrea feature in update mode..............
        $this->set('requireAction','save');
        if(!empty($cameraFeature)){
            $this->set('requireAction','update');
            $this->request->data = $cameraFeature;

        }else{
            $this->request->data['DvrFeature']['product_id'] = $id;
        }



    }



/**

 * delete method

 *

 * @throws NotFoundException

 * @param string $id

 * @return void

 */

	public function delete($id = null) {

		$this->Product->id = $id;

		if (!$this->Product->exists()) {

			throw new NotFoundException(__('Invalid product'));

		}

		$this->request->onlyAllow('post', 'delete');

		if ($this->Product->delete(array('Product.id' => $id), true)) {

			$this->Session->setFlash(__('The product has been deleted.'));

		} else {

			$this->Session->setFlash(__('The product could not be deleted. Please, try again.'));

		}

		return $this->redirect(array('action' => 'index'));

	}
	

/**
 * addProductFeature method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */

public function addProductFeature($id = null) {
	
	if (!$this->Product->exists($id)) {
	
		throw new NotFoundException(__('Invalid Product'));
	
	}
	
	$products = $this->Product->find('first',array('conditions'=>array('Product.id'=>$id)));
	
	if ($this->request->is(array('post', 'put'))) {
		
		// Delete with array conditions similar to find()
		$this->ProductFeature->deleteAll(array('ProductFeature.product_id' => $id), false);
		
		$productFeatureValueArr = array();
		$i = 0;
		foreach($this->data['ProductFeature'] as $productKey=>$productFeature){
		
			$getFeatureArr = $this->getFeatureArr($productKey);
			if(is_array($productFeature)){
				foreach($productFeature as $value){
					$productFeatureValueArr[$i]['ProductFeature']['product_id'] = $id;
					$productFeatureValueArr[$i]['ProductFeature']['feature_id'] = $productKey;
					$productFeatureValueArr[$i]['ProductFeature']['feature_value_id'] = $value;
					$productFeatureValueArr[$i]['ProductFeature']['type'] = (!empty($getFeatureArr)?$getFeatureArr['type']:''); 
					$productFeatureValueArr[$i]['ProductFeature']['unit'] = (!empty($getFeatureArr)?$getFeatureArr['unit']:''); 
					$productFeatureValueArr[$i]['ProductFeature']['value'] = $this->getFeatureValueByID($value); 
					$i++;
				}
			}else{
				$productFeatureValueArr[$i]['ProductFeature']['product_id'] = $id;
				$productFeatureValueArr[$i]['ProductFeature']['feature_id'] = $productKey;
				$productFeatureValueArr[$i]['ProductFeature']['feature_value_id'] = (!empty($getFeatureArr)?(($getFeatureArr['type']=='text')?0:$productFeature):'');  
				$productFeatureValueArr[$i]['ProductFeature']['type'] = (!empty($getFeatureArr)?$getFeatureArr['type']:''); 
				$productFeatureValueArr[$i]['ProductFeature']['unit'] = (!empty($getFeatureArr)?$getFeatureArr['unit']:''); 
				$productFeatureValueArr[$i]['ProductFeature']['value'] = (!empty($getFeatureArr)?(($getFeatureArr['type']=='text')?$productFeature:$this->getFeatureValueByID($productFeature)):''); 
				$i++;
			}
			
		}
		//pr($productFeatureValueArr);die;
		if(!empty($productFeatureValueArr)){
				$this->ProductFeature->saveAll($productFeatureValueArr, array('deep' => true));
				$this->Session->setFlash(__('Product Feature been inserted successfully.'),'flash_custom_success');
				return $this->redirect(array('action' => 'addProductFeature',$id));
		}
		
		
	}
	$this->FeatureGroup->unBindModel(array('belongsTo'=>array('Category')));
	$this->FeatureGroup->bindModel(array('hasMany'=>array('Feature')));
	$this->Feature->bindModel(array('hasMany'=>array('FeatureValue')));
	$this->Feature->unBindModel(array('belongsTo'=>array('Category','FeatureGroup')));
	
	$this->FeatureGroup->recursive = 2;
	$productFeatures = $this->FeatureGroup->find('all',array('conditions'=>array('FeatureGroup.category_id'=>$products['Product']['category_id'])));
	
	
	$saveProductFeature = $this->ProductFeature->find('all',array('conditions'=>array('ProductFeature.product_id'=>$id)));
	
	$featureArr = array();

	
	
	foreach($saveProductFeature as $feature){
	
		if($feature['ProductFeature']['type'] == 'multiselect' ){
			$featureArr[$feature['ProductFeature']['feature_id']][]  = $feature['ProductFeature']['feature_value_id'];
		}else if($feature['ProductFeature']['type'] == 'text' ){
			$featureArr[$feature['ProductFeature']['feature_id']]  = $feature['ProductFeature']['value'];
		}else{
			$featureArr[$feature['ProductFeature']['feature_id']]  = $feature['ProductFeature']['feature_value_id'];
		}
		
	}
	
	$this->request->data['ProductFeature'] = $featureArr;
	$this->set(compact('productFeatures'));
	
	//pr($productFeatures);
	//pr($saveProductFeature);die;
	
	
	
}	
	
		
/**
 * removeAjaxProductImage method
 *
 * call by ajax
 * @return void
 */		
public function removeAjaxProductImage(){
		$this->autoRender = false;
		
		if ($this->request->is('ajax')){
		
			$this->ProductImage->id = $this->request->data['id'];
			
			if ($this->ProductImage->delete()) {
				
				echo 'suceess';
			}			   
		}
	}

/**
 * getAjaxProductExtraFeature method
 *
 * call by ajax
 * @return void
 */		
public function getAjaxProductExtraFeature(){
		
		if ($this->request->is('ajax')){
		
			$category_id = $this->request->data['category_id'];
			
			$renderView =  Configure::read('ProductExtraFeatureLayout.'.$category_id);
			
			if($renderView != ''){
				$this->layout = false;
				$this -> render($renderView);
			}else{
				$this->autoRender = false;
				echo 'error';
			}	
			
					   
		}
	
}		
	
/**
 * uploadProductImages method
 *
 * private method
 * @param string $product_id , $uploaddir
 * @return void
 */	
	
private function uploadProductImages($product_id,$uploaddir){
			
			if (($this->request->is('post') || $this->request->is('put')) && isset($this->request->data['ProductImage']) && isset($this->request->data['ProductImage']['image'])){
		
				$imageArr=array();
				$i=0;
				foreach($this->request->data['ProductImage']['image'] as $fileArr){
					if(is_uploaded_file($fileArr['tmp_name'])){
						
							$filename = $this->Image->upload_image($fileArr['name'],$fileArr['tmp_name'],$uploaddir);
						
							$this->Image->resize_image($uploaddir.$filename,150,100,$uploaddir.'150x100/'.$filename);
						
							$this->Image->resize_image($uploaddir.$filename,600,400,$uploaddir.'600x400/'.$filename);
							
							$imageArr[$i]['ProductImage']['product_id'] = $product_id;
							
							$imageArr[$i]['ProductImage']['image'] = $filename;
					
					$i++;
					
					}
				}
				
				if(!empty($imageArr)){
			 	
				 $this->ProductImage->create();
             	
				 $this->ProductImage->saveAll($imageArr);
             	
				}
			}

}


/**
 * getFeatureValueByID method
 *
 * @params id
 * @return feature value if exist
 */		
private function getFeatureValueByID($id){
	
	$featureValues = $this->FeatureValue->find('first',array('conditions'=>array('FeatureValue.id'=>$id)));
	
	return (!empty($featureValues)?$featureValues['FeatureValue']['value']:'');
	
}


/**
 * getFeatureType method
 *
 * @params id
 * @return feature value if exist
 */		
private function getFeatureArr($id){
	
	$feature = $this->Feature->find('first',array('conditions'=>array('Feature.id'=>$id)));
	
	return (!empty($feature)?$feature['Feature']:'');
	
}





	
}
