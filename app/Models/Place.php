<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Place extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'city_id', 'state_id'];

    /**
     * The attributes that should be merged with the user object.
     *
     * @var array<string, string>
     */
    protected $with = ['city', 'state'];


    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($place) {
            $slug = Str::slug("{$place->name} {$place->city} {$place->state}");
            $count = DB::table('places')->where('slug', 'like', "$slug%")->count();

            if ($count > 0) {
                $place->slug = "{$slug}-{$count}";
            } else {
                $place->slug = $slug;
            }
        });

        static::updating(function ($place) {
            $slug = Str::slug("{$place->name} {$place->city} {$place->state}");
            $count = DB::table('places')->where('slug', 'like', "$slug%")->count();

            if ($count > 0 && $place->isDirty('name', 'city', 'state')) {
                $place->slug = "{$slug}-{$count}";
            } else {
                $place->slug = $slug;
            }
        });
    }


}
