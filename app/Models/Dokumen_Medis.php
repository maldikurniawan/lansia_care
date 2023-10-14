<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen_Medis extends Model
{
    use HasFactory;

    protected $table = 'dokumen_medis';
    protected $guarded = [];

    /**
     * Get all of the comments for the Dokumen_Medis
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user()
    {
        return $this->hasMany(User::class);
    }
}
