<?php
App::uses('AppModel', 'Model');


/**


 * Notification Model


 *


 */


class Notification extends AppModel {




/**


 * Validation rules


 *


 * @var array


 */


	 public $validate = array(


	 'name' => array(


            'required' => array(


                'rule' => array('notEmpty'),


                'message' => 'Category Name is required'


            ),
	 'checkUnique' => array(
        
		    
			'rule' => array('checkUnique'),
        
		    
			'message' => 'This Category already exists.'
       	
		
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
		
		$data = $this->data["Notification"];
		
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
  
        "Notification.name" => $this->data["Notification"]["name"]
  
    );
  
    if (isset($this->data["Notification"]["id"])) {
  
        $condition["Notification.id <>"] = $this->data["Notification"]["id"];
  
  
    }
  
    $result = $this->find("count", array("conditions" => $condition));
  	
    return ($result == 0);
} 




}


