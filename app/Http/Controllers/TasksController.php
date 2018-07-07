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

      $fromLat = "25.204849";
      $fromLng = "55.270783";
      $toLat = "25.204849";
      $toLng = "55.270783";
      if($task != null)
      {
        if($task->fromLocation != null && $task->fromLocation != '')
        {
          $temp = (explode(",",$task->fromLocation));
          if(sizeof($temp) >= 2){
            $fromLat = $temp[0];
            $fromLng = $temp[1];
          }
        }

        if($task->toLocation != null && $task->toLocation != '')
        {
          $temp = (explode(",", $task->toLocation));
          if(sizeof($temp) >= 2){
            $toLat = $temp[0];
            $toLng = $temp[1];
          }
        }
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
              'form' => $task,
              'option' => []
          ]);
  }

  public function update(Request $request, $id)
  {
      $this->validate($request, [
          'status' => 'required'
      ]);

      $task = Tasks::findOrFail($id);
      $task->update($request->all());

      return response()
          ->json([
              'saved' => true
          ]);
  }
}
