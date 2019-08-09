<?php

namespace Leasedeck\PortalApi\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

/**
 * Class GenerateApiKey
 *
 * @package Leasedeck\PortalApi\Console\Commands
 */
class GenerateApiKey extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api-sleutel:genereer
        {--id= : Unieke waarde van de databank entiteit dat je wenst te koppelen aan deze sleutel}
        {--service : De naam van de service die de API key consumeerd}
        {--type : De class naam van de datamodel dat je wenst te koppelen aan deze API sleutel}';

    /**
     * The console command description
     *
     * @var string
     */
    protected $description = 'Genereer een nieuwe API sleutel in de applicatie.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $apiKeyId      = $this->option('id');
        $apiKeyType    = $this->option('type');
        $apiKeyService = $this->option('service');

        $apiKey = DB::transaction(static function () use ($apiKeyId, $apiKeyService, $apiKeyType): void {
           return ApiKey::create([
              'sleutel' => ApiKey::generateKey(), 'service_naam' => $apiKeyService, 'apikeyable_id' => $apiKeyId, 'apikeyable_type' => $apiKeyType,
           ]);
        });

        $this->info("Een API key is aangemaakt met de volgende sleutel: {$apiKey->key}");
    }
}
