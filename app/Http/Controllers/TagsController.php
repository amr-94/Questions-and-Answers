<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Models\Tags;

use Illuminate\Support\Str;

class TagsController extends Controller
{
    public function __construct()
    {


            $this->middleware('auth');




    }
public function index(){
             $tag =tags::paginate(5);

         return view('tags.index',[
             'title'=> 'Tags List',
             'tags' => $tag ,
         ]);

    }


public function create(){
           return view('tags.create',[
               'tagid'=> new tags()
           ]);

         }

public function store(TagRequest $request){



               tags::create([
            'name' => $request->input('name'),
            'slug' => str::slug($request->name),
        ]);
         return redirect('/tags')->with('success', 'Tag created');

         }

public function edit($id){

            $tagid= tags::findorfail($id);

            return view('tags.edite',[
                'tagid'=>$tagid ,
                ]) ;



         }
 public function update(TagRequest $request ,$id ){

                 $tagid = tags::findorfail($id);
                  $tagid->update([
                      'slug' => str::slug($request->name),
                      'name' => $request->name,
                      ]);


                return redirect('/tags')->with('success','Tag updated');

         }


 public function destroy($id){

                   tags::destroy($id);

              return redirect('/tags')->with('success','Tag deleted');
         }




}
