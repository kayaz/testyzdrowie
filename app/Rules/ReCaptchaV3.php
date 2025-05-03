<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ReCaptchaV3 implements Rule
{
    private ?string $action = null;
    private ?float $minScore = null;

    public function __construct(?string $action = null, ?float $minScore = null)
    {
        $this->action = $action;
        $this->minScore = $minScore;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $siteVerify = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => settings()->get("recaptcha_secret_key"),
            'response' => $value,
        ]);

        if ($siteVerify->failed()) {
            Log::channel('recaptcha')->warning('HTTP request to reCAPTCHA API failed.', [
                'response' => $siteVerify->body(),
            ]);
            return false;
        }

        $body = $siteVerify->json();

        if (!isset($body['success']) || $body['success'] !== true) {
            Log::channel('recaptcha')->warning('API returned unsuccessful response.', [
                'response' => $body,
            ]);
            return false;
        }

        if (!is_null($this->action) && $this->action != ($body['action'] ?? null)) {
            Log::channel('recaptcha')->info('Action mismatch.', [
                'expected' => $this->action,
                'actual' => $body['action'] ?? null,
            ]);
            return false;
        }

        if (!is_null($this->minScore) && $this->minScore > ($body['score'] ?? 0)) {
            Log::channel('recaptcha')->info('Score too low.', [
                'required_score' => $this->minScore,
                'actual_score' => $body['score'] ?? null,
            ]);
            return false;
        }

        Log::channel('recaptcha')->info('reCAPTCHA passed.', [
            'score' => $body['score'] ?? null,
            'action' => $body['action'] ?? null,
        ]);

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Google reCAPTCHA validation failed.';
    }
}
