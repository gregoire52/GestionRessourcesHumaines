<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ressource;
use Excel;

class ImportExcelController extends Controller
{
    function index()
    {
     $data = ressource::table('employees')->orderBy('ID', 'DESC')->get();
     return view('import_excel', compact('data'));
    }

    function import(Request $request)
    {
     $this->validate($request, [
      'select_file'  => 'required|mimes:xls,xlsx'
     ]);

     $path = $request->file('select_file')->getRealPath();

     $data = Excel::load($path)->get();

     if($data->count() > 0)
     {
      foreach($data->toArray() as $key => $value)
      {
       foreach($value as $row)
       {
        $insert_data[] = array(
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
        );
       }
      }

      if(!empty($insert_data))
      {
       ressource::table('employees')->insert($insert_data);
      }
     }
     return back()->with('success', 'Excel Data Imported successfully.');
    }
}
