<?php
namespace Azlanali076\Litepdf;

use Azlanali076\Litepdf\Models\LitepdfConversion;
use Azlanali076\Litepdf\Models\LitepdfConversionAsyncResponse;
use Azlanali076\Litepdf\Models\LitepdfConversionErrorResponse;
use Azlanali076\Litepdf\Models\LitepdfConversionResult;
use Azlanali076\Litepdf\Models\LitepdfConversionSuccessResponse;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Litepdf {

    private string $baseUrl = 'https://techhk.aoscdn.com/api';
    private string $conversionEndpoint = '/tasks/document/conversion';
    private ?string $apiKey = null;
    private array $headers = [
        'Accept' => 'application/json'
    ];

    public function __construct(){
        $this->apiKey = config('litepdf.api_key');
        $this->headers['X-API-KEY'] = $this->apiKey;
    }

    /**
     * Convert the Document
     * @param LitepdfConversion $litepdfConversion
     * @return LitepdfConversionAsyncResponse|LitepdfConversionErrorResponse|LitepdfConversionSuccessResponse|string
     */
    public function convert(LitepdfConversion $litepdfConversion){
        $body = [];
        $result = [];
        if($litepdfConversion->getDocFile()){
            $body = $litepdfConversion->toMultipart();
            $result = $this->callApi($this->baseUrl.$this->conversionEndpoint,'POST',null,$body);
        }
        else{
            $body = $litepdfConversion->toArray();
            $result = $this->callApi($this->baseUrl.$this->conversionEndpoint,'POST',$body,null);
        }
        if(is_array($result)){
            if($result['status'] == 200){
                if(isset($result['data']['progress']) and $result['data']['progress'] == 100){
                    return new LitepdfConversionSuccessResponse($result);
                }
                else {
                    return new LitepdfConversionAsyncResponse($result['status'],$result['data']);
                }
            }
            else {
                return new LitepdfConversionErrorResponse($result['status'],$result['message']);
            }
        }
        return $result;
    }

    /**
     * Check Progress
     * @param string $taskId
     * @return LitepdfConversionErrorResponse|LitepdfConversionResult|LitepdfConversionSuccessResponse
     */
    public function checkProgress(string $taskId){
        $result = $this->callApi($this->baseUrl.$this->conversionEndpoint.'/'.$taskId);
        if($result['status'] == 200){
            if($result['data']['progress'] == 100){
                return new LitepdfConversionSuccessResponse($result);
            }
            else{
                return new LitepdfConversionResult($result['status'],$result['data']);
            }
        }
        else {
            return new LitepdfConversionErrorResponse($result['status'],$result['message']);
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
                'verify' => false,
                'timeout' => 600,
                'connection_timeout' => 600
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