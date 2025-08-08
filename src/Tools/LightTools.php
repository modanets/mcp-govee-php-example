<?php

namespace App\Tools;

use App\Govee;
use PhpMcp\Server\Attributes\McpTool;

class LightTools
{
    private Govee $govee;

    public function __construct()
    {
        $this->govee = new Govee();
    }

    #[McpTool(name: "turn_off_lights")]
    public function turnOffLights(): string
    {
        $this->govee->toggleAllDevices('off');

        return "Lights have been turned OFF.";
    }

    #[McpTool(name: "turn_on_lights")]
    public function turnOnLights(): string
    {
        $this->govee->toggleAllDevices('on');

        return "Lights have been turned ON.";
    }
}