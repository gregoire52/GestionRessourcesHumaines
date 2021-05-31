<?php

namespace App\Imports;

use App\Employee;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;

class EmployeesImport implements
    ToCollection,
    WithHeadingRow,
    SkipsOnError,
    WithValidation,
    SkipsOnFailure,
    WithChunkReading,
    ShouldQueue,
    WithEvents
{
    use Importable, SkipsErrors, SkipsFailures, RegistersEventListeners;


    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $employee = Employee::create([
                'id'     => $row['id'],
                'employeeID'    => $row['employeeID'], 
                'fullName'    => $row['fullName'], 
                'department'    => $row['department'], 
                'designation'    => $row['designation'], 
                'fatherName'    => $row['fatherName'], 
                'fonction'    => $row['fonction'], 
                'gender'    => $row['gender'], 
                'campus'    => $row['campus'], 
                'site'    => $row['site'], 
                'situation'    => $row['situation'], 
                'statut'    => $row['statut'], 
                'mobileNumber'    => $row['mobileNumber'], 
                'date_of_birth'    => $row['date_of_birth'], 
                'joiningDate'    => $row['joiningDate'], 
                'localAddress'    => $row['localAddress'], 
                'permanentAddress'    => $row['permanentAddress'], 
                'status'    => $row['status'], 
                'exit_date'    => $row['exit_date'], 
                'accountName'    => $row['accountName'], 
                'accountNumber'    => $row['accountNumber'], 
                'bank'    => $row['bank'],             'id'     => $row['id'],
                'employeeID'    => $row['employeeID'], 
                'fullName'    => $row['fullName'], 
                'department'    => $row['department'], 
                'designation'    => $row['designation'], 
                'fatherName'    => $row['fatherName'], 
                'fonction'    => $row['fonction'], 
                'gender'    => $row['gender'], 
                'campus'    => $row['campus'], 
                'site'    => $row['site'], 
                'situation'    => $row['situation'], 
                'statut'    => $row['statut'], 
                'mobileNumber'    => $row['mobileNumber'], 
                'date_of_birth'    => $row['date_of_birth'], 
                'joiningDate'    => $row['joiningDate'], 
                'localAddress'    => $row['localAddress'], 
                'permanentAddress'    => $row['permanentAddress'], 
                'status'    => $row['status'], 
                'exit_date'    => $row['exit_date'], 
                'accountName'    => $row['accountName'], 
                'accountNumber'    => $row['accountNumber'], 
                'bank'    => $row['bank']
            ]);

/**$user->address()->create([
                'country' => $row['country']
            ]);**/
        }
    }

   /**public function rules(): array
    {
        return [
            '*.email' => ['email', 'unique:users,email']
        ];
    }**/


    public function chunkSize(): int
    {
        return 1000;
    }

    public static function afterImport(AfterImport $event)
    {
    }

    public function onFailure(Failure ...$failure)
    {
    }
}