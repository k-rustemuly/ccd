<?php
namespace App\Ccd\IpAddress\Domain\Repositories;

use App\Domain\Repositories\Repository;
use App\Ccd\IpAddress\Domain\Models\IpAddress as Model;
use Illuminate\Support\Facades\App;

class IpAddressRepository extends Repository
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
        ->select($this->model->table.'.ip_address',
            'person.*',
            'rb_gender.name_'.$this->language.' as gender_name');
        if(is_array($search) && !empty($search))
        {
            if(isset($search['ip_address']))
            {
                $query->where($this->model->table.'.ip_address', 'like', '%'.$search['ip_address'].'%');
            }
        }
        return $query->get()->all();
    }
}