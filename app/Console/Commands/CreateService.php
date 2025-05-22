<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;


class CreateService extends Command
{
    protected $signature = 'make:service {name : The name of the service class}';
    protected $description = 'Creates a new service class';
    protected $type = 'Service';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */


    /**
     * Mengembalikan path dari stub service yang akan digunakan.
     * Path dari stub dapat diubah dengan mengganti nilai variabel $this->stub.
     *
     * @return string
     */
    protected function getStub()
    {
        return $this->resolveStubPath('/stubs/service.stub'); // Menggunakan stub default Laravel, atau stub kustom jika Anda membuatnya
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        // Memisahkan path dan nama kelas
        $name = str_replace('/', '\\', $this->argument('name'));
        $parts = explode('\\', $name);
        array_pop($parts); // Remove the class name
        $path = implode('\\', $parts);

        return $rootNamespace . '\\Services' . ($path ? '\\' . $path : ''); // Adjust namespace
    }
    /**
     * Build the directory for the class if necessary.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $classPath = str_replace('\\', '/', $name);
        $directory = dirname($this->getPath($classPath));

        if (!is_dir($directory)) {
            $this->makeDirectory($directory, 0755, true, true);
        }

        return parent::buildClass($name);
    }

    /**
     * Resolve the fully-qualified path to the stub.
     *
     * @param  string  $stub
     * @return string
     */
    protected function resolveStubPath($stub)
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath
            : __DIR__ . $stub;
    }
    public function handle()
    {
        $name = str_replace('/', '\\', $this->argument('name')); // Use backslash for namespace
        $namespace = $this->getDefaultNamespace('App'); // Get the namespace from getDefaultNamespace
        $classPath = str_replace('\\', '/', $name);
        $filePath = $this->laravel->path('Services/' . $classPath . '.php');

        // Create the directory if it doesn't exist
        $directory = dirname($filePath);
        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, 0755, true, true); // Recursive creation
        }

        if (File::exists($filePath)) {
            $this->error("Service class '$name' already exists.");
            return 0;
        }

        $content = "<?php\n\nnamespace {$namespace};\n\nclass " . class_basename($name) . "\n{\n\n    public function __construct()\n    {\n\n    }\n\n    // Your service methods here\n}";

        File::put($filePath, $content);

        $this->info("Service class '" . class_basename($name) . "' created successfully at '{$filePath}'");
        return 0;
    }
}
