<?php
namespace Apsg\Domains\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class SetupDomainsCommand extends Command
{
    protected $signature = 'ddd:setup {--examples}';

    public function handle()
    {
        $this->fixRouteServiceProvider();
        $this->fixAuthRoutes();

        $this->generateDirectories();

        $this->info('Finished');

        if ($this->option('examples')) {
            $this->generateExamples();
        }
    }

    private function generateDirectories() : void
    {
        $this->info('Creating directory for domains');

        File::ensureDirectoryExists(base_path('app/Domains'));
    }

    private function fixRouteServiceProvider() : void
    {
        $this->info('Fixing the Route Service Provider');

        $this->replaceInFile(
            'app/Providers/RouteServiceProvider.php',
            'protected $namespace = \'App\Http\Controllers\';',
            'protected $namespace = \'\';'
        );
    }

    private function fixAuthRoutes()
    {
        $this->info('Publishing auth routes file');
        File::copy(__DIR__ . '/../../stubs/routes.php', base_path('routes/auth.php'));

        $this->info('Fixing auth routes');

        $this->replaceInFile(
            'routes/web.php',
            'Auth::routes();',
            ''
        );

        $this->replaceInFile(
            'routes/web.php',
            'require(__DIR__ . "/auth.php");' . PHP_EOL,
            ''
        );

        $this->replaceInFile(
            'routes/web.php',
            '<?php',
            '<?php'
            . PHP_EOL
            . PHP_EOL
            . 'require(__DIR__ . "/auth.php");'
        );
    }

    private function generateExamples()
    {
        $this->info('Generating examples');
        $this->line('Your examples can be found in app/Domains/Example/Controllers/ExampleController.php');
        $this->line('and in routes/web.php file');

        File::ensureDirectoryExists(base_path('app/Domains/Example'));
        File::ensureDirectoryExists(base_path('app/Domains/Example/Controllers'));
        File::ensureDirectoryExists(base_path('app/Domains/Example/Models'));
        File::ensureDirectoryExists(base_path('app/Domains/Example/Requests'));

        File::copy(
            __DIR__ . '/../../stubs/ExampleController.php',
            base_path('app/Domains/Example/Controllers/ExampleController.php')
        );
        File::copy(
            __DIR__ . '/../../stubs/ExampleRequest.php',
            base_path('app/Domains/Example/Requests/ExampleRequest.php')
        );

        $this->appendToFile('routes/web.php',
            '// Simplify the FQN for me here please...'
            . PHP_EOL
            . "Route::get('domain/example', App\Domains\Example\Controllers\ExampleController::class . '@example');"
        );
    }

    private function replaceInFile($filePath, string $search, string $replace = '') : void
    {
        $file = base_path($filePath);
        file_put_contents($file, str_replace(
                $search,
                $replace,
                file_get_contents($file))
        );
    }

    private function appendToFile(string $filePath, string $append)
    {
        $file = base_path($filePath);
        file_put_contents($file,
            file_get_contents($file)
            . PHP_EOL
            . $append
        );
    }
}
