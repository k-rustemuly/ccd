<?php
namespace App\Ccd\SocialNetwork\Domain\Repositories;

use App\Domain\Repositories\ReferenceRepository;
use App\Ccd\SocialNetwork\Domain\Models\SocialNetwork as Model;
use Illuminate\Support\Facades\App;

class SocialNetworkRepository extends ReferenceRepository
{
    protected $model;

    public $language;

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->language = App::currentLocale();
    }
}