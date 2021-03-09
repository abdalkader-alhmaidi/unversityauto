<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;

use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $name;
    public $year;
    
    public function __construct($cat,$year){
     $this->name = $cat ;
     $this->year = $year ;


    }
    public function collection()
    {
       $users =DB::table('users')
                ->join('categories', 'users.category_id', '=', 'categories.id')
                ->where('categories.name',$this->name)->where('categories.year',$this->year)
                ->select('users.name')
                ->get();
         return $users;
    }
    public function headings(): array
    {
        return ["name"];
    }
}
