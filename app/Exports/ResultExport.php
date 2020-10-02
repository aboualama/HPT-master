<?php

namespace App\Exports;

use App\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithTitle;
use phpDocumentor\Reflection\Types\This;

class ResultExport implements FromCollection, WithTitle,WithHeadings
{


  protected $result;
  private $sheetName;

  public function __construct($sheetName, $result)
  {
    $this->sheetName = $sheetName;
    $this->result = $result;
  }

  /**
   * @return \Illuminate\Support\Collection
   */
  public function collection()
  {

    return new Collection($this->result['data']);
  }

  /*public function sheets(): array
  {
    return [$this->collection()];
  }*/

  public function title(): string
  {eaction-SMC.blade.php
    return $this->sheetName;
  }

  public function headings(): array
  {
    return $this->result['heading'];
  }
}
