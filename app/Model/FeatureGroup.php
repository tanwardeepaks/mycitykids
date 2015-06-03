<?php


App::uses('AppModel', 'Model');


/**


 * FeatureGroup Model


 *


 */


class FeatureGroup extends AppModel {

public $belongsTo = array(
	'Category' => array(
		'className' => 'Category',
		'foreignKey' => 'category_id',
		'conditions' => '',
		'order' => ''
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


                'message' => 'name is required'


            ),
			
	'checkUnique' => array(
        
		    
			'rule' => array('checkUnique'),
        
		    
			'message' => 'This Feature already exists.'
       	
		
		),



       ),


	 'category_id' => array(


            'required' => array(


            'rule' => array('notEmpty'),


            'message' => 'Category is required'


            )


        ),

    );



public function checkUnique() {
  
    $condition = array(
  
        "FeatureGroup.name" => $this->data["FeatureGroup"]["name"],
		"FeatureGroup.category_id" => $this->data["FeatureGroup"]["category_id"]
  
    );
  
    if (isset($this->data["FeatureGroup"]["id"])) {
  
        $condition["FeatureGroup.id <>"] = $this->data["FeatureGroup"]["id"];
  
        //your query will be against id different than this one when 
        //updating 
  
    }
  
    $result = $this->find("count", array("conditions" => $condition));
  	
    return ($result == 0);
} 
	


}


