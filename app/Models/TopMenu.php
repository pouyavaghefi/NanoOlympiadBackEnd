<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class TopMenu extends Model
{
    use HasFactory;
    protected $table = 'topmenu_navigation';
    protected $guarded = [];

    public function showTrans($languageCode)
    {
        return DB::table('topmenu_navigation_translations')
            ->where('menu_item_id', $this->id)
            ->where('language_code', $languageCode)
            ->first();
    }

    public function translations()
    {
        return $this->hasMany(TopMenuTranslation::class, 'menu_item_id');
    }
}
