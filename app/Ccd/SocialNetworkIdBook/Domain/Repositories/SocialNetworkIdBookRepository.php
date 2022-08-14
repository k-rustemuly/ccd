<?php
namespace App\Ccd\SocialNetworkIdBook\Domain\Repositories;

use App\Domain\Repositories\Repository;
use App\Ccd\SocialNetworkIdBook\Domain\Models\SocialNetworkIdBook as Model;
use Illuminate\Support\Facades\App;

class SocialNetworkIdBookRepository extends Repository
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
        $query = $this->join('rb_social_network', $this->model->table.'.social_network_id', '=', 'rb_social_network.id')
                        ->select('rb_social_network.name_'.$this->language.' as social_network_name', $this->model->table.'.id', $this->model->table.'.social_network_id', $this->model->table.'.idn')
                        ->where($this->model->table.'.person_id', $person_id);
        return $query->get()->all();
    }

    public function searchList($search = array())
    {
        $query = $this->join('person', $this->model->table.'.person_id', '=', 'person.id')
        ->join('rb_gender', 'person.gender_id', '=', 'rb_gender.id')
        ->join('rb_social_network', $this->model->table.'.social_network_id', '=', 'rb_social_network.id')
        ->select($this->model->table.'.idn',
                $this->model->table.'.social_network_id',
            'person.*',
            'rb_social_network.name_'.$this->language.' as social_network_name',
            'rb_gender.name_'.$this->language.' as gender_name');
        if(is_array($search) && !empty($search))
        {
            if(isset($search['idn']))
            {
                $query->where($this->model->table.'.idn', 'like', '%'.$search['idn'].'%');
            }
        }
        return $query->get()->all();
    }
}