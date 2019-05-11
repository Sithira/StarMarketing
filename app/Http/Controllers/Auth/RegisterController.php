<?php

namespace App\Http\Controllers\Auth;

use App\Services\DistributeCommissionService;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    private $parent = null;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'parent' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->after(function(\Illuminate\Validation\Validator $validator) use ($data)  {

            $this->parent = User::where('id', $data['parent'])->first();

            if (is_null($this->parent)) {
                $validator->errors()->add('parent', 'Parent not found');
            }

        }))

        return $validator;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $user = null;

        if (!is_null($this->parent) && $this->parent instanceof User) {
            $user = $this->parent->children()->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'parent_id' => $data['parent'],
                'password' => Hash::make($data['password']),
            ]);
        }

        return $user;
    }

    protected function registered(Request $request, $user)
    {
        DistributeCommissionService::getInstance()
            ->distribute($user);
    }
}
