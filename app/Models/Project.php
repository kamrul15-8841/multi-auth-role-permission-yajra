<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'type',
        'stack',
        'short_description',
        'long_description',
        'github_link',
        'web_link',
        'image',
        'status',
        'slug',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

//    protected static function boot()
//    {
//        parent::boot();
//
//        static::creating(function ($project) {
//            if (!$project->slug) {
//                $project->slug = str_slug($project->title);
//            }
//        });
//    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });

//        static::creating(function ($project) {
//            if (empty($project->slug)) {
//                $project->slug = Str::slug($project->title) ?: 'project-' . time();
//            }
//        });


        static::updating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });
    }


}
