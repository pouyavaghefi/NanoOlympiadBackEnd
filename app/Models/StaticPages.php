<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaticPages extends Model
{
    use HasFactory;
    protected $table = 'static_pages';
    protected $guarded = [];

    public function translations()
    {
        return $this->hasMany(FeatureTranslation::class, 'feature_id');
    }

    public function translationsDep()
    {
        return $this->hasMany(DepartmentTranslation::class, 'static_page_id');
    }

    public function aboutusTranslations()
    {
        return $this->hasMany(AboutusTranslation::class, 'aboutus_id');
    }
}
