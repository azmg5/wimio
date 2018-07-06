<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tasks;
use Illuminate\Http\Response;

class TasksController extends Controller
{
  public function index()
  {
      return response()
          ->json([
              'model' => Tasks::filterPaginateOrder()
          ]);
  }

  public function create()
  {
      return response()
          ->json([
              'form' => Tasks::initialize(),
              'option' => []
          ]);
  }

  public function map($id)
  {
      $task = Tasks::findOrFail($id);

      $fromLat = "";
      $fromLng = "";
      $toLat = "";
      $toLng = "";
      if($task != null)
      {
        $temp = (explode(",",$task->fromLocation));
        $fromLat = $temp[0];
        $fromLng = $temp[1];

        $temp = (explode(",", $task->toLocation));
        $toLat = $temp[0];
        $toLng = $temp[1];
      }

      return response()
          ->json([
              'form' => array("fromLat"=>$fromLat, "fromLng"=>$fromLng, "toLat"=>$toLat, "toLng"=>$toLng)
          ]);
  }

  public function store(Request $request)
  {
      $this->validate($request, [
          'status' => 'required'
      ]);

      $task = Tasks::create($request->all());

      return response()
          ->json([
              'saved' => true
          ]);
  }

  public function show($id)
  {
      $task = Tasks::findOrFail($id);

      return response()
          ->json([
              'model' => $task
          ]);
  }

  public function edit($id)
  {
      $task = Tasks::findOrFail($id);

      return response()
          ->json([
              'form' => $customer,
              'option' => []
          ]);
  }

  public function update(Request $request, $id)
  {
      $this->validate($request, [
          'status' => 'required'
      ]);

      $customer = Tasks::findOrFail($id);
      $customer->update($request->all());

      return response()
          ->json([
              'saved' => true
          ]);
  }
}
