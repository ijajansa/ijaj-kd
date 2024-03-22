<?php

namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class PdfExport implements FromCollection,WithHeadings,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data=Booking::where('status','!=',0)->orderBy('booking_date','ASC')->get(['id', 'name', 'email', 'mobile_number', 'address', 'booking_date', 'status']);
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
            'Name',
            'Email',
            'Mobile Number',
            'Address',
            'Booking Date',
            'Status',
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
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(15);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(20);   
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(20);   
                $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(15);   
            },
        ];
    }
}
