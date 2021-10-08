<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\HealthFacility;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $user = Auth::user();

        if (!$user->isSuperAdmin()) {
            abort(403);
        };
        $health_facilities = HealthFacility::all();
        return view('auth.register', compact('health_facilities'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user->isSuperAdmin()) {
            abort(403);
        };

        $request->validate([
            'first_name' => 'required|string|max:30|min:2',
            'middle_name' => 'nullable|string|max:30',
            'last_name' => 'required|string|max:30|min:2',
            'health_facility_id' => 'nullable|exists:health_facilities,id|integer',
            'super_admin' => 'boolean',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $health_facility =  $request->super_admin ? null : $request->health_facility_id;

        $user = User::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'health_facility_id' => $health_facility,
            'super_admin' => $request->has('super_admin'),
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);


        // dd($user);
        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
