<?php
App::uses('AppModel', 'Model');


/**


 * Category Model


 *


 */


class Category extends AppModel {


public $belongsTo = array(
    'Parent'=>array(
       
	   'className'=>'Category',
       
	   'foreignKey'=>'parent_id',
	   
	   'fields'    => 'id,name',
    
	)
  );



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
		
		$data = $this->data["Category"];
		
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
  //pr($this->data["Category"]);die;
    $condition = array(
  
        "Category.name" => $this->data["Category"]["name"],
		"Category.parent_id" => $this->data["Category"]["parent_id"]
  
    );
   // pr($condition);die;
    if (isset($this->data["Category"]["id"])) {
  
        $condition["Category.id <>"] = $this->data["Category"]["id"];
  
        //your query will be against id different than this one when 
        //updating 
  
    }
  
    $result = $this->find("count", array("conditions" => $condition));
  	
    return ($result == 0);
} 




}


