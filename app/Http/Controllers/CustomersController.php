<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Customer;
use Yajra\DataTables\Facades\DataTables;

class CustomersController extends Controller
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



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customers.index');
    }


    /**
     * Get the customers data and prepares it to the DataTable.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        if (Auth::check() ) {
            $customers = Customer::where('business_id', Auth::user()->business[0]->id)
                            ->select('id', 'idn', 'name', 'surname', 'phone_number', 'address')
                            ->orderBy('id', 'desc')
                            ->get();

            $data = DataTables::collection($customers)
                                ->addColumn('btn', 'customers.dt.buttons' )
                                ->editColumn('name', function(Customer $customer) {
                                    return $customer->name.' '.$customer->surname;
                                })
                                ->rawColumns(['btn'])
                                ->toJson();

            return $data;
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Return a view as a response to an Ajax request
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $this->validate($request, [
            'ci' => ['required', 'numeric', 'regex:/[0-9]+/'],
            'name' => ['required', 'string'],
            'surname' => ['required', 'string'],
            'phone_number' => ['nullable', 'numeric', 'regex:/[0-9]+/'],
            'address' => ['nullable', 'string']
        ]);

        $idn = $request->input('ci');
        $name = $request->input('name');
        $surname = $request->input('surname');
        $phone_number = $request->input('phone_number');
        $address = $request->input('address');

        $customer = new Customer();
        
        if ( Auth::check() && Auth::user()->business[0]->user_id == Auth::id() ) {
            $customer->idn = $idn;
            $customer->name = $name;
            $customer->surname = $surname;
            $customer->phone_number = $phone_number;
            $customer->address = $address;
            $customer->business_id = Auth::user()->business[0]->id;

            $customer->save();
            return redirect()->route('customers.index')->with(['message' => 'Cliente registrado con éxito']);
        }

        return redirect()->route('customers.index')->with(['message' => 'Ha ocurrido un error']);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);
        if ( Auth::check() && $customer && $customer->business_id == Auth::user()->business[0]->id) {
            return view('customers.show', [
                'customer' => $customer
            ]);
        }

        return "Ha ocurrido un error";
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        if ( Auth::check() && $customer && $customer->business_id == Auth::user()->business[0]->id) {
            return view('customers.edit', [
                'customer' => $customer
            ]);
        }

        return "Ha ocurrido un error";
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        if ( Auth::check() && $customer && $customer->business_id == Auth::user()->business[0]->id ) {
            $validate = $this->validate($request, [
                'ci' => ['required', 'numeric', 'regex:/[0-9]+/'],
                'name' => ['required', 'string'],
                'surname' => ['required', 'string'],
                'phone_number' => ['nullable', 'numeric', 'regex:/[0-9]+/'],
                'address' => ['nullable', 'string']
            ]);

            $idn = $request->input('ci');
            $name = $request->input('name');
            $surname = $request->input('surname');
            $phone_number = $request->input('phone_number');
            $address = $request->input('address');
            
            $customer->idn = $idn;
            $customer->name = $name;
            $customer->surname = $surname;
            $customer->phone_number = $phone_number;
            $customer->address = $address;

            $customer->update();
            return redirect()->route('customers.index')->with(['message' => 'Cliente editado con éxito']);
        }

        return redirect()->route('customers.index')->with(['message' => 'Ha ocurrido un error']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        if ( Auth::check() && $customer && $customer->business_id == Auth::user()->business[0]->id ) {
            $customer->delete();
            return redirect()->route('customers.index')->with(['message' => 'Cliente eliminado con éxito']);
        }

        return redirect()->route('customers.index')->with(['message' => 'Ha ocurrido un error']);
    }
}
