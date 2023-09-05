<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;
use App\Product;
use App\Product_Catalog;
use App\DollarUser;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ProductsController extends Controller
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


    public function index()
    {
        /* $products = Product::where('user_id', \Auth::user()->id)
                ->orderBy('id', 'desc')
                ->get(); */

        return view('products.index');
    }

    public function getAll()
    {
        $model = Product::where('user_id', \Auth::user()->id)
            ->orderBy('id', 'desc')
            ->get();

        $bs_day = DollarUser::where('user_id', \Auth::user()->id)
            ->where('created_at', Carbon::now()->today()->format('y-m-d'))
            ->orderBy('id', 'desc')
            ->first();
            
        $data = DataTables::collection($model)
            ->addColumn('btn', 'products.dt.buttons')
            ->addColumn('bs_day', $bs_day)
            ->addColumn('bs_sale_price', 'products.dt.bsPrice')
            ->editColumn('name', function(Product $product) {
                return $product->name." ".$product->brand." ".$product->measurement."".$product->unit_of_measurement; 
            })
            ->editColumn('dollar_sale_price', function(Product $product) {
                return floatval($product->dollar_sale_price)."$";
            })
            ->rawColumns(['btn', 'bs_sale_price'])
            ->toJson();

        return $data;
    }

    public function getProductImage($filename)
    {
        /* $user = \Auth::user();
        $product = Product::where('user_id', $user->id)
                        ->where('id', $id)
                        ->first();
        
        if ($user && $product->user_id==$user->id) {

        } */

        #  REVISAR TODA LA FUNCION PORQUE LAS IMAGENES ESTAN EN OTRA ENTIDAD
        #///////////////////////////////////////////////////////////////////////
        
        $file = Storage::disk('products')->get($filename);
        return new Response($file, 200);
    }

    public function create()
    {
        return view('products.create');
    }

    public function save(Request $request)
    {
        $validate = $this->validate($request, [
            'image' => ['nullable', 'mimes:jpg,jpeg,png'],
            'image1' => ['nullable', 'mimes:jpg,jpeg,png'],
            'image2' => ['nullable', 'mimes:jpg,jpeg,png'],
            'name' => ['required', 'string'],
            'brand' => ['required', 'string'],
            'measurement' => ['nullable', 'numeric', 'regex:/[0-9.,]+/'],
            'measurement_unit' => ['nullable', 'string'],
            'dollar_buy_price' => ['required', 'numeric', 'regex:/[0-9,.]+/'],
            'unit_quantity' => ['required', 'numeric', 'regex:/[0-9,.]+/'],
            'units_in_stock' => ['required', 'numeric', 'regex:/[0-9,.]+/'],
            'profit' => ['required', 'numeric', 'regex:/[0-9]{1,3}/'],
            'dollar_sale_price' => ['required', 'numeric', 'regex:/[0-9,.]+/'],
            'bs_sale_price' => ['required', 'numeric', 'regex:/[0-9,.]+/'],
            'bsEfect_sale_price' => ['nullable', 'numeric', 'regex:/[0-9,.]+/'],
            'wholesale_profit' => ['nullable', 'numeric', 'regex:/[0-9]{1,3}/'],
            'wholesale_dollar_sale_price' => ['nullable', 'numeric', 'regex:/[0-9,.]+/'],
            'wholesale_bs_sale_price' => ['nullable', 'numeric', 'regex:/[0-9,.]+/'],
            'wholesale_bsE_sale_price' => ['nullable', 'numeric', 'regex:/[0-9,.]+/'],
        ]);

        $image1 = $request->file('image');
        $image2 = $request->file('image1');
        $image3 = $request->file('image2');

        $name = $request->input('name');
        $brand = $request->input('brand');
        $measurement = $request->input('measurement');
        $unit_measurement = $request->input('unit_measurement');
        $dollar_buy_price = $request->input('dollar_buy_price');
        $unit_quantity = $request->input('unit_quantity');
        $units_in_stock = $request->input('units_in_stock');
        $profit = $request->input('profit');

        $dollar_sale_price = $request->input('dollar_sale_price');
        $bs_sale_price = $request->input('bs_sale_price');
        $bsEfect_sale_price = $request->input('bsEfect_sale_price');

        $wholesale_profit = $request->input('wholesale_profit');
        $wholesale_dollar_sale_price = $request->input('wholesale_dollar_sale_price');
        $wholesale_bs_sale_price = $request->input('wholesale_bs_sale_price');
        $wholesale_bsE_sale_price = $request->input('wholesale_bsE_sale_price');

        $user = \Auth::user();
        $product = new Product();

        if ($user && $user->business[0]->user_id == $user->id) {
            $product->name = $name;
            $product->brand = $brand;
            $product->measurement = $measurement;
            $product->unit_of_measurement = $unit_measurement;
            $product->dollar_buy_price = $dollar_buy_price;
            $product->unit_quantity = $unit_quantity;
            $product->unit_stock = $units_in_stock;
            $product->profit = $profit;

            $product->dollar_sale_price = $dollar_sale_price;

            $product->wholesale_profit = $wholesale_profit;
            $product->dollar_wholesale_price = $wholesale_dollar_sale_price;

            $product->user_id = $user->id;

            $product->save();
            echo "Producto guardado";

            $productSaved = Product::where('user_id', $user->id)
                ->orderBy('id', 'desc')
                ->first();
            var_dump($productSaved);

            if ($productSaved && ($image1 || $image2 || $image3)) {

                for ($i = 1; $i <= 3; $i++) {
                    if (!is_null(${'image' . $i})) {
                        $catalog = new Product_Catalog();

                        $image_path_name = time() . ${'image' . $i}->getClientOriginalName();

                        Storage::disk('products')->put($image_path_name, File::get(${'image' . $i}));

                        $catalog->image_path = $image_path_name;
                        $catalog->product_id = $productSaved->id;

                        $catalog->save();
                    }
                }

                return redirect()->route('products.index')->with(['message' => 'Producto creado exitosamente']);
            }

            return redirect()->route('products.index')->with(['message' => 'Ocurrió un error al registrar las imágenes']);
        }

        return redirect()->route('products.index')->with(['message' => 'Ha ocurrido un error inesperado']);
    }


    public function show ($id)
    {
        $user = \Auth::user();
        $product = Product::where('user_id', $user->id)
                        ->where('id', $id)
                        ->get();
                        
        $bs_day = DollarUser::where('user_id', \Auth::user()->id)
            ->where('created_at', Carbon::now()->today()->format('y-m-d'))
            ->orderBy('id', 'desc')
            ->first();

        if ($product && $product[0]->user_id==$user->id) {
            return view('products.show', ['product'=>$product, 'bsDay' => $bs_day]);
        }
        
        return 'Error';
    }


    public function edit ($id)
    {
        $user = \Auth::user();
        $product = Product::where('user_id', $user->id)
                        ->where('id', $id)
                        ->first();
        
        $bs_day = DollarUser::where('user_id', \Auth::user()->id)
            ->where('created_at', Carbon::now()->today()->format('y-m-d'))
            ->orderBy('id', 'desc')
            ->first();

        if ($product && $product->user_id==$user->id) {
            return view('products.edit', ['product'=>$product, 'bsDay' => $bs_day]);
        }
        
        return 'Error';
    }

    public function update (Request $request,$id)
    {
        //Obtengo el registro a editar y el usuario que lo solicita
        $product = Product::find($id);
        $user = \Auth::user();

        if ($product && $product->user_id==$user->id) {
            $validate = $this->validate($request, [
            'image' => ['nullable', 'mimes:jpg,jpeg,png'],
            'image1' => ['nullable', 'mimes:jpg,jpeg,png'],
            'image2' => ['nullable', 'mimes:jpg,jpeg,png'],
            'name' => ['required', 'string'],
            'brand' => ['required', 'string'],
            'measurement' => ['nullable', 'numeric', 'regex:/[0-9.,]+/'],
            'measurement_unit' => ['nullable', 'string'],
            'dollar_buy_price' => ['required', 'numeric', 'regex:/[0-9,.]+/'],
            'unit_quantity' => ['required', 'numeric', 'regex:/[0-9,.]+/'],
            'units_in_stock' => ['required', 'numeric', 'regex:/[0-9,.]+/'],
            'profit' => ['required', 'numeric', 'regex:/[0-9]{1,3}/'],
            'dollar_sale_price' => ['required', 'numeric', 'regex:/[0-9,.]+/'],
            'bs_sale_price' => ['required', 'numeric', 'regex:/[0-9,.]+/'],
            'bsEfect_sale_price' => ['nullable', 'numeric', 'regex:/[0-9,.]+/'],
            'wholesale_profit' => ['nullable', 'numeric', 'regex:/[0-9]{1,3}/'],
            'wholesale_dollar_sale_price' => ['nullable', 'numeric', 'regex:/[0-9,.]+/'],
            'wholesale_bs_sale_price' => ['nullable', 'numeric', 'regex:/[0-9,.]+/'],
            'wholesale_bsE_sale_price' => ['nullable', 'numeric', 'regex:/[0-9,.]+/'],
            ]);

            $image1 = $request->file('image');
            $image2 = $request->file('image1');
            $image3 = $request->file('image2');

            $name = $request->input('name');
            $brand = $request->input('brand');
            $measurement = $request->input('measurement');
            $unit_measurement = $request->input('unit_measurement');
            $dollar_buy_price = $request->input('dollar_buy_price');
            $unit_quantity = $request->input('unit_quantity');
            $units_in_stock = $request->input('units_in_stock');
            $profit = $request->input('profit');

            $dollar_sale_price = $request->input('dollar_sale_price');
            $bs_sale_price = $request->input('bs_sale_price');
            $bsEfect_sale_price = $request->input('bsEfect_sale_price');

            $wholesale_profit = $request->input('wholesale_profit');
            $wholesale_dollar_sale_price = $request->input('wholesale_dollar_sale_price');
            $wholesale_bs_sale_price = $request->input('wholesale_bs_sale_price');
            $wholesale_bsE_sale_price = $request->input('wholesale_bsE_sale_price');

            if ($user && $user->business[0]->user_id == $user->id) {
                $product->name = $name;
                $product->brand = $brand;
                $product->measurement = $measurement;
                $product->unit_of_measurement = $unit_measurement;
                $product->dollar_buy_price = $dollar_buy_price;
                $product->unit_quantity = $unit_quantity;
                $product->unit_stock = $units_in_stock;
                $product->profit = $profit;

                $product->dollar_sale_price = $dollar_sale_price;

                $product->wholesale_profit = $wholesale_profit;
                $product->dollar_wholesale_price = $wholesale_dollar_sale_price;

                $product->user_id = $user->id;

                $product->update();

                /* $productSaved = Product::where('user_id', $user->id)
                    ->orderBy('id', 'desc')
                    ->first();
                var_dump($productSaved); */

                if ( $image1 || $image2 || $image3 ) {
                    for ($i=1; $i <= 3; $i++) { 
                        if ( ${'image'.$i} ) {
                            //Verificar si existe en la bd la imagen en esa posicion
                            $product_catalog = Product_Catalog::where('position', $i)->get();

                            if ($product_catalog) {
                                //Actualizar la imagen en esa posicion
                                $product_update = Product_Catalog::find('position', $i);

                                $image_path_name = time() . ${'image' . $i}->getClientOriginalName();

                                Storage::disk('products')->put($image_path_name, File::get(${'image' . $i}));

                                $product_update->image_path = $image_path_name;

                                $product_update->update();

                            } else {

                                //Crear imagen en esa posicion

                                $catalog_new = new Product_Catalog();
                                
                                $image_path_name = time() . ${'image' . $i}->getClientOriginalName();

                                Storage::disk('products')->put($image_path_name, File::get(${'image' . $i}));

                                $catalog_new->image_path = $image_path_name;
                                $catalog_new->product_id = $product->id;
                                $catalog_new->position = $i;

                                $catalog_new->save();
                            }
                        }
                    }

                    return redirect()->route('products.index')->with(['message' => 'Se registraron las imágenes']);
                }

                return redirect()->route('products.index')->with(['message' => 'Ocurrió un error al registrar las imágenes']);
                    
            }

            return redirect()->route('products.index')->with(['message' => 'Ha ocurrido un error inesperado']);
        }

        return redirect()->route('products.index')->with(['message' => 'Ha ocurrido un error inesperado']);
        
    }



    public function getCatalogImage($filename) {
        $file = Storage::disk('products')->get($filename);
        return new Response($file, 200);
    }


    public function delete ($id)
    {
        $product = Product::find($id);
        $user = \Auth::user();

        if ($product && $user && $product->user_id==$user->id) {
            
            $product->delete();
            return redirect()->route('products.index')->with(['message' => 'Producto eliminado exitosamente']);
        }

        return redirect()->route('products.index')->with(['message' => 'Ocurrió un error al eliminar el producto']);
    }

}
