<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class TopMenuTranslation extends Model
{
    protected $table = 'topmenu_navigation_translations';
    protected $guarded = [];

    public function showNav()
    {
        return DB::table('topmenu_navigation')->where('id',$this->menu_item_id)->first();
    }
}
