<?php

namespace App\Imports;

use App\Import;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentImportData implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
        return new Import([
                "student_name" => isset($row[0]) ? $row[0]:null,
                "student_code" => isset($row[1]) ? $row[1]:null
        ]);
    }
}
