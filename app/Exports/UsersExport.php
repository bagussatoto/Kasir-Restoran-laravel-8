<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();
    }

    public function map($users): array
    {
        return [
           	$users->fullname,
           	$users->email,
           	$users->username,
           	$users->level
        ];
    }

    public function headings(): array
    {
        return [
            'NAMA LENGKAP',
            'EMAIL',
            'USERNAME',
            'HAK AKSES'
        ];
    }
}
