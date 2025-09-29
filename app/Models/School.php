<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'inep',
        'cnpj',
        'email',
        'phone',
        'city',
        'address',
        'has_lab',
        'has_resource_room'
    ];

    /**
     * Uma escola pode ter vários atendimentos
     */
    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

}
