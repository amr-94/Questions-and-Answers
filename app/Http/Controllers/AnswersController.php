<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Questions;
use App\Notifications\NewAnswerNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswersController extends Controller
{
    //
    public function store(Request $request){
        $request->validate([
            'question_id'=>['required','int','exists:questions,id'],
            'description'=>['required','string','min:5'],
        ]);
        $question=questions::findorfail($request->question_id);
        $request->merge([
            'user_id'=>Auth::id(),
        ]);
        $answer=$question->answers()->create($request->all());
        $question->user->notify(new NewAnswerNotification($question,Auth::user()));

        return redirect(route('questions.show',$question->id))->with('success','Answer Added');

    }

    public function best(Request $request ,$id)
    {
        $answer =answer::findOrfail($id);

        $question= $answer->question;
        $question->answers()->update([
            'best_answer' => 0
        ]);


        if ($answer->best_answer === 0){
             $answer ->forcefill([
                    'best_answer'=> 1,
                     ])->save();
                  return redirect(route('questions.show', $answer->question->id))->with('success', 'Answer marked as best');

               }

           else {
              $answer ->forcefill([
            'best_answer'=> 0,
            ])->save();
            return redirect(route('questions.show', $answer->question->id))->with('success', 'Answer Unmarked as best');


        }


    }


       public function destroy($id){
        $answer= answer::findorfail($id);
        $answer->destroy($id);
        return redirect(route('questions.show', $answer->question->id))->with('success','Answer Deleted');

    }
}
