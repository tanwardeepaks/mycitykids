<?php
App::uses('AppModel', 'Model');


/**


 * CameraFeature Model


 *


 */


class CameraFeature extends AppModel {



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


	 'hrz_eff_pix' => array(


            'required' => array(


                'rule' => array('notEmpty'),


                'message' => 'Horizontal effective pixel is required'


            ),
	   ),
	   
	   'min_focal_length' => array(


            'required' => array(


                'rule' => array('notEmpty'),


                'message' => 'Min focal length is required'


            )
       ), 
	   
	  'max_focal_length' => array(


            'required' => array(


                'rule' => array('notEmpty'),


                'message' => 'Max focal length is required'


            )
       )

    );



public function beforeSave($options = array()) {
	
	$chip_width =$this->data[$this->alias]['chip_width'] =  Configure::read('IMAGESIZESENSOR')[$this->data[$this->alias]['image_sensor_size']];
	$hrz_eff_pix = $this->data[$this->alias]['hrz_eff_pix'] =  Configure::read('HEFFECTIVEPIXEL')[$this->data[$this->alias]['hrz_eff_pix']];
	$min_focal_length =$this->data[$this->alias]['min_focal_length'] =  Configure::read('FOCALLENGTH')[$this->data[$this->alias]['min_focal_length']];
	$max_focal_length = $this->data[$this->alias]['max_focal_length'] =  Configure::read('FOCALLENGTH')[$this->data[$this->alias]['max_focal_length']];
	echo $chip_width.'==>'.$hrz_eff_pix.'=>'.$min_focal_length.'==>'.$max_focal_length;die;
	$this->data[$this->alias]['id_min_dist'] =  $this->calDistance($min_focal_length,$hrz_eff_pix,$chip_width,60);
	$this->data[$this->alias]['id_max_dist'] =  $this->calDistance($max_focal_length,$hrz_eff_pix,$chip_width,60);
	$this->data[$this->alias]['id_min_area'] =  $this->calAreaOfPyramid($this->data[$this->alias]['id_min_dist'],$hrz_eff_pix,60);
	$this->data[$this->alias]['id_max_area'] =  $this->calAreaOfPyramid($this->data[$this->alias]['id_max_dist'],$hrz_eff_pix,60);
	
	$this->data[$this->alias]['re_min_dist'] =  $this->calDistance($min_focal_length,$hrz_eff_pix,$chip_width,40);
	$this->data[$this->alias]['re_max_dist'] =  $this->calDistance($max_focal_length,$hrz_eff_pix,$chip_width,40);
	$this->data[$this->alias]['re_min_area'] =  $this->calAreaOfPyramid($this->data[$this->alias]['re_min_dist'],$hrz_eff_pix,40);
	$this->data[$this->alias]['re_max_area'] =  $this->calAreaOfPyramid($this->data[$this->alias]['re_max_dist'],$hrz_eff_pix,40);
	
	$this->data[$this->alias]['de_min_dist'] =  $this->calDistance($min_focal_length,$hrz_eff_pix,$chip_width,20);
	$this->data[$this->alias]['de_max_dist'] =  $this->calDistance($max_focal_length,$hrz_eff_pix,$chip_width,20);
	$this->data[$this->alias]['de_min_area'] =  $this->calAreaOfPyramid($this->data[$this->alias]['de_min_dist'],$hrz_eff_pix,20);
	$this->data[$this->alias]['de_max_area'] =  $this->calAreaOfPyramid($this->data[$this->alias]['de_max_dist'],$hrz_eff_pix,20);
	
	$this->data[$this->alias]['ov_min_dist'] =  $this->calDistance($min_focal_length,$hrz_eff_pix,$chip_width,10);
	$this->data[$this->alias]['ov_max_dist'] =  $this->calDistance($max_focal_length,$hrz_eff_pix,$chip_width,10);
	$this->data[$this->alias]['ov_min_area'] =  $this->calAreaOfPyramid($this->data[$this->alias]['ov_min_dist'],$hrz_eff_pix,10);
	$this->data[$this->alias]['ov_max_area'] =  $this->calAreaOfPyramid($this->data[$this->alias]['ov_max_dist'],$hrz_eff_pix,10);
	
	
   
	return true;
}

private function calDistance($focal_length,$hrz_eff_pix,$chip_width,$value){
		
		
		return  (($focal_length * $hrz_eff_pix)/(($chip_width) * $value));


}


private function calAreaOfPyramid($height,$hrz_eff_pix,$value){
			
			$width = ($hrz_eff_pix)/$value;
			
			$length = ($width*3)/4;
			
			
			$area = ($length*$width)+($length*sqrt(pow($width/2,2)+pow($height,2)))+($width*sqrt(pow($length/2,2)+pow($height,2)));
			
			return $area;
}





}


