<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use phpDocumentor\Reflection\Types\This;

class resultSheets implements WithMultipleSheets
{
  use Exportable;

  private $result;

  function __construct($result)
   {
     $this->result = $result;
   }

  public function sheets(): array
  {
    $res = [];
    foreach ($this->result as $key => $value){
      $res[] = new ResultExport($key, $value);
    }
   // dd($res);
    return $res;
  }
}
