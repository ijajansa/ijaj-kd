<?php

namespace App\Exports;

use App\Models\Report;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class UsersExport implements FromCollection,WithHeadings,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data=Report::with('user')->get(['id', 'name', 'mobile_number', 'barcode_detail', 'booking_date', 'status']);
        foreach($data as $key=>$ans)
        {
            $ans['id']= ++$key;
            if($ans->status==1)
            {
                $ans['status']= 'Booked';                
            }
            else if($ans->status==2)
            {
                $ans['status']= 'Pending';                
            }

        }
        return $data;
    }
    
    public function headings(): array
    {

        return [
            'Id',
            'Customer Name',
            'Customer Contact Number',
            'Before Work Latitude & Longitude',
            'Before Work Image',
            'After Work Latitude & Longitude',
            'After Work Image',
            'Address',
            'Created Date',
            'Updated Date',
        ];

    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
   
                $event->sheet->getDelegate()->getStyle('A1:G1')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)->setWrapText(true);
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(5);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(40);
                $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('G')->setWidth(10);
   
            },
        ];
    }
}
