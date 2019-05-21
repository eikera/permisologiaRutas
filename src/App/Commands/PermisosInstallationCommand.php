<?php
namespace permisologia\Permissionsrolesandroutes\App\Commands;

use Symfony\Component\Process\Process;
use Illuminate\Console\Command;
use Request;
use Cache;
use App;
use DB;

class PermisosInstallationCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'permisos:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Permisologia Installation Command';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->header();
        $this->checkRequirements();
        $this->info('Instalando: ');

        $this->info('Quito algunos archivos de migración por defecto de laravel...');
        if (file_exists(base_path('database/migrations/2014_10_12_000000_create_users_table.php'))) {
            @unlink(base_path('database/migrations/2014_10_12_000000_create_users_table.php'));
        }
        if (file_exists(base_path('database/migrations/2014_10_12_100000_create_password_resets_table.php'))) {
            @unlink(base_path('database/migrations/2014_10_12_100000_create_password_resets_table.php'));
        }

        if ($this->confirm('Tiene configurando la conección de la base de datos en el archivo .env ?')) {

            if (! file_exists(public_path('vendor'))) {
                mkdir(public_path('vendor'), 0777);
            }

            $this->info('Publishing archivos necesarios...');
            $this->call('vendor:publish', ['--provider' => 'permisologia\Permissionsrolesandroutes\App\Providers\PermissionsrolesandroutesProvider']);
            $this->call('vendor:publish', ['--tag' => 'permisos_migrations', '--force' => true]);
            $this->call('vendor:publish', ['--tag' => 'permisos_seeds', '--force' => true]);

            $this->info('Dump autoload y recargando los nuevos archivos...');
            $composer = $this->findComposer();
            $process = new Process($composer.' dumpautoload');
            $process->setWorkingDirectory(base_path())->run();

            $this->info('Migrando database...');
            $this->call('migrate');

            if (! class_exists('PermisosSeeder')) {
                require_once __DIR__.'/../database/seeds/PermisosSeeder.php';
            }
            $this->call('db:seed', ['--class' => 'PermisosSeeder']);
            $this->call('config:clear');

            if (app()->version() < 5.6) {
                $this->call('optimize');
            }

            $this->info('La instalacion de los permisos ha finalizado! Muchas gracias :)');
        } else {
            $this->info('Instalación cancelada !');
            $this->info('Por favor configure su base de datos!');
        }

        $this->footer();
    }

    private function header()
    {
        $this->info("
            #   / ____// ____// __ \
            #  / / __ / __/  / / / /
            # / /_/ // /___ / /_/ / 
            # \____//_____//_____/                                                                                                                        
			");
        $this->info('--------- :===: Thanks for choosing :==: ---------------');
        $this->info('====================================================================');
    }

    private function checkRequirements()
    {
        $this->info('System Requirements Checking:');
        $system_failed = 0;
        $laravel = app();

        if ($laravel::VERSION >= 5.3) {
            $this->info('Laravel Version (>= 5.3.*): [Good]');
        } else {
            $this->info('Laravel Version (>= 5.3.*): [Bad]');
            $system_failed++;
        }

        if (version_compare(phpversion(), '5.6.0', '>=')) {
            $this->info('PHP Version (>= 5.6.*): [Good]');
        } else {
            $this->info('PHP Version (>= 5.6.*): [Bad] Yours: '.phpversion());
            $system_failed++;
        }

        if (extension_loaded('mbstring')) {
            $this->info('Mbstring extension: [Good]');
        } else {
            $this->info('Mbstring extension: [Bad]');
            $system_failed++;
        }

        if (extension_loaded('openssl')) {
            $this->info('OpenSSL extension: [Good]');
        } else {
            $this->info('OpenSSL extension: [Bad]');
            $system_failed++;
        }

        if (extension_loaded('pdo')) {
            $this->info('PDO extension: [Good]');
        } else {
            $this->info('PDO extension: [Bad]');
            $system_failed++;
        }

        if (extension_loaded('tokenizer')) {
            $this->info('Tokenizer extension: [Good]');
        } else {
            $this->info('Tokenizer extension: [Bad]');
            $system_failed++;
        }

        if (extension_loaded('xml')) {
            $this->info('XML extension: [Good]');
        } else {
            $this->info('XML extension: [Bad]');
            $system_failed++;
        }

        if (extension_loaded('gd')) {
            $this->info('GD extension: [Good]');
        } else {
            $this->info('GD extension: [Bad]');
            $system_failed++;
        }

        if (extension_loaded('fileinfo')) {
            $this->info('PHP Fileinfo extension: [Good]');
        } else {
            $this->info('PHP Fileinfo extension: [Bad]');
            $system_failed++;
        }

        if (is_writable(base_path('public'))) {
            $this->info('public dir is writable: [Good]');
        } else {
            $this->info('public dir is writable: [Bad]');
            $system_failed++;
        }

        if ($system_failed != 0) {
            $this->info('Sorry unfortunately your system is not meet with our requirements !');
            $this->footer(false);
        }
        $this->info('--');
    }

    private function footer($success = true)
    {
        $this->info('--');
        //$this->info('Homepage : http://www.crudbooster.com');
        $this->info('Github : https://github.com/eikera/permisologiaRutas.git');
        $this->info('Documentation : https://github.com/eikera/permisologiaRutas/blob/master/README.md');
        $this->info('====================================================================');
        if ($success == true) {
            $this->info('------------------- :===: Finalizado !! :===: ------------------------');
        } else {
            $this->info('------------------- :===: Fallido !!    :===: ------------------------');
        }
        exit;
    }

    /**
     * Get the composer command for the environment.
     *
     * @return string
     */
    protected function findComposer()
    {
        if (file_exists(getcwd().'/composer.phar')) {
            return '"'.PHP_BINARY.'" '.getcwd().'/composer.phar';
        }

        return 'composer';
    }
}
