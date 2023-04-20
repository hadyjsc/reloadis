<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class TransactionExport extends DefaultValueBinder implements FromArray, WithColumnFormatting, WithMapping, ShouldAutoSize, WithHeadings, WithStyles, WithEvents
{
    use Exportable;

    public function __construct($transactionDate, $typeId, $categoryId)
    {
        $this->transactionDate = $transactionDate;
        $this->typeId = $typeId;
        $this->categoryId = $categoryId;

        return $this;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        $query = DB::table('products')
        ->selectRaw('products.id, products.provider_id,providers.name, providers.color, products.price, products.fund,
            (products.fund * COUNT(CASE WHEN product_items.is_sold = true THEN product_items.id END)) as total_fund,
            COUNT(product_items.id) AS stock,
            COUNT(CASE WHEN product_items.is_sold = true THEN product_items.id END) AS sold,
            COUNT(product_items.id) - COUNT(CASE WHEN product_items.is_sold = true THEN product_items.id END) AS last_stock,
            (products.price - products.fund) * COUNT(CASE WHEN product_items.is_sold = true THEN product_items.id END) AS profit')
        ->join('product_items', 'products.id', '=', 'product_items.product_id')
        ->leftJoin('providers', 'products.provider_id', '=', 'providers.id')
        ->whereDate('product_items.sold_at', '=', $this->transactionDate);

        if ($this->typeId) {
            $query->where('categories.type_id', '=', $this->typeId)->join('categories', 'products.category_id', '=', 'categories.id');
        }

        if ($this->categoryId) {
            $query->where('products.category_id', '=', $this->categoryId);
        }

        $data = $query->groupBy(['products.id', 'products.provider_id', 'products.price', 'products.fund'])
        ->orderBy('products.provider_id')
        ->get()->toArray();

        return $data;
    }

    public function headings(): array
    {
        return [
            'Provider',
            'Stok',
            'Sisa Stok',
            'Terjual',
            'Harga',
            'Modal',
            'Total Modal',
            'Keuntungan'
        ];
    }

    public function map($report): array
    {
        return [
            $report->name,
            $report->stock,
            $report->last_stock,
            $report->sold,
            $report->price,
            $report->fund,
            $report->total_fund,
            $report->profit,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_NUMBER,
            'C' => NumberFormat::FORMAT_NUMBER,
            'D' => NumberFormat::FORMAT_NUMBER,
            'E' => '"Rp. "#,##0',
            'F' => '"Rp. "#,##0',
            'G' => '"Rp. "#,##0',
            'H' => '"Rp. "#,##0',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $headerRange = 'A1:'.$event->sheet->getHighestColumn().'1';
                $cellRange = 'A1:'.$event->sheet->getHighestColumn().''.$event->sheet->getHighestRow();
                $event->sheet->getDelegate()->getStyle($headerRange)->getFont()->setSize(14);
                $event->sheet->getStyle($headerRange)->applyFromArray([
                    'fill' => array(
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['argb' => 'e2e2e2']
                    )
                ]);
                $event->sheet->getStyle($cellRange)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);
            },
        ];
    }

}
