<?php

namespace App\Http\Controllers;

use App\Checklist;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ChecklistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $checklist = Checklist::where('user_id', $user->id)->get();

//        return response()->json($checklist, 200, [], JSON_UNESCAPED_UNICODE);

        return view('checklist.index')->with('checklist', $checklist);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('checklist.create');
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

        $user = Auth::user();

        $validatedData['user_id'] = $user->id;

        Checklist::create($validatedData);

        return redirect()
            ->route('checklist.index')
            ->with('status', 'Список создан');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function show(Checklist $checklist)
    {
        $checklist->load('tasks');

        return view('checklist.show')->with('checklist', $checklist);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function edit(Checklist $checklist)
    {
        return view('checklist.edit')->with('checklist', $checklist);
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

        return redirect()
            ->route('checklist.show', $checklist->id)
            ->with('status', 'Список был отредактирован');
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

        return redirect()
            ->route('checklist.index')
            ->with('status', 'Список удален');
    }

    /**
     * Store a new task.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeTasks(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'text' => 'required|max:45',
            'checklist_id' => 'required',
            'user_id' => Rule::in($user->id),
        ]);

        $validatedData['checked'] = 0;

        Task::create($validatedData);

        return redirect()
            ->route('checklist.show', $request->input('checklist_id'))
            ->with('status', 'Пункт был внесен в список');
    }

    /**
     * Update the tasks.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateTasks(Request $request)
    {
        $tasks = Task::where('checklist_id', $request->checklist_id)->get();

        foreach ($tasks as $task){
            if (array_key_exists($task->id, $request->checked)){
                $task->checked = true;
                $task->save();
            } else {
                $task->checked = false;
                $task->save();
            }
        }

        return redirect()
        ->route('checklist.show', $request->checklist_id)
        ->with('status', 'Список был обновлен!');
    }

    /**
     * Show the form for editing the specified task.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function editTask(Task $task)
    {
        return view('task.edit')->with('task', $task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function updateTask(Request $request, Task $task)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'text' => 'required|max:45',
            'text' => 'required|max:45',
            'checklist_id' => 'required',
            'user_id' => Rule::in($user->id),
            'checked' => 'required'
        ]);

        $task->update($validatedData);

        return redirect()
            ->route('checklist.show', $task->checklist_id)
            ->with('status', 'Пункт был отредактирован');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function destroyTask(Task $task)
    {
        $task->delete();

        return redirect()
            ->route('checklist.index')
            ->with('status', 'Пункт удален');
    }
}
