<?php

namespace App\Ccd\Person\Domain\Services;

use App\Domain\Services\BlockType;
use App\Ccd\Person\Domain\Repositories\PersonRepository as Repository;
use App\Helpers\Action;
use App\Helpers\Block;
use App\Helpers\Field;
use App\Helpers\FieldTypes\Reference;
use App\Helpers\FieldTypes\Text;
use App\Helpers\FieldTypes\Number;
use App\Helpers\FieldTypes\Date;
use App\Exceptions\MainException;
use Illuminate\Support\Facades\App;

class AboutService extends BlockType
{

    protected $repository;

    public $name = "one_person";

    public $blocks;

    public $actions;

    public $headers;

    public $person_id;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param string $person_id ID место 
     */
    public function handle($person_id = 0)
    {
        $this->person_id = $person_id;
        $aboutPerson = $this->repository->getOne($person_id);
        if(empty($aboutPerson)) throw new MainException("You dont have permission or record not found");

        $this->blocks = array(
            "main_info" => Block::_()
                        ->action($this->getActions())
                        ->values($this->getMainBlock($aboutPerson)),
            "email_block" => Block::_()
                        ->type(Block::EXTERNAL_TABLE)
                        ->custom("data_url", route('admin.email.list', ['locale' => App::currentLocale(), 'person_id' => $person_id]))
                        ->values(),
            "bank_account_block" => Block::_()
                                ->type(Block::EXTERNAL_TABLE)
                                ->custom("data_url", route('admin.bank_account.list', ['locale' => App::currentLocale(), 'person_id' => $person_id]))
                                ->values(),
            "bank_card_block" => Block::_() 
                                ->type(Block::EXTERNAL_TABLE)
                                ->custom("data_url", route('admin.bank_card.list', ['locale' => App::currentLocale(), 'person_id' => $person_id]))
                                ->values(),
            "imei_block" => Block::_()
                            ->type(Block::EXTERNAL_TABLE)
                            ->custom("data_url", route('admin.imei.list', ['locale' => App::currentLocale(), 'person_id' => $person_id]))
                            ->values(),
            "ip_address_block" => Block::_()
                                ->type(Block::EXTERNAL_TABLE)
                                ->custom("data_url", route('admin.ip_address.list', ['locale' => App::currentLocale(), 'person_id' => $person_id]))
                                ->values(),
            "phone_block" => Block::_()
                            ->type(Block::EXTERNAL_TABLE)
                            ->custom("data_url", route('admin.phone.list', ['locale' => App::currentLocale(), 'person_id' => $person_id]))
                            ->values(),
            "social_network_block" => Block::_()
                                    ->type(Block::EXTERNAL_TABLE)
                                    ->custom("data_url", route('admin.social_network.list', ['locale' => App::currentLocale(), 'person_id' => $person_id]))
                                    ->values(),
            "social_network_id_block" => Block::_()
                                        ->type(Block::EXTERNAL_TABLE)
                                        ->custom("data_url", route('admin.social_network_id.list', ['locale' => App::currentLocale(), 'person_id' => $person_id]))
                                        ->values(),
            "edrd_block" => Block::_()
                            ->type(Block::EXTERNAL_TABLE)
                            ->custom("data_url", route('admin.edrd.list', ['locale' => App::currentLocale(), 'person_id' => $person_id]))
                            ->values(),
        );
        $this->headers = $this->getHeader($aboutPerson);
        return $this->getData();
    }

    /** 
     * Главный блок об одном месте
     * 
     * @param array<mixed> $values Данные для заполнение данных блока
     * 
     * @return array<mixed>
    */
    private function getMainBlock(array $values = array())
    {
        return [
                "full_name" => [
                    "value" => $values["full_name"],
                ],
                "iin" => [
                    "value" => $values["iin"],
                ],
                "birthday" => [
                    "value" => $values["birthday"],
                ],
                "gender" => [
                    "value" => $values["gender_name"],
                ]
        ];
    }

    /**
     * Заголовки для изменение записи
     * 
     * @return array<mixed>
     */
    private function getHeader($values = array())
    {
        return [
            "update" => [
                "full_name" => Field::_()
                            ->init(new Text())
                            ->onUpdate("visible", true)
                            ->value($values["full_name"])
                            ->render(),
                "iin" => Field::_()
                        ->init(new Number())
                        ->onUpdate("visible", true)
                        ->value($values["iin"])
                        ->minLength(12)
                        ->maxLength(12)
                        ->render(),
                "birthday" => Field::_()
                        ->init(new Date())
                        ->onUpdate("visible")
                        ->value($values["birthday"])
                        ->render(),
                "gender_id" => Field::_()
                            ->init(new Reference("gender"))
                            ->key("gender")
                            ->onUpdate("visible", true)
                            ->value([[
                                "id" => $values["gender_id"],
                                "name" => $values["gender_name"]
                            ]])
                            ->render(),
            ]
        ];
    }

    /**
     * @param string $type
     * 
     * @return array<mixed>
     */
    private function getActions($type = "update")
    {
        $actions = array(
            "update" => array(
                "update" => 
                    Action::_()
                    ->requestType("put")
                    ->requestUrl(route('admin.person.update', ['locale' => App::currentLocale(), 'person_id' => $this->person_id]))
                    ->type("success")
                    ->render(),
            )
        );
        return $actions[$type]??[];
    }
}