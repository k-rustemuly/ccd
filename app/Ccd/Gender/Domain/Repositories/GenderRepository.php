<?php
namespace App\Ccd\Gender\Domain\Repositories;

use App\Domain\Repositories\ReferenceRepository;
use App\Ccd\Gender\Domain\Models\Gender as Model;
use Illuminate\Support\Facades\App;

class GenderRepository extends ReferenceRepository
{
    protected $model;

    public $language;

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->language = App::currentLocale();
    }
}