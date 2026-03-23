<?php

namespace Kernel\Console\Commands;

class Content
{
    public function controller($name): string
    {
        if (!str_contains($name,"Controller")) {
            $name = $name."Controller";
        }
        $a = explode('/',$name);
        $className = ucfirst($a[1] ?? $a[0]);
        $namespace = isset($a[1])
            ? 'Shop\\controllers\\'.$a[0]
            : 'Shop\\controllers';

        return  <<<PHP
<?php

namespace {$namespace};

use Kernel\Controller\BaseController;

class {$className} extends BaseController
{
    
}
PHP;
    }

    public function migration($name): string
    {
        $className = ucfirst($name);
        return <<<PHP
<?php

namespace Migration;

use Kernel\Migration\interface\MigrationsInterface;
use Kernel\Migration\interface\TableInterface;

class {$className} implements MigrationsInterface
{
    public static function up(TableInterface \$table): void
    {
        // Your migration logic here
    }

    public static function down(TableInterface \$table): void
    {
        // Your rollback logic here
    }
}
PHP;
    }

    public function model($name): string
    {
        $className = ucfirst($name);
        return <<<PHP
<?php
namespace Shop\\model;

use Kernel\\Model\\Model;

class {$className} extends Model
{
    protected string \$table = '';
    protected array \$fillable = [];
}
PHP;
    }

    public function rule($name): string
    {
        $className = ucfirst($name);
        return <<<PHP
<?php
namespace Shop\\rules;

use Shop\\rules\\interface\\RulesInterface;

class {$className} implements RulesInterface
{
    public static function rules(): array
    {
        return [

        ];
    }

    public static function messages(): array
    {
        return  [

        ];
    }
}
PHP;
    }

    public function seed($name): string
    {
        if (!str_contains($name,"Seed")) {
            $name = $name."Seed";
        }

        $className = ucfirst($name);
        return <<<PHP
<?php
namespace Seeder;
use Kernel\Seeder\Seeder;

class {$className} extends Seeder
{
    public static function run(): void
    {
        // Your seeder logic here
    }
}
PHP;
    }

    public function service($name): string
    {
        $className = ucfirst($name);
        return <<<PHP
<?php
namespace Shop\\service;

use Kernel\\Service\\BaseService;

class {$className} extends BaseService
{
    
}
PHP;
    }
}