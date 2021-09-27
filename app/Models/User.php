<?php

namespace App\Models;

use App\Models\Copart;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;

    /**
     * Disable created_at & updated_at column.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * Get the user's paid.
     *
     * @param  string  $value
     * @return string
     */
    public function getPaidAttribute($value)
    {
        if (!empty($value)) {
            return $value;
        } else {
            return __("No");
        }
    }

    /**
     * Get the user's temp.
     *
     * @param  string  $value
     * @return string
     */
    public function getTempAttribute($value)
    {
        if ($value) {
            $temp = __("Y");
        } else {
            $temp = __("N");
        }

        if (!empty($this->reg) && $this->reg > 0) {
            $temp .= " $" . $this->reg;
        }
        return $temp;
    }

    /**
     * Scope a query to only include expired users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeExpired($query)
    {
        return $query->where(function ($expiredQuery) {
            $expiredQuery->whereNotNull('expires')->where('expires', '<=', Carbon::now()->timestamp);
        });
    }

    /**
     * Scope a query to only include unassigned users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnassigned($query)
    {
        return $query->whereNull('cid');
    }

    /**
     * Scope a query to only include assigned users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAssigned($query)
    {
        return $query->whereNotNull('cid');
    }

    /**
     * Scope a query to only include unpaid users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnpaid($query)
    {
        return $query->whereNull('paid');
    }

    /**
     * Scope a query to only include temp/Nontemp users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTemp($query, $value)
    {
        return $query->where('temp', $value);
    }

    /**
     * Scope a query to only include all the child check remaining users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDuplicateCheck($query)
    {
        return $query->where('is_child_check', 0);
    }

    /**
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->first . ' ' . $this->last;
    }
}
