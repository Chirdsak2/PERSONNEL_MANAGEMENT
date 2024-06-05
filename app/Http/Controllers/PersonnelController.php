<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonnelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = User::query();

        // Check if name is provided in the search form
        if ($request->has('name') && !empty($request->name)) {
            $query->where(function($q) use ($request) {
                $q->where('firstname', 'like', '%' . $request->name . '%')
                  ->orWhere('lastname', 'like', '%' . $request->name . '%')
                  ->orWhere(DB::raw("CONCAT(firstname, ' ', lastname)"), 'like', '%' . $request->name . '%');
            });
        }
        

        // Check if position_id is provided in the search form
        if ($request->has('position_id') && !empty($request->position_id)) {
            $query->where('position_id', $request->position_id);
        }

        $users = $query->paginate(10);
        $positions = Position::all(); // Assuming you have a Position model to get all positions

        return view('managePersonel', compact('users', 'positions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('addPersonnel');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        //  dd($request);
        $filename = '';
        if ($request->hasfile('user_picture')) {
            $file = $request->file('user_picture');

            $extension = $file->getClientOriginalExtension();
            $filename = date('YmdHi') . bin2hex(random_bytes(8)) . '.' . $extension;
            $file->move(public_path('/uploads'), $filename);
        }

        $user = User::create([
            'prefix_id' => $request->prefix_id,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'address' => $request->address,
            'position_id' => $request->position_id,
            'group_id' => $request->group_id,
            'username' => $request->username,
            'password' => $request->password,
            'user_picture' => $filename
        ]);


        //  dd($user->id);
        return redirect('managePersonel');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::where('id', '=', $id)->first();
        return view('detailPersonnel')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $user = User::where('id', '=', $id)->first();
        return view('editPersonnel')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //dd($request,$id);
        // Find the user by id
        $user = User::findOrFail($id);

        // Initialize the filename with the existing user picture filename
        $filename = $user->user_picture;

        // Check if a new picture is uploaded
        if ($request->hasfile('user_picture')) {
            $file = $request->file('user_picture');
            $extension = $file->getClientOriginalExtension();
            $filename = date('YmdHi') . bin2hex(random_bytes(8)) . '.' . $extension;
            $file->move(public_path('/uploads'), $filename);

            // Optionally delete the old picture if it exists
            if (!empty($user->user_picture) && file_exists(public_path('/uploads') . '/' . $user->user_picture)) {
                unlink(public_path('/uploads') . '/' . $user->user_picture);
            }
        }

        // Update user with new data
        $user->update([
            'prefix_id' => $request->prefix_id,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'address' => $request->address,
            'position_id' => $request->position_id,
            'group_id' => $request->group_id,
            'username' => $request->username,
            'password' => $request->password, // Note: consider hashing the password if it's not already hashed
            'user_picture' => $filename
        ]);

        // Redirect to the managePersonel page
        return redirect('managePersonel');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //  dd($id);
        // Find the user by id
        $user = User::findOrFail($id);

        // Optionally delete the user's picture if it exists
        if (!empty($user->user_picture) && file_exists(public_path('/uploads') . '/' . $user->user_picture)) {
            unlink(public_path('/uploads') . '/' . $user->user_picture);
        }

        // Delete the user
        $user->delete();

        // Redirect to the managePersonel page
        return redirect('managePersonel');
        // return redirect('managePersonel')->with('success', 'User deleted successfully');
    }

    /* ตรวจสอบ Username ซ้ำ */
    public function validateUsername(Request $request){
        $username = $request->query('username');
        $exists = User::where('username', $username)->exists();

        return response()->json(['exists' => $exists]);
    }
}
