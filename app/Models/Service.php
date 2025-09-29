<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'glpi_number_call',
        'description',
        'date',
        'type',
        'user_id',
        'school_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }


    public function getTypeLabelAttribute()
    {
        return match($this->type) {
            'in_person' => 'Presencial',
            'remote' => 'Remoto',
            'bench' => 'Bancada',
            default => 'Inválido'
        };
    }
}
