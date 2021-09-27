<?php

namespace App\Models;

use Cache;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{   

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user'];
    
    public $primaryKey  = 'user';

    public static $defultUserName = 'demoUser';

    public $timestamps = false;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::updated(function () {
            self::flushCache();
        });

        static::created(function () {
            self::flushCache();
        });
    }

    /**
     * Get a settings value
     *
     * @param $key
     * @return value
     */
    // public static function get($key)
    // {
    //     $settingValue = self::getAllSettings();
    //     return $settingValue->$key;
    // }
    /**
     * Get all the settings
     *
     * @return mixed
     */
    public static function getAllSettings()
    {
        return Cache::rememberForever('settings', function () {
            return self::first();
        });
    }

    /**
     * Flush the cache
     */
    public static function flushCache()
    {
        Cache::forget('settings');
    }

}
