<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ResultExport implements FromCollection
{
  use Exportable;

  protected $result;

  public function __construct($result)
  {
    $this->$result = $result;
  }

  /**
   * @return \Illuminate\Support\Collection
   */
  public function collection()
  {
   return User::all()->collect();
    dd();
  }

  /*public function sheets(): array
  {
    return [$this->collection()];
  }*/
}
