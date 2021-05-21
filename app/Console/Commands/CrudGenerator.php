<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class CrudGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:generator {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $moduleName;
    protected $moduleNamePlural;
    protected $moduleNamePluralLowerCase;
    protected $moduleNameSingularLowerCase;

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
    public function handle()
    {
        $this->moduleName = $this->argument('name');
        $this->moduleNamePlural = Str::plural($this->moduleName);
        $this->moduleNamePluralLowerCase = Str::plural(strtolower($this->moduleName));
        $this->moduleNameSingularLowerCase = strtolower($this->moduleName);
        // create new module
        Artisan::call("module:make $this->moduleName", []);

        // migrate module table
        Artisan::call("module:make-migration create_" . $this->moduleNamePluralLowerCase . "_table $this->moduleName", []);

        $this->config();

        $this->form();

        $this->requestForm();

        $this->repository();

        $this->datatables();

        $this->breadcrumbs();

        $this->controller();

        $this->service();

        $this->trait();
    }

    protected function config()
    {
        $template = $this->getTemplateContent('config');
        file_put_contents(base_path("Modules/$this->moduleName/Config/config.php"), $template);
    }

    protected function form()
    {
        $template = $this->getTemplateContent('Form');

        if (!file_exists("Modules/$this->moduleName/Http/Forms/"))
            mkdir("Modules/$this->moduleName/Http/Forms/");
        file_put_contents(base_path("Modules/$this->moduleName/Http/Forms/" . $this->moduleName . "Form.php"), $template);
    }

    protected function requestForm()
    {
        $template = $this->getTemplateContent('StoreRequest');
        file_put_contents(base_path("Modules/$this->moduleName/Http/Requests/" . $this->moduleName . "StoreRequest.php"), $template);

        $template = $this->getTemplateContent('UpdateRequest');
        file_put_contents(base_path("Modules/$this->moduleName/Http/Requests/" . $this->moduleName . "UpdateRequest.php"), $template);
    }

    protected function repository()
    {
        $entityTemplate = $this->getTemplateContent('Entity');
        file_put_contents(base_path("Modules/$this->moduleName/Entities/" . $this->moduleName . ".php"), $entityTemplate);

        if (!file_exists("Modules/$this->moduleName/Repositories"))
            mkdir("Modules/$this->moduleName/Repositories");

        $repositoryTemplate = $template = $this->getTemplateContent('Repository');
        file_put_contents(base_path("Modules/$this->moduleName/Repositories/" . $this->moduleName . "Repository.php"), $repositoryTemplate);
    }

    protected function datatables()
    {

        $template = $this->getTemplateContent('Datatable');
        if (!file_exists("Modules/$this->moduleName/Datatables/"))
            mkdir("Modules/$this->moduleName/Datatables/");
        file_put_contents(base_path("Modules/$this->moduleName/Datatables/" . $this->moduleName . "Datatables.php"), $template);

    }

    protected function breadcrumbs()
    {
        $template = $this->getTemplateContent('breadcrumbs');
        file_put_contents(base_path("Modules/$this->moduleName/Routes/web.php"), $template);
    }

    protected function controller()
    {
        $controllerTemplate = $this->getTemplateContent('Controller');
        file_put_contents(base_path("Modules/$this->moduleName/Http/Controllers/" . $this->moduleNamePlural . "Controller.php"), $controllerTemplate);
    }

    protected function service()
    {
        $serviceTemplate = $this->getTemplateContent('Service');

        if (!file_exists("Modules/$this->moduleName/Services/"))
            mkdir("Modules/$this->moduleName/Services/");

        file_put_contents(base_path("Modules/$this->moduleName/Services/" . $this->moduleName . "Service.php"), $serviceTemplate);
    }

    protected function trait()
    {
        $traitTemplate = $this->getTemplateContent('Trait');

        if (!file_exists("Modules/$this->moduleName/Entities/Traits/"))
            mkdir("Modules/$this->moduleName/Entities/Traits/");

        file_put_contents(base_path("Modules/$this->moduleName/Entities/Traits/" . 'Has' . $this->moduleName . ".php"), $traitTemplate);
    }

    protected function getTemplateContent($templateName)
    {
        $template = str_replace(
            [
                '{{moduleName}}',
                '{{moduleNamePlural}}',
                '{{moduleNamePluralLowerCase}}',
                '{{moduleNameSingularLowerCase}}'
            ],
            [
                $this->moduleName,
                $this->moduleNamePlural,
                $this->moduleNamePluralLowerCase,
                $this->moduleNameSingularLowerCase
            ],
            $this->getStub($templateName)
        );
        return $template;
    }

    protected function getStub($type)
    {
        return file_get_contents(resource_path("stubs/$type.stub"));
    }


}
