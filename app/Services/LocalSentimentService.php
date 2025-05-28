<?php

namespace App\Services;

use PHPInsight\Sentiment;

class LocalSentimentService
{
    protected $sentiment;

    public function __construct()
    {
        $this->sentiment = new Sentiment();
    }

    /**
     * Analyze sentiment of given text.
     *
     * @param string $text
     * @return string 'positive', 'negative', or 'neutral'
     */
    public function analyze(string $text): string
    {
        $class = $this->sentiment->categorise($text);

        switch ($class) {
            case 'pos':
                return 'positive';
            case 'neg':
                return 'negative';
            default:
                return 'neutral';
        }
    }
}
