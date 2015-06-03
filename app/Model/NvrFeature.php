<?php
App::uses('AppModel', 'Model');


/**


 * CameraFeature Model


 *


 */


class NvrFeature extends AppModel {



public $belongsTo = array(
    'Product'=>array(
       
	   'className'=>'Product',
       
	   'foreignKey'=>'product_id'
    
	)
  );



/**


 * Validation rules


 *


 * @var array


 */
 
  public $validate = array(


	 'channel' => array(


            'required' => array(


                'rule' => array('notEmpty'),


                'message' => 'DVR Channel is required'


            ),
	   ),
	   
	   'hard_disk_type' => array(


            'required' => array(


                'rule' => array('notEmpty'),


                'message' => 'Hard disk type is required'


            )
       ),


      'hard_disk' => array(


          'required' => array(


              'rule' => array('notEmpty'),


              'message' => 'Hard disk Size is required'


          )
      )
	   


    );



public function beforeSave($options = array()) {
	

}







}


