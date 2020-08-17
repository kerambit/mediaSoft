<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Checklist;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    protected $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        $this->user = Auth::user();

        return view('home')->with('user', $this->user);
    }

    /**
     * Show the user dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->user = Auth::user();
        $user = new User();

        if ($this->user->cannot('index', $user)){
            return redirect()
                ->back()
                ->with('status', 'У вас нет прав');
        }

        $users = User::all();

        return view('user.index')->with('users', $users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->user = Auth::user();

        if ($this->user->cannot('edit', $user)){
            return redirect()
                ->back()
                ->with('status', 'У вас нет прав');
        }

        $user->load('checklists', 'tasks');

        $roles = Role::all();

        return view('user.edit')->with(['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->user = Auth::user();

        if ($this->user->cannot('update', $user)){
            return redirect()
                ->back()
                ->with('status', 'У вас нет прав');
        }

        $validatedData = $request->validate([
            'name' => 'required|max:45',
            'checklist_limit' => 'required'
        ]);

        $user->update($validatedData);

        return redirect()
            ->route('user.index')
            ->with('status', 'Пользователь был успешно отредактирован');
    }

    /**
     * Deny access to user.
     *
     * @param  \App\User
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->user = Auth::user();

        if ($this->user->cannot('destroy', $user)){
            return redirect()
                ->back()
                ->with('status', 'У вас нет прав');
        }

        $user->banned = true;
        $user->save();

        return redirect()
            ->route('user.index')
            ->with('status', 'Пользователь заблокирован');
    }

    /**
     * Restore access to user.
     *
     * @param  \App\User
     * @return \Illuminate\Http\Response
     */
    public function restore(User $user)
    {
        $this->user = Auth::user();

        if ($this->user->cannot('restore', $user)){
            return redirect()
                ->back()
                ->with('status', 'У вас нет прав');
        }

        $user->banned = false;
        $user->save();

        return redirect()
            ->route('user.index')
            ->with('status', 'Пользователь разблокирован');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User $user
     * @param  \App\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function showChecklist(User $user, Checklist $checklist)
    {
        $this->user = Auth::user();

        if ($this->user->cannot('showChecklist', $user)){
            return redirect()
                ->back()
                ->with('status', 'У вас нет прав');
        }

        $user->load('checklists');

        $checklist->load('tasks');

        return view('user.showChecklist')->with(['checklist' => $checklist, 'user' => $user]);
    }
}
