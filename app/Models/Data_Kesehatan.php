<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data_Kesehatan extends Model
{
    use HasFactory;

    protected $table = 'data_kesehatan';
    protected $guarded = [];

    /**
     * Get all of the comments for the Data_Kesehatan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user()
    {
        return $this->hasMany(User::class, 'users_id');
    }
}
