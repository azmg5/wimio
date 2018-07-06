<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;

class Tasks extends Model
{
  use FilterPaginateOrder;

  protected $primaryKey = 'id';

  protected $table = 'tasks';

  protected $guarded = array();

  protected $fillable = [
      'status', 'courier', 'driverName'
  ];

  // whitelist of filter-able columns
  protected $filter = [
      'id', 'courier', 'driverName', 'status',  'description', 'startedAt', 'finishedAt', 'deliveryDate', 'driverComment'
  ];

  public static function initialize()
  {
      return [
          'courier' => '', 'driverName' => '', 'status' => '', 'description' => '', 'startedAt' => '', 'finishedAt' => '', 'driverComment' => ''
      ];
  }
}
