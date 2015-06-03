<?php
App::uses('AppModel', 'Model');


/**


 * Blog Model


 *


 */


class Blog extends AppModel {






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



       ),

	 'image' => array(
	 
	 		'rule' => array('chkImageExtension'),
			
            'message' => 'Please Upload Valid Image.',
			
			'allowEmpty' => true
			 
			 
		)
	


    );


public function chkImageExtension() {
      
	   $return = true; 
		
		$data = $this->data["Blog"];
		
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







}


