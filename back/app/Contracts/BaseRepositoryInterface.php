<?php 

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface {
    public function all();
   
    public function save(Model $model);
}