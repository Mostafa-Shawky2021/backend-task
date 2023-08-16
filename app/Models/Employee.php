<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Spatie\LaravelIgnition\Recorders\DumpRecorder\Dump;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public static function booted()
    {

        static::saving(function (Employee $employee) {

            $employeePassword = $employee->employee_password;
            $employeePassword ?  $employee->employee_password = Hash::make($employeePassword) : null;
        });
    }
}
