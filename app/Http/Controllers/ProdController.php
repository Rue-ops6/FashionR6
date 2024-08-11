<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Traits\Common;

class ProdController extends Controller
{
    use Common;


    /*    #1)
     * Display a listing of the resource.
     */
    public function LatestProds()
    {
        /* 
        #SELECT * FROM `products` ORDER BY updated_at DESC limit 3;
        */
        #$products = Product::orderBy('updated_at', 'desc')->limit(3)->get();
        $prods = Product::where('pub', 1)
        ->orderBy('updated_at', 'DESC')
        ->limit(3)
        ->get();

        return view('fashiondex', compact('prods'));
    }

    /*    #2)
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('prod-add');
    }

    /*    #3)
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request);

        #validation:
        $data = $request->validate([
            'prodTitle' => "required|string",
            'price' => "required|decimal:0,3",
            'description' => "required|string|max:1000",
            'image' => "required|mimes:png,jpg,jpeg|max:2048",
        ]);

        $data['pub'] = isset($request->pub);
        $data['image'] = $this->uploadFile($request->image, "assets/images");

        #dd($data);

        Product::create($data);

        return redirect()->route('prod-index');  # instead of: return "A prod was created & stored to ur DB";
    }




    /*    #4)
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $prod=Product::findOrFail($id);
        
        return view('prod-details',compact('prod'));
        }
    


  /*    #5)
         * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $prod=Product::findOrFail($id);
        // dd($prod);
            #return "prod = " . $id;
        return view('prod-edit', compact ('prod'));
        // return  $prod['id'];

    }


    
     /*    #6)
    * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {            //dd($request,$id);


                #validation:
$data = $request->validate([
    'prodTitle' => "required|string",
    'price' => "required|decimal:0,1",
    'description' => "required|string|max:1000",
    'image' => "nullable|mimes:png,jpg,jpeg|max:2048",

    #didnot work unfrotunitly: 'endTime' => "required|date_format:H:i A", even after using php artisan make:request StoreTimeRequest... strtotime didnot wok as well even after illumnte
]);

$data['pub'] = isset($request->pub); 
if($request->hasFile('image')) {
    $data['image'] = $this->uploadFile($request->image,"assets/images"); 
    }
#dd($data);

            
        //zi fi sql lw sebtaha hi3mel update * fa lazem a2wl where el prod id =$id ell d5ltoh
        Product::where('id',$id)->update($data);
        return redirect()->route('prod-index');  //return "Submitted successfully"; 
        }



      /*    #7)
     * Soft delete.
     */
    public function softdel(string $id)
    {
        // $id = $request->id;
        Product::where('id',$id)->delete();

        // return " data delete successfully";
        return redirect()->route("prod-index");   
     }


      /*    #8)
     * permenent del/ Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $id = $request->id;
        Product::where('id',$id)->forceDelete();

        // return " data delete successfully";
        return redirect()->route("prod-trashed");   
     }



    /*    #9)
     * show del.
     */
    public function showDeleted()
    {
        $prod = Product::onlyTrashed()->get();

        // return " data delete successfully";
        return view('prod-trashed', compact("prod"));
        }
        // return redirect()->route("showDeleted");
        


    /*    #10)
     * restore.
     */
    public function restore(string $id)
    {
        Product::where("id", $id)->restore();

        // return " data restored successfully";
        return redirect()->route("prod-index");        
        }



        
        }
