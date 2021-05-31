<?php
namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;

class EmployeeEmport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    
    /**
     * @param mixed $row
     *
     * @return array
     */
    public function model(array $row)
    {
        return new employee([
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
            'bank'    => $row['bank'], 

        ]);
    }

    
}
