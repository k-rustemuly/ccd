<?php
namespace App\Ccd\Imei\Domain\Repositories;

use App\Domain\Repositories\Repository;
use App\Ccd\Imei\Domain\Models\Imei as Model;
use Illuminate\Support\Facades\App;

class ImeiRepository extends Repository
{
    protected $model;

    private $language;

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->language = App::currentLocale();
    }

    /**
     * 
     * @return array<mixed>
     */
    public function getList($person_id = 0):array
    {
        $query = $this->where('person_id', $person_id);
        return $query->get()->all();
    }
}