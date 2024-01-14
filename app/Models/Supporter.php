<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supporter extends Model
{
    //

    protected $fillable = [
        'name', 'details', 'sort_order'
    ];


    public function getIsFirstAttribute() {
        return $this->sort_order === Supporter::min('sort_order');
    }

    public function getIsLastAttribute() {
        return $this->sort_order === Supporter::max('sort_order');
    }

    protected $appends = [
        'is_first', 'is_last'
    ];
}
