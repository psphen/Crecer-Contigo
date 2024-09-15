<?php

namespace App\Imports;

use App\Models\Vendor;
use App\Models\Place;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;

class VendorImport implements ToModel
{
    public function model(array $row)
    {
        // Supongamos que la columna 0 contiene el nombre y la columna 1 contiene el slug
        return new Vendor([
            'name' => $row[8],
            'slug' => $row[8],
            'email' => $row[3],
            'password' => Hash::make($row[9]),
        ]);
    }
}
