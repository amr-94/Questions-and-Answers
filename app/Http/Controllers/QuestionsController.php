<?php

namespace App\Http\Controllers;

use App\Models\Questions;
use App\Models\Tags;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    public function index()
    {
        $search = request('search');


        $questions = questions::with('user')
            ->withCount('answers')
            ->where('title', 'like', '%' . $search . '%')
            ->orWhereHas('tags', function ($q) use ($search) {
                return $q->where('name', 'like', '%' . $search . '%');
            })
            ->orWhereHas('user', function ($q) use ($search) {
                return $q->where('name', 'like', '%' . $search . '%');
            })
            ->latest()






            ->paginate(3);
        return view('questions.index', [
            'questions' => $questions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = tags::all();
        return view('questions.create', [
            'tags' => $tags
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'img' => ['nullable', 'image'],
            'tags' => ['required', 'array'],
        ]);


        $request->merge([

            'user_id' => Auth::id(),


        ]);

        $questions = questions::create($request->all());
        $questions->tags()->attach($request->input('tags'));

        return redirect()->route('questions.index')
            ->with('success', 'Question Add');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $questions =  questions::findorfail($id);
        $answer = $questions->answers()->latest()->with('user')->get();
        return view('questions.show', [
            'question' => $questions,
            'answer' => $answer
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tags = tags::all();
        $questions =  questions::findorfail($id);
        $question_tag = $questions->tags()->pluck('id')->toArray();
        return view('questions.edit', [
            'question' => $questions,
            'tags' => $tags,
            'question_tag' => $question_tag,

        ]);
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
        $request->validate([
            'title' => ['required', 'string', 'max:255', "unique:questions,title,$id"],
            'description' => ['required', 'string', "unique:questions,description,$id"],
            'status' => ['in:open,close'],
            'img' => ['nullable', 'image'],
            'tags' => ['required', 'array'],
        ]);

        $questions = questions::findorfail($id);
        $prev = $questions->img;

        if ($request->hasfile('q_img')) {
            $fileName = time() . '.' . $request->q_img->extension();
            $request->q_img->move(public_path('images/q_img'), $fileName);

            $request->merge([
                'img' => $fileName
            ]);
        }

        $questions->update($request->all());
        $questions->tags()->sync($request->tags);
        if ($prev && $prev  !== $request->q_img) {
            File::delete(public_path('images/q_img' . '/' . $prev));
        }
        return redirect(route('questions.show', $questions->id))->with('success', 'Question updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        questions::destroy($id);
        return redirect(route('questions.index'))->with('success', 'Question Delete');
    }
}