<?php

namespace App\Imports;

use App\Models\School;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class SchoolsImport implements ToModel, WithHeadingRow, SkipsEmptyRows
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new School([
            'name' => $row['nome'],
            'inep' => $row['inep'],
            'cnpj' => $row['cnpj'],
            'email' => $row['e_mail'],
            'phone' => $row['telefone'],
            'city' => $row['municipio'],
            'address' => $row['endereco'],
            'has_lab' => $row['possui_lab'],
            'has_resource_room' => $row['possui_sala'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }


}
