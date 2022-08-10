<?php

namespace App\Ccd\SocialNetworkIdBook\Domain\Services;

use App\Domain\Services\TableType;
use App\Ccd\SocialNetworkIdBook\Domain\Repositories\SocialNetworkIdBookRepository as Repository;
use App\Helpers\FieldTypes\Text;
use App\Helpers\FieldTypes\Reference;
use App\Helpers\Field;
use Illuminate\Support\Facades\App;
use App\Helpers\Action;

class ListService extends TableType
{

    protected $repository;

    public $name = "socialnetworkidbook";

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
            "social_network_id" => Field::_()
                        ->init(new Reference("social-network"))
                        ->onCreate("visible", true)
                        ->onUpdate("visible", true)
                        ->key("social_network")
                        ->render(),
            "idn" => Field::_()
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
                    ->requestUrl(route('admin.social_network_id.create', ['locale' => App::currentLocale(), 'person_id' => $this->person_id]))
                    ->type("success")
                    ->render(),
        ];
    }
}