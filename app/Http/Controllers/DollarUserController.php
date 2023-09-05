<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DollarUser;
use Illuminate\Support\Carbon;

class DollarUserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function getDollarUser()
    {
        $dollar_user = DollarUser::where('user_id', \Auth::user()->id)
                        ->where('created_at', Carbon::now()->today()->format('y-m-d'))
                        ->orderBy('id', 'desc')
                        ->first();
        
        return $dollar_user;
    }

    public function save (Request $request)
    {
        $validate = $this->validate($request, [
            'dollar_user' => ['required', 'regex:/[0-9.,]+/'],
            'dollar_user_cash' => ['nullable', 'regex:/[0-9.,]+/']
        ]);

        //Almaceno las variables despues de ser validadas
        $dollar_user = $request->input('dollar_user');
        $dollar_user_cash = $request->input('dollar_user_cash');

        //Instancio los objetos involucrados
        $user = \Auth::user();
        $dollarUser = new DollarUser();

        //Asigno los nuevos datos al objeto
        $dollarUser->user_id = $user->id;
        $dollarUser->dolar_user_transference = $dollar_user;
        $dollarUser->dollar_user_cash = '';
        $dollarUser->created_at = date('Y-m-d')."00:00:00";

        if  (!$dollar_user_cash==NULL) {
            $dollarUser->dollar_user_cash = $dollar_user_cash;
        }

        $dollarUser->save();

        return redirect('/')->with([
            'message' => 'Tasa dia actualizada con exito'
        ]);
    }
}
