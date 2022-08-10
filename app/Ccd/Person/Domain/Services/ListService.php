<?php

namespace App\Ccd\Person\Domain\Services;

use App\Domain\Services\TableType;
use App\Ccd\Person\Domain\Repositories\PersonRepository as Repository;
use App\Helpers\FieldTypes\Reference;
use App\Helpers\FieldTypes\Text;
use App\Helpers\FieldTypes\Number;
use App\Helpers\FieldTypes\Date;
use App\Helpers\Field;
use Illuminate\Support\Facades\App;
use App\Helpers\Action;

class ListService extends TableType
{

    protected $repository;

    public $name = "person";

    public $headers;

    public $datas;

    public $actions;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function handle()
    {
        $this->headers = $this->getHeader();
        $this->datas = $this->repository->getList();
        $this->actions = $this->getAction();
        return $this->getData();
    }

    /** 
     * действия для каждой строки
     * 
     * @param string|int $person_id
     * 
     * @return array<mixed>
    */
    public function action($person_id = 0)
    {
        return [
            "view" =>  Action::_()
                    ->requestType("get")
                    ->requestUrl(route('admin.person.view', ['locale' => App::currentLocale(), 'person_id' => $person_id]))
                    ->type("info")
                    ->render(),
        ];
    }

    /**
     * Заголовки
     * 
     * @return array<mixed>
     */
    private function getHeader()
    {
        return [
            "full_name" => Field::_()
                        ->init(new Text())
                        ->onCreate("visible", true)
                        ->onUpdate("visible", true)
                        ->render(),
            "iin" => Field::_()
                    ->init(new Number())
                    ->onCreate("visible", true)
                    ->onUpdate("visible", true)
                    ->minLength(12)
                    ->maxLength(12)
                    ->render(),
            "birthday" => Field::_()
                        ->init(new Date())
                        ->onCreate("visible")
                        ->onUpdate("visible")
                        ->render(),
            "gender_id" => Field::_()
                        ->init(new Reference("gender"))
                        ->key("gender")
                        ->onCreate("visible", true)
                        ->onUpdate("visible", true)
                        ->render(),
        ];
    }

    /**
     * Глабольные действии
     * 
     * @return array<mixed>
     */
    private function getAction()
    {
        return [
            "create" => Action::_()
                    ->requestType("post")
                    ->requestUrl(route('admin.person.create', ['locale' => App::currentLocale()]))
                    ->type("success")
                    ->render(),
        ];
    }
}