<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaLikeContoller extends Controller
{
    public function like(Idea $idea)
    {
        $liker = auth()->user();

        $liker->likes()->attach($idea);

        return redirect()->route('dashboard')->with('success', "Liked Successfully");
        // $user = auth()->user();
        // //$idea = Idea::find(request('idea_id'));
        // $user->likes()->attach($idea->id);
        // return back();
    }

    public function unlike(Idea $idea)
    {
        $liker = auth()->user();

        $liker->likes()->detach($idea);

        return redirect()->route('dashboard')->with('success', "Liked Successfully");
    }
}
