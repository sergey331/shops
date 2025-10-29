<?php

namespace Kernel\Seeder;

final class RunSeed
{
    public function __construct(
        private readonly ?string $selectedClass = null
    ) {}

    public function seed(): void
    {
        foreach ($this->getSeedClasses() as $className) {
            $this->runSeeder($className);
        }
    }

    /**
     * @return string[] List of seeder class names
     */
    private function getSeedClasses(): array
    {
        $dir = __DIR__ . '/../../seeders';
        $files = glob("{$dir}/*.php") ?: [];

        $classes = array_map(
            fn($file) => pathinfo($file, PATHINFO_FILENAME),
            $files
        );

        if ($this->selectedClass) {
            $classes = array_filter(
                $classes,
                fn($f) => strcasecmp($f, $this->selectedClass) === 0
            );
        }

        return $classes;
    }

    private function runSeeder(string $file): void
    {
        $className = "Seeder\\{$file}";

        if (!class_exists($className)) {
            $this->log("❌ Class not found: {$className}");
            return;
        }

        if (!method_exists($className, 'run')) {
            $this->log("⚠️ Method run() not found in {$className}");
            return;
        }

        $this->log("▶ Running seeder: {$className}::run()");
        (new $className())->run();
        $this->log("✅ Seeder completed: {$file}");
    }

    private function log(string $message): void
    {
        echo $message . PHP_EOL;
    }
}
