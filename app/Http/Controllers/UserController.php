<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile()
    {
        // return view('profile');
        $user = Auth::user();
        return view('/profile', ['user' => $user]);
    }

    public function index()
    {
        $data = User::where('status', 'active')->get();
        return view('users/index', ['data' => $data]);
    }

    public function registeredUser()
    {
        $data = User::where('status', 'inactive')->get();
        return view('users/registered-user', ['data' => $data]);
    }

    public function show($id)
    {
        $data = User::findOrFail($id);
        return view('users/show', ['data' => $data]);
    }

    public function approve($id)
    {
        User::where('id', $id)
            ->update(['status' => 'active']);
        return redirect('detail-users/' . $id)->with('success', 'Berhasil Approve User');
    }

    public function edit($id)
    {
        $data = User::findOrFail($id);
        return view('users/edit', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $data = User::findOrFail($id);
        return redirect()->route('detail-users', [$data->id])->with('success', 'Berhasil update data');
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect('users')->with('success', 'Berhasil hapus data User');
    }

    public function editClient($id)
    {
        // dd($id);
        $user = User::findOrFail($id);
        return view('client-edit', ['user' => $user]);
    }

    public function updateClient(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'phone' => 'required|max:20',
            'address' => 'required',
        ]);

        // $user = User::where('id', $id)
        //     ->update(['name' => $request->name]);
        $user = User::findOrFail($id);
        $user->update([
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect('/profile')->with('success', 'Berhasil Update User');
    }
}
