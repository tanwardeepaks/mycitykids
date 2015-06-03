<?php
App::uses('AppModel', 'Model');


/**


 * Category Model


 *


 */


class SolutionHelp extends AppModel {


public $belongsTo = array(
    'Parent'=>array(
       
	   'className'=>'SolutionHelps',
       
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


                'message' => 'SolutionHelps Name is required'


            ),


       ),

	 
	


    );




}


