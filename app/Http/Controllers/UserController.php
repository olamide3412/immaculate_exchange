<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnums;
use App\Enums\StatusEnums;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index(Request $request){
        $orderBy = request('orderBy', 'id');
        $orderDir = request('orderDir', 'asc');

        $users = User::when($request->search, function($query) use($request){
            $query->where('name','like', '%'.$request->search.'%')
            ->orWhere('user_name','like', '%'.$request->search.'%')
            ->orWhere('email','like', '%'.$request->search.'%')
            ->orWhere('phone_number','like', '%'.$request->search.'%');
        })->orderBy($orderBy, $orderDir)->paginate(5)->withQueryString();

       // dd($users->toArray());
        return inertia('Auth/Users/Index',[
            'users' => $users,
            'searchTerm' => $request->search,
            'orderBy' => $request->orderBy,
            'orderDir' => $request->orderDir
        ]);
    }
    public function store(Request $request){

        $validatedData = $request->validate([
            'name' => ['required','max:255'],
            'phone_number' => ['nullable','max:255'],
            'user_name' => ['required','max:255','unique:users,user_name'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'role'  => ['required', new Enum(RoleEnums::class)],
            'password' => ['required','confirmed', Password::min(8)->mixedCase()->letters()->numbers()->symbols()]
        ]);

       // dd($validatedData);

         $user = User::create($validatedData);
         log_new('New user account created name: '. $user->name);
        // Auth::login($user);

         return redirect()->back()->with('message', 'User account created successfully');

    }

    public function show(User $user){
        //dd($user->toArray());
        return inertia('Auth/Users/Show',['user' => $user]);
    }

    public function update(Request $request, User $user){
        $validatedData = $request->validate([
            'name' => ['required','max:255'],
            'phone_number' => ['nullable','max:255'],
            'user_name' => ['required','max:255', Rule::unique('users', 'user_name')->ignore($user->id)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'role'  => ['required', new Enum(RoleEnums::class)],
            'status' => ['required', new Enum(StatusEnums::class)]
        ]);

        //dd($request->toArray());

        $user->update($validatedData);
        return redirect()->back()->with('success', 'User data modified successfully');
    }

    public function destroy(User $user){
        try {

            // Log the action
            log_new("Deleting $user->name (staff) record");

            // Delete user account
            $user->delete();

            // Delete staff record
            $user->delete();

            return redirect()->route('users.index')->with('success', 'User deleted successfully!');
        } catch (\Illuminate\Database\QueryException $e) {
            // Check for foreign key constraint error (SQLSTATE[23000])
            if ($e->getCode() == '23000') {
                return redirect()->route('users.index')->with('error', 'User cannot be deleted as they are associated with other records.');
            }

            // For any other errors, rethrow the exception
            throw $e;
        }
    }

    public function resetPassword(Request $request, User $user) {
        $validatedData = $request->validate([
            'password' => ['required','confirmed', Password::min(8)->mixedCase()->letters()->numbers()->symbols()]
        ]);

        $user->update([
            'password' => Hash::make($validatedData['password']),
        ]);

        return redirect()->back()->with('success', 'Password updated successfully');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->letters()->numbers()->symbols()],
        ]);
        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->back()->with('success', 'Password updated successfully');
    }

    public function profile(Request $request){
        $user = $request->user();
        return inertia('Auth/Users/Show', [
            'user' => $user,
            'isShowProfile' => true,
        ]);
    }
}
