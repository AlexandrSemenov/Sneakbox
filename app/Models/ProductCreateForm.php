<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductCreateForm extends Model
{
    public function getCategoryList()
    {
        return DB::table('categories')->get();
    }
    public function getSizeList()
    {
        return DB::table('sizes')->get();
    }
    public function getConditionList()
    {
        return DB::table('conditions')->get();
    }
}
