<?php

namespace App\Services;

use Illuminate\Support\Facades\Config;

class SentimentManager
{
    protected $openAiService;
    protected $localService;

    public function __construct(OpenAiSentimentService $openAiService, LocalSentimentService $localService)
    {
        $this->openAiService = $openAiService;
        $this->localService = $localService;
    }

    /**
     * Analyze text sentiment using configured driver.
     *
     * @param string $text
     * @return string 'positive', 'negative', or 'neutral'
     */
    public function analyze(string $text): string
    {
        $driver = Config::get('sentiment.driver');

        if ($driver === 'openai') {
            return $this->openAiService->analyze($text);
        }

        // default to local
        return $this->localService->analyze($text);
    }
}
