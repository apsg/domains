<?php
namespace Apsg\Domains\Commands;

use Illuminate\Console\Command;

class SetupDomainsCommand extends Command
{
    protected $signature = "ddd:setup";

    public function fire()
    {
        $this->info('Fixing the Route Service Provider');

        $this->info('Creating directory for domains');

        $this->info('Finished');
    }
}
