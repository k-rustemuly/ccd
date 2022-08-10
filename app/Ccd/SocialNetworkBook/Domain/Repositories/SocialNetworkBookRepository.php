<?php
namespace App\Ccd\SocialNetworkBook\Domain\Repositories;

use App\Domain\Repositories\Repository;
use App\Ccd\SocialNetworkBook\Domain\Models\SocialNetworkBook as Model;
use Illuminate\Support\Facades\App;

class SocialNetworkBookRepository extends Repository
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
                        ->select('rb_social_network.name_'.$this->language.' as social_network_name', $this->model->table.'.id', $this->model->table.'.social_network_id', $this->model->table.'.account')
                        ->where($this->model->table.'.person_id', $person_id);
        return $query->get()->all();
    }
}