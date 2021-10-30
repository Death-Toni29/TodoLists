@extends('index')
@php
   use App\Models\Task;
   $tasks = Task::orderBy('id', 'desc')->get();
@endphp

@section('card-container')
   <div class="btn-header d-flex justify-content-between mb-4">
      <h3>Anthony Aguilar TodoList</h3>
      <div class="task-footer ">
            <a href="{{ route('task.create'); }}" class="btn btn-primary font-weight-bold"><i class="fas fa-plus font-weight-bold"></i> Add New Task</a>
      </div>
   </div>
    <div class="row row-cols-1 row-cols-md-3 g-3 bg">
         @foreach ($tasks as $ts)
         <div class="col">
            <div class="card">
              <div class="card-body">
                  <h5 class="card-title">
                     @if ($ts->status === "Working")
                        <?php echo  $ts->title ?>
                     @elseif ($ts->status === "Done")
                        <span class="mr-5"><?php echo  $ts->title ?></span><span class="badge rounded-pill bg-warning text-dark">Finished   </span>
                     @else
                        <?php echo  $ts->title ?>
                     @endif
                  </h5>

                  <p class="card-text"><?php echo $ts->description ?></p>
                  @if ($ts->status === "Working")
                    <span class="badge rounded-pill bg-info text-dark"><?php echo $ts->status ?></span>
                  @elseif ($ts->status === "Done")
                    <span class="badge rounded-pill bg-success text-white"><?php echo $ts->status ?></span>
                  @else
                     <span class="badge rounded-pill bg-dark text-white">Null</span>
                  @endif
                  <div class="card-btns mt-4">
                     <a href="<?php echo route('task.edit', $ts->id); ?>" class="btn btn-success font-weight-bold"><i class="fas fa-plus font-weight-bold"></i> Edit</a>
                     <form class="d-inline" action="{{ route('task.destroy', $ts->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                     </form> 
                  </div>
              </div>
              <div class="card-footer">
               <small class="text-muted">Updated: <?php echo $ts->updated_at->diffForHumans(); ?></small>
             </div>
            </div>
          </div>
      @endforeach
   </div>
   @if (count($tasks) === 0) 
      <div class="alert alert-danger">
         <span>No Task Found. Please Create a Task.</span>
      </div>
   @endif
   <div class="clearfix"></div>
@endsection