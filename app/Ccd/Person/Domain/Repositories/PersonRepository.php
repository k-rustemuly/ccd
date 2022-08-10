<?php
namespace App\Ccd\Person\Domain\Repositories;

use App\Domain\Repositories\Repository;
use App\Ccd\Person\Domain\Models\Person as Model;
use Illuminate\Support\Facades\App;

class PersonRepository extends Repository
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
    public function getList():array
    {
        $query = $this->join('rb_gender', $this->model->table.'.gender_id', '=', 'rb_gender.id')
        ->select($this->model->table.'.*',
            'rb_gender.name_'.$this->language.' as gender_name');
        return $query->get()->all();
    }

    public function getOne($person_id)
    {
        $query = $this->join('rb_gender', $this->model->table.'.gender_id', '=', 'rb_gender.id')
        ->select($this->model->table.'.*',
            'rb_gender.name_'.$this->language.' as gender_name')
        ->where($this->model->table.'.id', $person_id);
        return $query->first()->toArray();
    }
}