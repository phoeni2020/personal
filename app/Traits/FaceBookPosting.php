<?php


namespace App\Traits;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\HttpClients\FacebookCurl;
use Illuminate\Support\Facades\Http;
use facebook;

trait FaceBookPosting
{
     public function posting($post){
         try {
             $imgarr = ['https://upload.wikimedia.org/wikipedia/commons/thumb/f/fe/Flag_of_Egypt.svg/1200px-Flag_of_Egypt.svg.png','data:image/png;base64,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'];
                 $fp = New \Facebook\Facebook([
                     'app_id' => config('app.fb_app_token'),
                     'app_secret' => config('app.fb_secret_token'),
                     'default_graph_version' => 'v2.10']);
                 // Returns a `FacebookFacebookResponse` object
                 $response = $fp->post(
                     '/'.config('app.fb_page_id').'/feed',
                     array (
                         //'url'=>$img,
                         'message' => $post,
                     ),
                     config('app.fb_token')
                 );
         }
         catch(FacebookResponseException $e) {
             echo 'Graph returned an error: ' . $e->getMessage();
             exit;
         }
         catch(FacebookSDKException $e) {
             echo 'Facebook SDK returned an error: ' . $e->getMessage();
             exit;
         }
         return $response->getGraphNode();

     }
}
