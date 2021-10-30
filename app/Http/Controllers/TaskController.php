<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('card-content'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Create New Task
        $status_option = [
            [
                'label' => 'Working',
                'value' => 'Working',
            ],
            [
                'label' => 'Done',
                'value' => 'Done',
            ]
            ];
        return view('create', compact('status_option') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // INSERT TABLE
        $request->validate([
            'title' => 'required'
        ]);

        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->save();

        error_log($task);
        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // EDIT TABLE
        $task = Task::findOrFail($id);
        $status_option = [
            [
                'label' => 'Working',
                'value' => 'Working',
            ],
            [
                'label' => 'Done',
                'value' => 'Done',
            ]
            ];
        return view('edit', compact('status_option', 'task') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // FORM REQUEST UPDATE TABLE
        $task = Task::findOrFail($id);
        $request->validate([
            'title' => 'required'
        ]);

        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->save();

        return redirect()->route('index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // DELETE TASK FROM TABLE
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect()->route('index');
    }
}