<?php

namespace App\Exports;

use App\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use phpDocumentor\Reflection\Types\This;

class ResultExport implements FromCollection
{
  use Exportable;

  protected $result;


  public function __construct($result)
  {
    unset($result['heading']);
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
}
