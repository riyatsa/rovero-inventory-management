<?php
/**
 * 
 */
use Zend\Barcode\Barcode;
class Test extends CI_Controller
{
	
function index(){
	$data['render'] = $this->render();
	$this->load->view('test/test',$data);
}


    public function render() {
        $temp = rand(10000, 99999);

// Only the text to draw is required
$barcodeOptions = array('text' => $temp);

// No required options
$rendererOptions = array();

// Draw the barcode in a new image,
// send the headers and the image
/*$render = Barcode::factory(
    'code128', 'image', $barcodeOptions,$rendererOptions
)->drow();


return $render;*/
$file = Barcode::draw('code128', 'image', array('text' => $temp), array());
   $code = time().$temp;
   $store_image = imagepng($file,"../uploads/barcode/{$temp}.png");
   return $temp.'.png';
    }
 

}