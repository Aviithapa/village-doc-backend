<?php

namespace App\Client\ChatGPT;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ChatGPTService implements AiServiceInterface
{
    protected $baseUri;

    protected $apiKey;


    public function __construct()
    {
        $this->baseUri   = config('services.chatgpt.chatgpt_endpoint');
        $this->apiKey    = config('services.chatgpt.chatgpt_key');
    }


    public function chat($message)
    {
        try {

            $response =
                Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . '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',
                ])
                ->post("https://api.openai.com/v1/chat/completions", [
                    "model" => "gpt-3.5-turbo",
                    'messages' => [
                        [
                            "role" => "user",
                            "content" => 'Hello from bot'
                        ]
                    ],
                    'temperature' => 0.5,
                    "max_tokens" => 500,
                    "top_p" => 1.0,
                    "frequency_penalty" => 0.52,
                    "presence_penalty" => 0.5,
                    "stop" => ["11."],
                ])
                ->json();

            // dd($response);
            // return $response;
            return response()->json($response, 200, array(), JSON_PRETTY_PRINT);
        } catch (Exception $e) {

            throw new BadRequestHttpException($e->getMessage());
        }
    }
}
