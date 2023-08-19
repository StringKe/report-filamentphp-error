<?php

namespace App\Livewire;

use Livewire\Component;

class CompanySocialButtons extends Component
{
    public $providers = [];

    /**
     * @param  array  $providers
     */
    public function __construct(array $providers = [])
    {
        if (count($providers) === 0) {
            $providers = [
                "facebook" => [
                    "label" => "Facebook",
                    "icon" => "fab-facebook",
                ],
                "google" => [
                    "label" => "Google",
                    "icon" => "fab-google",
                ]
            ];
        }

        $this->providers = $providers;
    }

    public function render()
    {
        return view('livewire.company-social-buttons');
    }
}
