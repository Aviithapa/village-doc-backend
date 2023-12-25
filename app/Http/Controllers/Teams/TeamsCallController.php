<?php

namespace App\Http\Controllers\Teams;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;

class TeamsCallController extends Controller
{
    protected $tenantId;
    protected $clientId;
    protected $clientSecret;

    public function __construct()
    {
        $this->tenantId = 'f4efde4d-99f0-4aa8-a3a8-62bd9c95a826';
        $this->clientId = 'dd628eb7-b70e-4740-ba9d-f763aa5ed5ec';
        $this->clientSecret = '6c3a2799-4c05-48a0-bb83-eed1b8d43af6';
    }

    public function generateToken()
    {
        $tenantId = $this->tenantId;
        $clientId = $this->clientId;
        $clientSecret = $this->clientSecret;
        $resource = 'https://graph.microsoft.com';
        $authority = 'https://login.microsoftonline.com/' . $tenantId;

        $guzzle = new \GuzzleHttp\Client();

        $tokenEndpoint = $authority . '/oauth2/token';

        $token = json_decode($guzzle->post($tokenEndpoint, [
            'form_params' => [
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
                'resource' => $resource,
                'grant_type' => 'client_credentials',
            ],
        ])->getBody()->getContents(), true);

        return response()->json(['access_token' => $token['access_token']]);
    }


}
