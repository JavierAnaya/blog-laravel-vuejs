<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class StructureCommand extends Command
{
     /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'structure:create {--api} {--vue}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create structure of project';

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
     * @return mixed
     */
    public function handle()
    {
        $name = $this->ask('Nombre de la clase (ej. Name, Food)?');
        $nameLower = "$" . strtolower($name);
        $directory = $this->ask('Nombre de la carpeta raiz (ej. mrsinco, hardworkers)?');
        $api = $this->option('api');
        $vue = $this->option('vue');

        $path = substr(__DIR__, 0, -16);
        $pathDefault = $path . $directory . '/service/' . strtolower($name) . '/';

        if($api != null) {
            if (!file_exists($path . 'Http/Controllers/Api')) {
                $this->error('El directorio de API no existe!!');
                $this->error('Crear carpeta asi: app/Http/Controllers/Api');
                return;
            }
        }

        if (!file_exists($path . $directory)) {
            $this->error('El directorio no existe!! Intenta creandolo primero :D');
            $this->error('Crear carpeta asi: app/{name_project}');
            return;
        }

        if (!file_exists($path . $directory . '/service/')) {
            $this->error('No existe la carpeta service, por favor de crearla ');
            $this->error('Crear carpeta asi: app/{name_project}/service');
            return;
        }

        if (!file_exists($path . $directory . '/common/entities')) {
            $this->error('No existe la carpeta entities, por favor de crearla ');
            $this->error('Crear carpeta asi: app/{name_project}/common/entities');
            return;
        }

        if (file_exists($pathDefault)) {
            $this->error('Ya existe este directorio con su estructura de archivos :(');
            return;
        }

        mkdir($pathDefault, 0777, true);

        // Create Repository
        $fileRepository = $name . 'Repository.php';
        $fileOpenRepository = fopen($pathDefault . $fileRepository, "w");
        fwrite($fileOpenRepository, '<?php

namespace App\\' . $directory . '\service\\' . strtolower($name) . ';

use Exception;
use App\\' . $name . ';
use App\\' . $directory . '\common\entities\\' . $name . 'Entity;
use Illuminate\Database\QueryException;

class ' . $name . 'Repository implements I' . $name . '
{

    /**
     * @return mixed
     * @throws Exception
     */
    public function getAll()
    {
        try
        {
            ' . $nameLower . 's = ' . $name . '::all();
        } catch (QueryException $queryException)
        {
            throw new Exception($queryException->getMessage());
        } catch (Exception $exception)
        {
            throw new Exception($exception->getMessage());
        }

        return ' . $nameLower . 's;
    }

    /**
     * @param ' . $name . 'Entity ' . $nameLower . 'Entity
     * @return mixed
     * @throws Exception
     */
    public function create(' . $name . 'Entity ' . $nameLower . 'Entity)
    {
        try
        {
            ' . $nameLower . ' = ' . $name . '::create(' . $nameLower . 'Entity->toArray());
        } catch (QueryException $queryException)
        {
            throw new Exception($queryException->getMessage());
        } catch (Exception $exception)
        {
            throw new Exception($exception->getMessage());
        }

        return ' . $nameLower . ';
    }

    /**
     * @param ' . $name . 'Entity ' . $nameLower . 'Entity
     * @return mixed
     * @throws Exception
     */
    public function update(' . $name . 'Entity ' . $nameLower . 'Entity)
    {
        try
        {
            ' . $nameLower . ' = ' . $name . '::find(' . $nameLower . 'Entity->getId())
                ->update(' . $nameLower . 'Entity->toArray());
        } catch (QueryException $queryException)
        {
            throw new Exception($queryException->getMessage());
        } catch (Exception $exception)
        {
            throw new Exception($exception->getMessage());
        }

        return ' . $nameLower . ';
    }

    /**
     * @param ' . $name . 'Entity ' . $nameLower . 'Entity
     * @return mixed
     * @throws Exception
     */
    public function delete(' . $name . 'Entity ' . $nameLower . 'Entity)
    {
        try
        {
            ' . $nameLower . ' = ' . $name . '::find(' . $nameLower . 'Entity->getId())
                ->delete();
        } catch (QueryException $queryException)
        {
            throw new Exception($queryException->getMessage());
        } catch (Exception $exception)
        {
            throw new Exception($exception->getMessage());
        }

        return ' . $nameLower . ';
    }
}');

        fclose($fileOpenRepository);

        // Create Interface
        $fileInterfaceRepository = 'I' . $name . '.php';
        $fileOpenInterfaceRepository = fopen($pathDefault . $fileInterfaceRepository, "w");
        fwrite($fileOpenInterfaceRepository, '<?php

namespace App\\' . $directory . '\service\\' . strtolower($name) . ';

use App\\' . $directory . '\common\entities\\' . $name . 'Entity;

interface I' . $name . '
{
    public function getAll();

    public function create(' . $name . 'Entity ' . $nameLower . 'Entity);

    public function update(' . $name . 'Entity ' . $nameLower . 'Entity);

    public function delete(' . $name . 'Entity ' . $nameLower . 'Entity);
}');

        fclose($fileOpenInterfaceRepository);

        // Create Command
        $fileCommand = $name . 'Command.php';
        $fileOpenCommand = fopen($pathDefault . $fileCommand, "w");
        fwrite($fileOpenCommand, '<?php

namespace App\\' . $directory . '\service\\' . strtolower($name) . ';

use App\\' . $directory . '\common\entities\\' . $name . 'Entity;
use App\\' . $directory . '\common\utils\Response;

class ' . $name . 'Command
{
    private ' . $nameLower . 'Repository;

    /**
     * ' . $name . 'Command constructor.
     * @param I' . $name . ' $I' . $name . '
     */
    public function __construct(I' . $name . ' ' . $nameLower . ')
    {
        $this->' .strtolower($name) . 'Repository = ' . $nameLower . ';
    }

    /**
     * @return Response
     */
    public function getAll()
    {
        $all = $this->' . strtolower($name) . 'Repository->getAll();
        if (count($all) == 0)
        {
            return new Response(
                false,
                "empty"
            );
        }

        return new Response(
            true,
            $all
        );
    }

    /**
     * @param ' . $name . 'Entity ' . $nameLower . 'Entity
     * @return Response
     */
    public function create(' . $name . 'Entity ' . $nameLower . 'Entity)
    {
        $create = $this->' . strtolower($name) . 'Repository->create(' . $nameLower . 'Entity);
        if (count($create) == 0)
        {
            return new Response(
                false,
                "not-create"
            );
        }

        return new Response(
            true,
            "created"
        );
    }

    /**
     * @param ' . $name . 'Entity ' . $nameLower . 'Entity
     * @return Response
     */
    public function update(' . $name . 'Entity ' . $nameLower . 'Entity)
    {
        $update = $this->' . strtolower($name) . 'Repository->update(' . $nameLower . 'Entity);
        if (!$update)
        {
            return new Response(
                false,
                "not-update"
            );
        }

        return new Response(
            true,
            "updated"
        );
    }

    /**
     * @param ' . $nameLower . 'tId
     * @return Response
     */
    public function delete(' . $nameLower . 'Id)
    {
        ' . $nameLower . 'Entity = new ' . $name . 'Entity();
        ' . $nameLower . 'Entity->setId(' . $nameLower . 'Id);
        try
        {
            $delete = $this->' . strtolower($name) . 'Repository->delete(' . $nameLower . 'Entity);
        } catch (\Exception $exception)
        {
            return new Response(
                false,
                $exception->getMessage()
            );
        }

        return new Response(
            true,
            "deleted"
        );
    }
}');

        fclose($fileOpenCommand);

        // Create Entity
        $fileEntity = $name . 'Entity.php';
        $fileOpenEntity = fopen($path . $directory . '/common/entities/' . $fileEntity, "w");
        fwrite($fileOpenEntity, '<?php

namespace App\\' . $directory . '\common\entities;

class '.$name.'Entity
{
    // params

    /**
     * @return Array
     */
    public function toArray()
    {
        $array = [
            // params
        ];

        return array_filter($array);
    }
}');

        fclose($fileOpenEntity);

        if($api == null) {
            $this->info('Se generaron los recursos con exito.');
            return;
        }

        $fileApi = $name . 'WS.php';
        $fileOpenApi = fopen($path . 'Http/Controllers/Api/' . $fileApi, "w");
        fwrite($fileOpenApi, '<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\\' . $directory . '\common\entities\\' . $name . 'Entity;
use App\\' . $directory . '\service\\' . strtolower($name) . '\\' . $name . 'Command;
use App\\' . $directory . '\service\\' . strtolower($name) . '\\' . $name . 'Repository;

class ' . $name . 'WS extends Controller
{

    private ' . $nameLower . 'Command;

    /**
     * ' . $name . 'WS constructor.
     */
    public function __construct() {
        $this->' . strtolower($name) . 'Command = new ' . $name . 'Command(new ' . $name . 'Repository());
    }

    public function getAll()
    {

    }

    public function create(Request $request)
    {

    }

    public function update(Request $request)
    {

    }

    public function delete($id)
    {

    }

}
        ');

        fclose($fileOpenApi);
        $this->info('Se generaron los recursos con exito.');
        $this->info('Se ha generado la API con exito.');

        if($vue != null) {
            $this->error('Aun no esta disponible --vue');
            return;
        }

    }
}
