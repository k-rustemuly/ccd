<?php
namespace App\Ccd\Admin\Domain\Repositories;

use App\Domain\Repositories\Repository;
use App\Ccd\Admin\Domain\Models\Admin as Model;
use Illuminate\Support\Facades\App;

class AdminRepository extends Repository
{
    protected $model;

    private $language;

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->language = App::currentLocale();
    }

}