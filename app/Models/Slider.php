<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'sliders';
    protected $guarded = [];

    public function translations()
    {
        return $this->hasMany(SliderTranslation::class);
    }

    // Add a method to get translation by language code
    public function showTrans($languageCode)
    {
        return $this->translations()->where('language_code', $languageCode)->first();
    }
}
