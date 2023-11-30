<?php

namespace Zymfonix\Modulus\Commands;

use Illuminate\Console\Command;

class ModulusCommand extends Command
{
    public $signature = 'modulus';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
