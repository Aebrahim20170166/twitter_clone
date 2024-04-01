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
        if(auth()->id() !== $idea->user_id)
        {
            abort(404);
        }

        $editing = true;

        return view('Ideas.show', compact('idea', 'editing'));
    }
    public function index()
    {
        return view('dashboard');
    }

    public function create()
    {
        $validated = request()->validate([
            'content' =>'required|min:5|max:255',
        ]);
        $validated['user_id'] = auth()->id();
        Idea::create($validated);

        return redirect()->route('dashboard')->with('success', 'Idea Created Successfully');
    }

    public function destroy(Idea $idea)
    {
        if(auth()->id() !== $idea->user_id)
        {
            abort(404);
        }

        $idea->delete();

        return redirect()->route('dashboard')->with('success', 'Item Deleted Successfully');
    }

    public function update(Idea $idea)
    {
        if(auth()->id() !== $idea->user_id)
        {
            abort(404);
        }
        
        $validated = request()->validate([
            'content' =>'required|min:5|max:255',
        ]);

        $idea->update($validated);

        return redirect()->route('ideas.show', $idea->id)->with('success', 'Idea Updated Successfully!!');
    }
}
