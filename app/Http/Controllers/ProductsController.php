<?php

namespace App\Http\Controllers;

use App\Models\Keyword;
use App\Models\Photo;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admin.products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $keywords= Keyword::all();
        return view('admin.products.create',compact('keywords'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => ['required', 'between:3,255'],
            'keywords' => ['required', Rule::exists('keywords', 'id')],
            'body' => 'required',
            'price'=> ['required', 'min:0.01','max:9999999.99']
        ], [
            'name.required' => 'Name is required',
            'name.between' => 'Name between 3 and 255 char required',
            'body.required' => 'Message is required',
            'price.required'=> 'Price is required',
            'keywords.required' => 'Please check minimum one keyword'
        ]);

        //photo_id, name,price, body
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->body = $request->body;

        //photo
        // Controleert of er een bestand geüpload is in het 'photo_id' veld van het formulier.
        if ($request->hasFile('photo_id')) {
            $type = 'products'; // Definieert het type opslagdirectory.
            $originalName = $request->file('photo_id')->getClientOriginalName(); // Haalt de originele naam van het bestand op.
            $extension = $request->file('photo_id')->getClientOriginalExtension(); // Haalt de bestandsextensie op.
            $fileName = pathinfo($originalName, PATHINFO_FILENAME); // Extraheert de bestandsnaam zonder extensie.
            // Creëert een unieke bestandsnaam om conflicten te voorkomen.
            $uniqueName = $fileName . '_' . time() . '.' . $extension;

            // Slaat het bestand op in de gespecificeerde directory ('public') onder de 'users' map.
            $request->file('photo_id')->storeAs($type, $uniqueName, 'public');

            // Maakt een nieuw Photo record in de database met de unieke bestandsnaam.
            $photo = Photo::create(['file' => $uniqueName]);
            // Koppelt de nieuwe foto aan de gebruiker.
            $product->photo_id = $photo->id;
            // Slaat de nieuwe gebruiker op in de database.
            $product->save();

            // Synchroniseert eventuele rollen die aan de gebruiker zijn toegewezen.
            // Het tweede argument 'false' voorkomt het verwijderen van bestaande relaties voordat toevoegen.
           // $product->categories()->sync($request->categories, false);
            foreach($request->keywords as $keyword){
                $keywordfind = Keyword::findOrFail($keyword);
                $product->keywords()->save($keywordfind);
            }

            return redirect()->route('products.index');
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
