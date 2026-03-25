<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutusTranslation extends Model
{
    protected $table = 'aboutus_translations';

    protected $fillable = [
        'language_id',
        'aboutus_id',
        'translation',
        'description',
    ];

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

    public function aboutus()
    {
        return $this->belongsTo(StaticPages::class, 'aboutus_id');
    }
}
