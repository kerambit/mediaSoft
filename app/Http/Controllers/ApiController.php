<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Checklist;
use App\Task;

class ApiController extends Controller
{
    protected $user;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->user = Auth::user();

        $checklist = Checklist::where('user_id', $this->user->id)->get();

        return response()
            ->json($checklist, 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:45',
        ]);

        $this->user = Auth::user();

        $this->user->load('checklists');

        if ($this->user->checklist_limit == count($this->user->checklists)){
            return response()
                ->json('You reached ur checklist limit', 405);
        }

        $validatedData['user_id'] = $this->user->id;

        $checklist = Checklist::create($validatedData);

        return response()
            ->json($checklist, 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function show(Checklist $checklist)
    {
        $this->user = Auth::user();

        if ($checklist->user_id != $this->user->id) {
            return response()
                ->json('Forbidden', 403);
        }

        $checklist->load('tasks');

        return response()
            ->json($checklist, 201, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Checklist $checklist)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:45',
        ]);

        $checklist->update($validatedData);

        return response()
            ->json($checklist, 201, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Checklist $checklist)
    {
        $checklist->delete();

        return response()
            ->json('Checklist deleted', 204, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Store a new task.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeTask(Request $request)
    {
        $this->user = Auth::user();

        $validatedData = $request->validate([
            'text' => 'required|max:45',
            'checklist_id' => 'required'
        ]);

        $validatedData['checked'] = 0;
        $validatedData['user_id'] = $this->user->id;

        Task::create($validatedData);

        $checklist = Checklist::where('id', $validatedData['checklist_id'])->with('tasks')->get();

        return response()
            ->json($checklist, 201, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Update task.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function updateTask(Request $request, Task $task)
    {
        $validatedData = $request->validate([
            'text' => 'required|max:45',
            'checked' => 'required'
        ]);

        $task->update($validatedData);

        return response()
            ->json($task, 201, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Remove the task.
     *
     * @param  \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function destroyTask(Task $task)
    {
        $task->delete();

        return response()
            ->json('Task deleted', 204, [], JSON_UNESCAPED_UNICODE);
    }
}
