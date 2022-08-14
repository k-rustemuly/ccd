<?php
namespace App\Ccd\Edrd\Domain\Repositories;

use App\Domain\Repositories\Repository;
use App\Ccd\Edrd\Domain\Models\Edrd as Model;
use Illuminate\Support\Facades\App;

class EdrdRepository extends Repository
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

    public function searchList($search = array())
    {
        $query = $this->join('person', $this->model->table.'.person_id', '=', 'person.id')
        ->join('rb_gender', 'person.gender_id', '=', 'rb_gender.id')
        ->select($this->model->table.'.edrd_number',
            $this->model->table.'.fabula',
            $this->model->table.'.description',
            'person.*',
            'rb_gender.name_'.$this->language.' as gender_name');
        if(is_array($search) && !empty($search))
        {
            if(isset($search['edrd_number']))
            {
                $query->where($this->model->table.'.edrd_number', 'like', '%'.$search['edrd_number'].'%');
            }
            if(isset($search['fabula']))
            {
                $query->where($this->model->table.'.fabula', 'like', '%'.$search['fabula'].'%');
            }
            if(isset($search['description']))
            {
                $query->where($this->model->table.'.description', 'like', '%'.$search['description'].'%');
            }
        }
        return $query->get()->all();
    }
}