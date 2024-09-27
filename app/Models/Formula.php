<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formula extends Model
{
    use HasFactory;

    protected $guarded = ['id']; // Isso permite que todos os outros campos sejam preenchidos

    public function materials()
    {
        return $this->belongsToMany(Material::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
