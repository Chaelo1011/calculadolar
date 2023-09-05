<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Business;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;

class BusinessController extends Controller
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
    

    public function get ()
    {
        $business = Business::where('user_id', \Auth::user()->id);

        return $business;
    }

    public function create ()
    {
        return view('business.create');
    }

    public function save (Request $request)
    {
        #Check for already registered business
        if (count(\Auth::user()->business)>0) {
            return redirect('registrar-negocio')->with(['message' => 'Ya tienes un negocio registrado']);
        }


        #Validate
        $validate = $this->validate($request, [
            'logo' => ['nullable', 'mimes:jpg,jpeg,png,gif'],
            'rif' => ['required', 'regex:/[A-Za-z0-9-]+/'],
            'name' => ['required', 'regex:/[A-Za-z0-9. ]+/'],
            'state' => ['required', 'regex:/[A-Za-z. ]+/'],
            'city' => ['required', 'regex:/[A-Za-z. ]+/'],
            'address' => ['required', 'regex:/[A-Za-z. ]+/'],
            'description' => ['nullable', 'regex:/[A-Za-z. ]+/']
        ]);

        #Set Variables
        $logo = $request->file('logo');
        $rif = $request->input('rif');
        $name = $request->input('name');
        $state = $request->input('state');
        $city = $request->input('city');
        $address = $request->input('address');
        $description = NULL;

        if ($request->input('address')!=NULL) {
            $description = $request->input('description');
        }

        #Instance required objects
        $business = new Business();
        $user = \Auth::user();

        #Set Object
        $business->user_id = $user->id;
        $business->rif = $rif;
        $business->name = $name;
        $business->state = $state;
        $business->city = $city;
        $business->address = $address;
        $business->description = $description;

        #Put logo on disk business (previous configuration on config/filesystems)
        if ($logo) {
            $image_path_name = time().$logo->getClientOriginalName();

            Storage::disk('business')->put($image_path_name, File::get($logo));
            
            $business->logo_path = $image_path_name;
        }

        #Save Object
        $business->save();

        #Redirect
        return redirect('/')->with([
            'message' => 'Negocio registrado con éxito'
        ]);

    }

    #No cualquiera puede acceder a esta funcion, pendiente
    public function edit ($id)
    {
        $business = Business::find($id);
        if ($business && $business->user_id == \Auth::user()->id) {
            return view('business.edit', [
                'business' => $business
            ]);
        }
        
        return redirect('/');
        
    }


    public function getLogo ($filename)
    {
        $file = Storage::disk('business')->get($filename);
        return new Response($file, 200);
    }


    public function update(Request $request, $id)
    {
        #Instance required objects
        $business = Business::find($id);
        $user = \Auth::user();

        if ($business && $business->user_id==$user->id) {
            $validate = $this->validate($request, [
                'logo' => ['nullable', 'mimes:jpg,jpeg,png,gif'],
                'rif' => ['required', 'regex:/[A-Za-z0-9-]+/'],
                'name' => ['required', 'regex:/[A-Za-z0-9. ]+/'],
                'state' => ['required', 'regex:/[A-Za-z. ]+/'],
                'city' => ['required', 'regex:/[A-Za-z. ]+/'],
                'address' => ['required', 'regex:/[A-Za-z. ]+/'],
                'description' => ['nullable', 'regex:/[A-Za-z. ]+/']
            ]);
    
            #Set Variables
            $logo = $request->file('logo');
            $rif = $request->input('rif');
            $name = $request->input('name');
            $state = $request->input('state');
            $city = $request->input('city');
            $address = $request->input('address');
            $description = NULL;
    
            if ($request->input('address')!=NULL) {
                $description = $request->input('description');
            }
        
            #Set Object
            $business->rif = $rif;
            $business->name = $name;
            $business->state = $state;
            $business->city = $city;
            $business->address = $address;
            $business->description = $description;

            
    
            #Put logo on disk business (previous configuration on config/filesystems)
            if ($logo) {
                $image_path_name = time().str_replace(' ', '', $logo->getClientOriginalName());
                
                Storage::disk('business')->put($image_path_name, File::get($logo));
                
                $business->logo_path = $image_path_name;
            }
    
            #Update Object
            $business->update();
    
            #Redirect
            return redirect()->route('business.edit', $business->id)->with([
                'message' => 'Se han guardado los cambios'
            ]);
        }

        #id missmatch, retrieving true id using user model
        foreach ($user->business as $businesss) {
            $id_business = $businesss->id;
        }
        #redirect to edit view with true data and showing a message
        return redirect()->route('business.edit', $id_business)
                        ->with(['message' => 'Ha ocurrido un error inesperado']);

    }
}
