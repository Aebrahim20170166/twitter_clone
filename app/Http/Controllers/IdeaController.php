<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idea;
class IdeaController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function create(Request $request)
    {
        $request->validate([
            'idea' =>'required|min:5|max:255',
        ]);

        $idea = Idea::create(
            [
                'content' => $request->get('idea'),
            ]
        );

        return redirect()->route('dashboard')->with('success', 'Idea Created Successfully');
    }
}
