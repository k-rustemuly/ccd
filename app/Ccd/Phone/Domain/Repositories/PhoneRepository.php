<?php
namespace App\Ccd\Phone\Domain\Repositories;

use App\Domain\Repositories\Repository;
use App\Ccd\Phone\Domain\Models\Phone as Model;
use Illuminate\Support\Facades\App;

class PhoneRepository extends Repository
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
        ->select($this->model->table.'.phone_number',
            'person.*',
            'rb_gender.name_'.$this->language.' as gender_name');
        if(is_array($search) && !empty($search))
        {
            if(isset($search['phone_number']))
            {
                $query->where($this->model->table.'.phone_number', 'like', '%'.$search['phone_number'].'%');
            }
        }
        return $query->get()->all();
    }
}