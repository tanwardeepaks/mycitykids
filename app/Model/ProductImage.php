<?php
App::uses('AppModel', 'Model');


/**


 * ProductImage Model


 *


 */


class ProductImage extends AppModel {



// using app/Model/ProductImage.php
// In the following example, do not let a product  be deleted if it
// still contains products.
// A call of $this->ProductImage->delete($id) from ProductsController.php has set
public function beforeDelete($cascade = true) {
		
		$productImage = $this->find('first',array('fields'=>array('ProductImage.image'),'conditions'=>array('ProductImage.id'=>$this->id)));
		
		if(!empty($productImage)){
		
			@unlink(WWW_ROOT.'uploads/product/'.$productImage['Product']['image']);
		
			@unlink(WWW_ROOT.'uploads/product/150x100/'.$productImage['Product']['image']);
		
			@unlink(WWW_ROOT.'uploads/product/600x400/'.$productImage['Product']['image']);
		
		}
		
		return true;
}


}


