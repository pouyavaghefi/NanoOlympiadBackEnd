<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeatureTranslation extends Model
{
    protected $table = 'feature_translations';
    protected $guarded = [];

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
