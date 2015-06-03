<?php
App::uses('AppModel', 'Model');


/**


 * Brand Model


 *


 */


class Brand extends AppModel {





/**


 * Validation rules


 *


 * @var array


 */


	 public $validate = array(


	 'name' => array(


            'required' => array(


                'rule' => array('notEmpty'),


                'message' => 'Brand Name is required'


            ),
		 'checkUnique' => array(
        
		    
			'rule' => array('checkUnique'),
        
		    
			'message' => 'This Brand already exists.'
       	
		
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
		
		$data = $this->data["Brand"];
		
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
  
        "Brand.name" => $this->data["Brand"]["name"]
  
    );
  
    if (isset($this->data["Brand"]["id"])) {
  
        $condition["Brand.id <>"] = $this->data["Brand"]["id"];
  
        //your query will be against id different than this one when 
        //updating 
  
    }
  
    $result = $this->find("count", array("conditions" => $condition));
  	
    return ($result == 0);
}

}


