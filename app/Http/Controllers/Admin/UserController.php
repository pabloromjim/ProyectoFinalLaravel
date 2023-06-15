<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class UserController extends Controller
{

    public function __construct()
    {
        //Checkea solo accede admin a las funciones
        $this->middleware('admin')->only(['create', 'edit', 'index', 'show', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = User::all();

        return view('backEnd.admin.user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backEnd.admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {

        $this->validate($request, ['name' => 'required|string|max:255', 'email' => 'required|string|email|max:255|unique:users', 'password' => 'required|string|min:6|', 'score' => 'required|numeric', 'role' => 'required|in:user,admin']);
        User::create(['name' => $request->input('name'), 'email' => $request->input('email'), 'password' => bcrypt($request->input('password')), 'score' => $request->input('score'), 'role' => $request->input('role')]);

        // User::create($request->all());
        // dd($request->all());

        Session::flash('message', 'Usuario añadido!');
        Session::flash('status', 'success');

        return redirect('panel');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('backEnd.admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('backEnd.admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update($id, Request $request)
    {

        //Validate same email for same id
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'required|string|min:6',
            'score' => 'required|numeric',
            'role' => 'required|in:user,admin',
        ]);

        $user = User::findOrFail($id);
        $user->update(['name' => $request->input('name'), 'email' => $request->input('email'), 'password' => bcrypt($request->input('password')), 'score' => $request->input('score'), 'role' => $request->input('role')]);
        Session::flash('message', 'Usuario actualizado!');
        Session::flash('status', 'success');

        return redirect('panel');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        Session::flash('message', 'Usuario eliminado!');
        Session::flash('status', 'success');

        return redirect('panel');
    }
}
