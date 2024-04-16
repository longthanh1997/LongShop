<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\DB;

class UsersExport implements FromCollection,WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('users')->get();
       
    }
    /**
     * Returns headers for report
     * @return array
     */
    public function headings(): array {
        return [
            'id',
            'name',
            'phone',  
            'email',    
            "address"
            
        ];
    }
 
    public function map($user): array {
        return [
            $user->id,
            $user->name,
            $user->phone,
            $user->email,
            $user->address
        ];
    }
}
