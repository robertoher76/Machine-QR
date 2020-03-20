<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    public $loginAfterSignUp = true;

    public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $jwt_toke = null;
        if(!$jwt_toke = JWTAuth::attempt($input))
        {
            return response()->json([
                'status' => 'invalid_credentials',
                'message' => 'Correo o contraseña no validos.',                
            ], 401);
        }

        return response()->json([
            'status' => 'ok',
            'toke' => $jwt_toke,
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return response()->json(compact('token'));
    }

    public function register(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        if($this->loginAfterSignUp)
        {
            return $this->login($request);
        }

        return response()->json([
            'status' => 'ok',
            'data' => $user
        ], 200);
    }

    public function getAuthenticatedUser()
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
        return response()->json(compact('user'));
    }

    public function logout(Request $request){
        $this->validate($request, [
            'token' => 'required'
        ]);

        try{
            JWTAuth::invalidate($request->token);
            return response()->json([
                'status' => 'ok',
                'message' => 'Cierre de sesión exitosa.'
            ]);
        }catch(JWTException $ex){
            return response()->json([
                'status' => 'unknow_error',
                'message' => 'Al usuario no se le puedo cerrar la sesión.'
            ], 500);
        }
    }

    protected function jsonResponse($data, $code = 200)
    {
        return response()->json($data, $code,['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
    }
}
