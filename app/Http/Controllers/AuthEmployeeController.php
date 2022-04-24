<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use Validator;

class AuthEmployeeController extends Controller
{
     /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:employee', ['except' => ['login', 'register']]);
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $validator->setCustomMessages([
            'email.required' => 'O campo e-mail é obrigatório',
            'password.required' => 'O campo Senha é obrigatório',
            'password.min' => 'A senha deve ter no mínimo 6 caracteres',
        ]);

        if ($validator->fails()) {

            foreach (\json_decode($validator->errors(),true) as $error) {
                throw new \Exception($error[0], 422);
            }

        }

        if (! $token = auth('employee')->attempt($validator->validated())) {

            throw new \Exception("O e-mail ou senha informados estão incorretos", 401);

        }

        return $this->createNewToken($token);
    }
    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        $validator->setCustomMessages([
            'name.required' => 'O campo nome é obrigatório',
            'email.required' => 'O campo e-mail é obrigatório',
            'email.unique' => 'Já existe um usuário com o e-mail informado',
            'password.required' => 'O campo Senha é obrigatório',
            'password.min' => 'A senha deve ter no mínimo 6 caracteres',
        ]);

        if ($validator->fails()){
            foreach (\json_decode($validator->errors(),true) as $error) {
                throw new \Exception($error[0], 400);
            }
        }

        $user = Employee::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)]
                ));

        $token = auth('employee')->attempt($validator->validated());

        return $this->createNewToken($token);

    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth('employee')->logout();
        return response()->json(['res' => 'Usuário deslogado com sucesso!']);
    }
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth('employee')->refresh());
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
        return response()->json(['res'=>auth('employee')->user()]);
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'res' => [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth('employee')->factory()->getTTL() * 60,
                'user' => auth('employee')->user()
            ]
        ]);
    }
}
