<?php

namespace App;

use GuzzleHttp\Client;
use Ramsey\Uuid\Uuid;

/**
 * @see https://developer.govee.com/reference/get-you-devices
 */
class Govee
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://openapi.api.govee.com/',
            'headers' => [
                'Govee-API-Key' => getenv('GOVEE_API_KEY'),
                'Content-Type' => 'application/json'
            ]
        ]);
    }

    public function getDevices(): array
    {
        $response = $this->client->get('/router/api/v1/user/devices');
        $data = json_decode($response->getBody(), true);

        return $data['data'] ?? [];
    }

    public function setDevicePower(string $sku, string $device, int $value): array
    {
        $response = $this->client->post('/router/api/v1/device/control', [
            'json' => [
                'requestId' => Uuid::uuid4()->toString(),
                'payload' => [
                    'sku' => $sku,
                    'device' => $device,
                    'capability' => [
                        'type' => 'devices.capabilities.on_off',
                        'instance' => 'powerSwitch',
                        'value' => $value
                    ]
                ]
            ]
        ]);

        return json_decode($response->getBody(), true);
    }

    public function toggleAllDevices(string $state = 'on'): void
    {
        $devices = $this->getDevices();

        foreach ($devices as $device) {
            $mac = $device['device'];
            $sku = $device['sku'];
            $value = $state == 'on' ? 1 : 0;

            foreach ($device['capabilities'] as $cap) {
                if ($cap['type'] === 'devices.capabilities.on_off' && $cap['instance'] === 'powerSwitch') {
                    $this->setDevicePower($sku, $mac, $value);
                    break;
                }
            }
        }
    }
}