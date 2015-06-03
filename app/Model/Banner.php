<?php
App::uses('AppModel', 'Model');


/**


 * Banner Model


 *


 */


class Banner extends AppModel {





/**


 * Validation rules


 *


 * @var array


 */


	 public $validate = array(


	 'name' => array(


            'required' => array(


                'rule' => array('notEmpty'),


                'message' => 'Banner Name is required'


            ),
		 'checkUnique' => array(
        
		    
			'rule' => array('checkUnique'),
        
		    
			'message' => 'This Banner already exists.'
       	
		
		),


       ),

	 'image' => array(
	 
	 		'rule' => array('chkImageExtension'),
			
            'message' => 'Please Upload Valid Image.',
			
			'allowEmpty' => true
			 
			 
		)
	


    );


public function chkImageExtension() {
      
	   $return = true; 
		
		$data = $this->data["Banner"];
		
		   if($data['image']['name'] != ''){
			   
				$fileData   = pathinfo($data['image']['name']);
			   
				$ext        = $fileData['extension'];
			   
				$allowExtension = array('gif', 'jpeg', 'png', 'jpg');
	
				if(in_array($ext, $allowExtension)) {
			   
					$return = true; 
			   
				} else {
			   
					$return = false;
			   
				}   
			} 
		
        return $return;
    }   


public function checkUnique() {
  
    $condition = array(
  
        "Banner.name" => $this->data["Banner"]["name"]
  
    );
  
    if (isset($this->data["Banner"]["id"])) {
  
        $condition["Banner.id <>"] = $this->data["Banner"]["id"];
  
        //your query will be against id different than this one when 
        //updating 
  
    }
  
    $result = $this->find("count", array("conditions" => $condition));
  	
    return ($result == 0);
}


// using app/Model/Banner.php
// In the following example, do not let a product  be deleted if it
// still contains products.
// A call of $this->Banner->delete($id) from BannersController.php has set
public function beforeDelete($cascade = true) {
		
		/**
		* Code for remove all banner images related this product
		*/
		$banner = $this->find('first',array('fields'=>array('Banner.image'),'conditions'=>array('Banner.id'=>$this->id)));
		
		if(!empty($banner)){
		
			@unlink(WWW_ROOT.'uploads/banner/'.$banner['Banner']['image']);
		
		}

		return true;
		
}


}


