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


  function test1() {
    $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://mxtakatakvideodownloader.com/tiktok-service.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS  => ["url"=>"https://v.mxtakatak.com/vQZT/b3845979"], 
        )); 
         $response = curl_exec($curl);
        echo json_encode($response);
        $curl_response_data = json_decode($response,true);
        echo $curl_response_data['name'];
        echo $curl_response_data['profile_pic_url'][0];
        // print_r($curl_response_data);
  }


  function short(){
        $new = [
              [
                'hashtag' => 'a7e87329b5eab8578f4f1098a152d6f4',
                'title' => 'Flower',
                'order' => 3,
              ],

              [
                'hashtag' => 'b24ce0cd392a5b0b8dedc66c25213594',
                'title' => 'Free',
                'order' => 2,
              ],

              [
                'hashtag' => 'e7d31fc0602fb2ede144d18cdffd816b',
                'title' => 'Ready',
                'order' => 1,
              ],
    ];

    $keys = array_column($new, 'order');

    array_multisort($keys, SORT_DESC, $new);

    echo json_encode($new);

    // var_dump($new);
  }
 

}