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

            $data =
                Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . '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',
                ])
                ->post("https://api.openai.com/v1/chat/completions", [
                    "model" => "gpt-3.5-turbo",
                    'messages' => [
                        [
                            "role" => "user",
                            "content" => $message
                        ]
                    ],
                    'temperature' => 0.5,
                    "max_tokens" => 3000,
                    "top_p" => 1.0,
                    "frequency_penalty" => 0.52,
                    "presence_penalty" => 0.5,
                    "stop" => ["11."],
                ])
                ->json();


            return response()->json($data['choices'][0]['message'], 200, array(), JSON_PRETTY_PRINT);
        } catch (Exception $e) {

            throw new BadRequestHttpException($e->getMessage());
        }
    }
}
