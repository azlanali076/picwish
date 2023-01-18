<?php
namespace Azlanali076\Picwish;

use Azlanali076\Picwish\Models\PicwishScale;
use Azlanali076\Picwish\Models\PicwishScaleAsyncResponse;
use Azlanali076\Picwish\Models\PicwishScaleErrorResponse;
use Azlanali076\Picwish\Models\PicwishScalePollResult;
use Azlanali076\Picwish\Models\PicwishScaleSuccessResponse;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Picwish {

    private string $baseUrl = 'https://techhk.aoscdn.com/api';
    private string $scaleEndpoint = '/tasks/visual/scale';
    private ?string $apiKey = null;
    private array $headers = [
        'Accept' => 'application/json'
    ];

    public function __construct(){
        $this->apiKey = config('picwish.api_key');
        $this->headers['X-API-KEY'] = $this->apiKey;
    }

    /**
     * Scale the picture
     * @param PicwishScale $picwishScale
     * @return PicwishScaleAsyncResponse|PicwishScaleErrorResponse|PicwishScaleSuccessResponse|string
     */
    public function scale(PicwishScale $picwishScale){
        $body = [];
        $result = [];
        if($picwishScale->getImageFile()){
            $body = $picwishScale->toMultipart();
            $result = $this->callApi($this->baseUrl.$this->scaleEndpoint,'POST',null,$body);
        }
        else{
            $body = $picwishScale->toArray();
            $result = $this->callApi($this->baseUrl.$this->scaleEndpoint,'POST',$body,null);
        }
        if(is_array($result)){
            if($result['status'] == 200){
                if(isset($result['data']['progress']) and $result['data']['progress'] == 100){
                    return new PicwishScaleSuccessResponse($result);
                }
                else {
                    return new PicwishScaleAsyncResponse($result['status'],$result['data']);
                }
            }
            else {
                return new PicwishScaleErrorResponse($result['status'],$result['message']);
            }
        }
        return $result;
    }

    /**
     * Check Progress
     * @param string $taskId
     * @return PicwishScaleErrorResponse|PicwishScalePollResult|PicwishScaleSuccessResponse
     */
    public function checkProgress(string $taskId){
        $result = $this->callApi($this->baseUrl.$this->scaleEndpoint.'/'.$taskId);
        if($result['status'] == 200){
            if($result['data']['progress'] == 100){
                return new PicwishScaleSuccessResponse($result);
            }
            else{
                return new PicwishScalePollResult($result['status'],$result['data']);
            }
        }
        else {
            return new PicwishScaleErrorResponse($result['status'],$result['message']);
        }
    }

    /**
     * @param string $url
     * @param string|null $method
     * @param array|null $body
     * @param array|null $multipart
     * @return array|string|null
     */
    private function callApi(string $url,?string $method = 'GET',?array $body=[],?array $multipart = [])
    {
        try{
            $client = new Client();
            $options = [
                'headers' => $this->headers,
            ];
            if($body and count($body) > 0){
                $options['body'] = json_encode($body);
            }
            else if($multipart and count($multipart) > 0){
                $options['multipart'] = $multipart;
            }
            $response = $client->request($method,$url,$options);
            return json_decode($response->getBody(),true);
        }
        catch (ClientException $e){
            return $e->getMessage();
        }
    }

}