<?php


App::uses('AppModel', 'Model');


/**


 * Feature Model


 *


 */


class Feature extends AppModel {

public $belongsTo = array(
	'Category' => array(
		'className' => 'Category',
		'foreignKey' => 'category_id',
		'conditions' => '',
		'order' => ''
	),
	'FeatureGroup' => array(
		'className' => 'FeatureGroup',
		'foreignKey' => 'feature_group_id',
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
	
	 'feature_group_id' => array(


            'required' => array(


            'rule' => array('notEmpty'),


            'message' => 'Feature Group is required'


            )


        ),
	
    );




	

	
public function checkUnique() {
  
    $condition = array(
  
        "Feature.name" => $this->data["Feature"]["name"],
		"Feature.category_id" => $this->data["Feature"]["category_id"]
  
    );
  
    if (isset($this->data["Feature"]["id"])) {
  
        $condition["Feature.id <>"] = $this->data["Feature"]["id"];
  
        //your query will be against id different than this one when 
        //updating 
  
    }
  
    $result = $this->find("count", array("conditions" => $condition));
  	
    return ($result == 0);
} 

	





}


