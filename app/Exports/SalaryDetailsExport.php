<?php

namespace App\Exports;

use App\tbl_employee_salary_generation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use DB;

class SalaryDetailsExport implements FromCollection,WithStrictNullComparison,WithHeadings,WithEvents,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

      protected $salary_generate_excel_code;

         function __construct($salary_generate_excel_code) {
                $this->salary_generate_excel_code = $salary_generate_excel_code;
                
         }

    public function collection()
    {

      //  $salary_data_array=array();
      //  $salary_data_array1=array();

        $salary_data = tbl_employee_salary_generation::where('year_month_designation_code',$this->salary_generate_excel_code)->select('emp_id','emp_name','working_day','present_day','absent_day','amt_1','amt_2','amt_3','amt_4','amt_5','amt_6','amt_7','amt_8','amt_9','amt_10')->get();

      // $first_export_data =explode("&", $salary_data->table_data);

        // foreach ($first_export_data as $key => $value) {

        //     unset($salary_data_array);
        //     $salary_data_array = array();

        //      $second_export_data =explode("~", $value);

        //       foreach ($second_export_data as $key => $value1) {
        //            array_push($salary_data_array, $value1);
        //       }

        //        array_push($salary_data_array1, $salary_data_array);  
        // }

      //    $all_salary_data= collect($salary_data_array1);

       // print_r($first_export_data);die;

        return  $salary_data;
    }

     public function headings(): array
        {

            $table_head_array = array();
             $table_head_array1 = array();
              array_push($table_head_array1, ['','','','','','ADDITION','','','DEDUCTION','','','']);

            $salary_head = tbl_employee_salary_generation::where('year_month_designation_code',$this->salary_generate_excel_code)->select('all_1','all_2','all_3','all_4','all_5','all_6','all_7','all_8','all_9','all_10')->first();

           //  $export_head =explode(",", $salary_head->table_head);

            // foreach ( $export_head as $key => $value) {

            //    array_push($table_head_array, $value);  
               
            // }

              array_push($table_head_array1, ['Employee ID','Employee Name','Working Shift','Present Shift','Absent Shift', $salary_head->all_1,$salary_head->all_2, $salary_head->all_3,$salary_head->all_4, $salary_head->all_5,$salary_head->all_6, $salary_head->all_7,$salary_head->all_8, $salary_head->all_9,$salary_head->all_10]);

             //array_push($table_head_array1, $table_head_array);


            return $table_head_array1;
        }
    
        public function registerEvents(): array
        {
            return [
                AfterSheet::class    => function(AfterSheet $event) {
    
                    $cellRange = 'A1:AK1'; // All headers
                    $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);

                    $cellRange1 = 'A2:AK2'; // All headers
                    $event->sheet->getDelegate()->getStyle($cellRange1)->getFont()->setSize(18);
                    
                },
            ];
        }
}
