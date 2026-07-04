<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    protected $fillable = [
        'title',
        'email',
        'system_name',
        'copyright_text',
        'logo',
        'favicon',
        'about_system',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_image',
    ];
    protected $appends = ['logo_url', 'favicon_url', 'og_image_url'];

    public function getLogoUrlAttribute()
    {
        return imageUrl($this->logo);
    }

    public function getFaviconUrlAttribute()
    {
        return imageUrl($this->favicon);
    }

    public function getOgImageUrlAttribute()
    {
        return imageUrl($this->og_image);
    }
}
