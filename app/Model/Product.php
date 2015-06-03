<?php
App::uses('AppModel', 'Model');


/**


 * Product Model


 *


 */


class Product extends AppModel {



public $belongsTo = array(
    'Category'=>array(
       
	   'className'=>'Category',
       
	   'foreignKey'=>'category_id'
    
	),
	
	 'Brand'=>array(
       
	   'className'=>'Brand',
       
	   'foreignKey'=>'brand_id'
    
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


                'message' => 'Product name is required'


            ),
	 'checkUnique' => array(
        
		    
			'rule' => array('checkUnique'),
        
		    
			'message' => 'Product name already exists.'
       	
		
		),


       ),
	   
	   'brand_id' => array(


            'required' => array(


                'rule' => array('notEmpty'),


                'message' => 'Brand is required'


            )
       ), 
	   
	  'category_id' => array(


            'required' => array(


                'rule' => array('notEmpty'),


                'message' => 'Category is required'


            )
       ), 
	   
	  'model' => array(


            'required' => array(


                'rule' => array('notEmpty'),


                'message' => 'Model number is required'


            )
       ),
		
	'price' => array(
		
		 'required' => array(


                'rule' => array('notEmpty'),


                'message' => 'Price is required'


            ),
		
		'numeric' =>array(
			
			 'rule' => 'numeric',
		
			'message' => 'Please enter a valid price.'
		
		)	
	
       
    
	), 
	   
	  'description' => array(


            'required' => array(


                'rule' => array('notEmpty'),


                'message' => 'Product description is required'


            )
       ), 

	 'image' => array(
        
		'rule' => array('chkImageExtension'),
        
		'message' => 'Please supply a valid image.',
			
		'allowEmpty' => true
		
    )
		
	


    );


 


public function checkUnique() {
  
    $condition = array(
  
        "Product.name" => $this->data["Product"]["name"]
  
    );
  
    if (isset($this->data["Product"]["id"])) {
  
        $condition["Product.id <>"] = $this->data["Product"]["id"];
  
        //your query will be against id different than this one when 
        //updating 
  
    }
  
    $result = $this->find("count", array("conditions" => $condition));
  	
    return ($result == 0);
} 



 public function beforeSave($options = array()) {

    if (!empty($this->data[$this->alias]['slug'])) {
		$this->data[$this->alias]['slug'] = Inflector::slug(strtolower($this->data[$this->alias]['slug']), '-');
    }else{
		$this->data[$this->alias]['slug'] = Inflector::slug(strtolower($this->data[$this->alias]['name']), '-');
	}
	return true;
}


// using app/Model/Product.php
// In the following example, do not let a product  be deleted if it
// still contains products.
// A call of $this->Product->delete($id) from ProductsController.php has set
public function beforeDelete($cascade = true) {
		
		/**
		* Code for remove all product images related this product
		*/
		$product = $this->find('first',array('fields'=>array('Product.image'),'conditions'=>array('Product.id'=>$this->id)));
		
		if(!empty($product)){
		
			@unlink(WWW_ROOT.'uploads/product/'.$product['Product']['image']);
		
			@unlink(WWW_ROOT.'uploads/product/150x100/'.$product['Product']['image']);
		
			@unlink(WWW_ROOT.'uploads/product/600x400/'.$product['Product']['image']);
		
		}
		
		$productImage = ClassRegistry::init('ProductImage')->find('all',array('fields'=>array('ProductImage.image'),'conditions'=>array('ProductImage.product_id'=>$this->id)));
		
		foreach($productImage as $image){
		
			@unlink(WWW_ROOT.'uploads/product/'.$image['ProductImage']['image']);
		
			@unlink(WWW_ROOT.'uploads/product/150x100/'.$image['ProductImage']['image']);
		
			@unlink(WWW_ROOT.'uploads/product/600x400/'.$image['ProductImage']['image']);
		}
		
		
		return true;
		
}

public function chkImageExtension($data) {
       $return = true; 

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


