@extends('index')
@php
   use App\Models\Task;
   $tasks = Task::orderBy('id', 'desc')->get();
@endphp

@section('card-container')
    <div class="btn-header d-flex justify-content-between mb-4">
        <h3>Edit Task</h3>
        <div class="task-footer">
           <a href="<?php echo route('index'); ?>" class="btn btn-primary font-weight-bold"><i    class="fas fa-plus font-weight-bold"></i> All Task</a>
        </div>
    </div>
    <div class="card card-body p-4">
            <form action="{{ route('task.update', $task->id); }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                  <label for="title" class="form-label">Task Name</label>
                  <input type="text" class="form-control" id="title" name="title" value="<?php echo $task->title; ?>">
                </div>
                <div class="mb-3">
                    <label for="desccription" class="form-label">Description</label>
                    <textarea type="text" class="form-control" id="description" name="description" placeholder="Description..." rows="5"><?php echo $task->description; ?></textarea>
                </div>
                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0">Status</legend>
                    <div class="col-sm-10">
                        @foreach ($status_option as $status)
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status" value="<?php echo $status['value']; ?>" {{ ($task->status === $status['value'])? "checked" : "" }}>
                        <label class="form-check-label" for="<?php echo $status['label']; ?>">
                            <?php echo $status['label']; ?>
                        </label>
                      </div>
                      @endforeach
                </fieldset>
                <button type="submit" class="btn btn-primary">SAVE</button>
            </form>
   </div>
   <div class="clearfix"></div>
@endsection