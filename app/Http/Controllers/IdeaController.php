<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idea;
class IdeaController extends Controller
{
    public function show(Idea $idea)
    {
        return view('Ideas.show', compact('idea'));
    }

    public function edit(Idea $idea)
    {
        $editing = true;

        return view('Ideas.show', compact('idea', 'editing'));
    }
    public function index()
    {
        return view('dashboard');
    }

    public function create()
    {
        request()->validate([
            'content' =>'required|min:5|max:255',
        ]);

        $idea = Idea::create(
            [
                'content' => request()->get('content'),
            ]
        );

        return redirect()->route('dashboard')->with('success', 'Idea Created Successfully');
    }

    public function destroy(Idea $idea)
    {
        $idea->delete();

        return redirect()->route('dashboard')->with('success', 'Item Deleted Successfully');
    }

    public function update(Idea $idea)
    {
        request()->validate([
            'content' =>'required|min:5|max:255',
        ]);

        $idea->content = request()->get('content', '');

        $idea->save();

        return redirect()->route('ideas.show', $idea->id)->with('success', 'Idea Updated Successfully!!');
    }
}
