<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Keyword;
use App\Models\Photo;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $allPosts = Post::withTrashed()
            ->with(['categories','user','photo'])
            ->filter(request('search'),request('fields'))
            ->paginate(50)->appends(['search'=>request('search'), 'fields'=>request('fields')]);
        return view('admin.posts.index',[
            'allPosts'=>$allPosts,
            'fillableFields'=>Post::getFillableFields()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $keywords = Keyword::all();
        $categories = Category::all();
        return view('admin.posts.create', compact('categories','keywords'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        //
        request()->validate([
           'title'=>['required', 'between:5,255'],
           'categories'=>['required', Rule::exists('categories', 'id')],
           'body'=>'required'
        ],[
            'title.required'=> 'Titel is required',
            'title.between'=> 'Title between 5 and 255 char required',
            'body.required'=> 'Message is required',
            'categories.required'=> 'Please check minimum one category'
        ]);

        //post_id, user_id, title, body
        $post = new Post();
        $post->user_id = Auth::user()->id;
        $post->title = $request->title;
        $post->slug = Str::slug($request->title,'-');
        $post->body = $request->body;

        //photo
        // Controleert of er een bestand geüpload is in het 'photo_id' veld van het formulier.
        if ($request->hasFile('photo_id')) {
            $type = 'posts'; // Definieert het type opslagdirectory.
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
            $post->photo_id = $photo->id;
        }

        // Slaat de nieuwe gebruiker op in de database.
        $post->save();

        // Synchroniseert eventuele rollen die aan de gebruiker zijn toegewezen.
        // Het tweede argument 'false' voorkomt het verwijderen van bestaande relaties voordat toevoegen.
        $post->categories()->sync($request->categories, false);
        foreach($request->keywords as $keyword){
            $keywordfind = Keyword::findOrFail($keyword);
            $post->keywords()->save($keywordfind);
        }

        // Redirect de gebruiker terug naar de gebruikerslijstpagina na succesvolle opslag.
        return redirect()->route('posts.index')->with('status', 'Post created');
    }

    /**
     * Display the specified resource.
     */
//    public function show($id) //tem laravel 7
//    {
//        //
//        $post = Post::findOrFail($id);
//        return view('admin.posts.show',compact('post'));
//    }

    public function show(Post $post)
    {
        //
        $slug = $post->slugify($post->title);
        return view('admin.posts.show',compact('slug','post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
        $categories = Category::all();
        return view('admin.posts.edit', compact('categories','post'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        request()->validate([
            'title'=>['required', 'between:5,255'],
            'categories'=>['required', Rule::exists('categories', 'id')],
            'body'=>'required'
        ],[
            'title.required'=> 'Titel is required',
            'title.between'=> 'Title between 5 and 255 char required',
            'body.required'=> 'Message is required',
            'categories.required'=> 'Please check minimum one category'
        ]);
        $input = $request->all();
        // controle: is er een nieuwe foto tijdens het opladen?
        if($request->hasFile('photo_id')){
            $type = 'posts';
            //originele bestandsnaam: bijv dog.jpg
            $originalName = $request->file('photo_id')->getClientOriginalName();
            //extensie van dog.jpg = jpg
            $extension = $request->file('photo_id')->getClientOriginalExtension();
            // bestandsnaam zonder extensie: dog
            $fileName = pathinfo($originalName, PATHINFO_FILENAME);
            $uniqueName = $fileName . '_' .time().'.'.$extension;
            //opslaan nieuwe foto in de opgegeven bestandslocatie = $type= 'users';
            $request->file('photo_id')->storeAs($type,$uniqueName,'public');

            //verkrijg oude foto als ze bestaat
            $oldPhoto = $post->photo;
            if($oldPhoto){
                //verwijder uit de opslag
                //delete = users/1.jpg, database:1.jpg = $oldPhoto->file
                //database = record 1 met file 1.jpg
                Storage::disk('public')->delete($type.'/'.$oldPhoto->file);
                //update het fotorecord met de nieuwe bestandsnaam
                //1.jpg wordt overschreven met de nieuwe filename,nl. dog_121212.jpg
                $oldPhoto->update(['file'=>$uniqueName]);
                //update de gebruiker met de id van de bestaande fotorecord
                $input['photo_id']=$oldPhoto->id;
            }else{
                //wanneer er een placeholder is: als er geen oude foto is, maak nu een nieuwe aan
                $photo = Photo::create(['file'=>$uniqueName]);
                //update de gebruiker met de id van de bestaande fotorecord
                $input['photo_id']=$photo->id;
            }
        }
        //update user met nieuwe gegevens
        $post->update($input);
        //sync rollen
        $post->categories()->sync($request->categories,true);
        //stuur de gebruiker terug naar de lijst met gebruikers
        return redirect('/admin/posts')->with('status', 'Post updated!')->with('alert-type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
        //Post::findOrFail($id)->delete();
        //dd($post);
        try{
            $post->delete();
        }catch(ModelNotFoundException $error){
            return response()->json(['message'=>'Post not found'], 404);
        }
        return redirect()->route('posts.index')->with('status', 'Post Deleted!')->with('alert-type', 'danger');
        //redirect('/admin/posts');
    }

    public function indexByAuthor(User $author){
        $allPosts = $author->posts()->paginate(20);
        return view('admin.posts.index',compact('allPosts'));
    }
    public function restore(Post $post){

        $post->onlyTrashed()->restore();
        //Post::onlyTrashed()->where('id',$id)->restore();
        return redirect()->route('posts.index')->with('status', 'Post Restored!')->with('alert-type', 'warning');
    }
    //frontend.post
     public function post(Post $post){
        // Eager load the relations
        $post = Post::with(['comments.user.photo', 'comments.user', 'photo', 'categories'])->find($post->id);
        return view('post', compact('post'));
    }

}
