<?php


App::uses('AppModel', 'Model');


/**


 * User Model


 *


 */


class User extends AppModel {

public $belongsTo = array(
	'Role' => array(
		'className' => 'Role',
		'foreignKey' => 'role_id',
		'conditions' => '',
		'order' => ''
	)
);
	public $virtualFields = array(
			'name' => 'CONCAT(User.firstname, " ", User.lastname)'
		);


/**


 * Validation rules


 *


 * @var array


 */


	 public $validate = array(


	 'firstname' => array(


            'required' => array(


                'rule' => array('notEmpty'),


                'message' => 'First name is required'


            )


       ),


	 'lastname' => array(


            'required' => array(


            'rule' => array('notEmpty'),


            'message' => 'Last name is required'


            )


        ),





	 'email' => array(


			'email' => array(


			'rule' => array('email'),


			'message' => 'Please enter valid email',


				//'message' => 'Your custom message here',


				//'allowEmpty' => false,


				//'required' => false,


				//'last' => false, // Stop validation after this rule


				//'on' => 'create', // Limit validation to 'create' or 'update' operations


			),


			'unique'=>array(


            'rule'=>array('isUnique', 'email'),


            'message' => 'This Email has already been taken.'


                    ) 


       


		),


        'password' => array(


            'required' => array(


                'rule' => array('notEmpty'),


                'message' => 'Password is required',
				

            )


        ),'cpassword' => array (


				'notempty'  =>  array (


					'rule' 		=>	'notEmpty',


					'required' 	=>	false,
					

					'message' 	=>	'Please re-enter password.',
					
	
				),


				'match_passwds' =>	array (


					'rule' 		=>	'matchPasswds',


					'required' 	=>	false,


					'message' 	=>	'New password and confirm password does not match.',


				)


			)

    );




	


		


   public function beforeSave($options = array()) {


   


    if (isset($this->data[$this->alias]['password'])) {


        $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);


    }


	return true;


	}


	


	function matchPasswds() {


		


		$data	= 	$this->data;


		


		return $data[$this->alias]['password'] == $data[$this->alias]['cpassword'];


		


	}


	


	





}


