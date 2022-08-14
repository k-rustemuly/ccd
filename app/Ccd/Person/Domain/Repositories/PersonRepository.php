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
    public function getList($search = array()):array
    {
        $query = $this->join('rb_gender', $this->model->table.'.gender_id', '=', 'rb_gender.id')
        ->select($this->model->table.'.*',
            'rb_gender.name_'.$this->language.' as gender_name');
        if(is_array($search) && !empty($search))
        {
            if(isset($search['full_name']))
            {
                $query->where($this->model->table.'.full_name', 'like', '%'.$search['full_name'].'%');
            }

            if(isset($search['iin']))
            {
                $query->where($this->model->table.'.iin', 'like', '%'.$search['iin'].'%');
            }

            if(isset($search['birthday']))
            {
                $query->where($this->model->table.'.birthday', $search['birthday']);
            }

            if(isset($search["gender_id"]))
            {
                $query->where($this->model->table.'.gender_id', $search['gender_id']);
            }
        }
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