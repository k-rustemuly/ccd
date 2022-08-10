<?php

namespace App\Ccd\Imei\Domain\Services;

use App\Domain\Services\TableType;
use App\Ccd\Imei\Domain\Repositories\ImeiRepository as Repository;
use App\Helpers\FieldTypes\Text;
use App\Helpers\Field;
use Illuminate\Support\Facades\App;
use App\Helpers\Action;

class ListService extends TableType
{

    protected $repository;

    public $name = "imei";

    public $headers;

    public $datas;

    public $actions;

    public $person_id;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function handle($person_id = 0)
    {
        $this->person_id = $person_id;
        $this->headers = $this->getHeader();
        $this->datas = $this->repository->getList($person_id);
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
            "imei" => Field::_()
                        ->init(new Text())
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
                    ->requestUrl(route('admin.imei.create', ['locale' => App::currentLocale(), 'person_id' => $this->person_id]))
                    ->type("success")
                    ->render(),
        ];
    }
}