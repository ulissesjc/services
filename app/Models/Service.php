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
        'category',
        'description',
        'date',
        'mode',
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


    public function getModeLabelAttribute()
    {
        return match($this->mode) {
            'in_person' => 'Presencial',
            'remote' => 'Remota',
            'bench' => 'Bancada',
            default => 'Inválido'
        };
    }

    public function getCategoryLabelAttribute()
    {
        return match($this->category) {
            'lab_review' => 'Revisão de Laboratório',
            'admin_review' => 'Revisão de Administrativo',
            'net_check' => 'Verificação de Internet',
            'others' => 'Outros',
            default => 'Inválido'
        };
    }
}
