<?php

namespace App\Ccd\Phone\Domain\Services;

use App\Domain\Services\TableType;
use App\Ccd\Phone\Domain\Repositories\PhoneRepository as Repository;
use App\Helpers\FieldTypes\Text;
use App\Helpers\FieldTypes\Reference;
use App\Helpers\Field;
use Illuminate\Support\Facades\App;
use App\Helpers\Action;

class SearchService extends TableType
{

    protected $repository;

    public $name = "phone";

    public $headers;

    public $datas;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function handle($search = array())
    {
        $this->headers = $this->getHeader();
        $this->datas = $this->repository->searchList($search);
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
                        ->render(),
            "iin" => Field::_()
                    ->init(new Text())
                    ->render(),
            "birthday" => Field::_()
                        ->init(new Text())
                        ->render(),
            "gender_id" => Field::_()
                        ->init(new Reference("gender"))
                        ->key("gender")
                        ->render(),
            "phone_number" => Field::_()
                        ->init(new Text())
                        ->render(),
        ];
    }
}