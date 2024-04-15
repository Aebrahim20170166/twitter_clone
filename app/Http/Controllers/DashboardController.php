<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use App\Models\Idea;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {

        //return new WelcomeEmail(auth()->user());

        $ideas = Idea::orderBy('created_at', 'DESC');

        if(request()->has('search'))
        {
            $ideas = $ideas->where('content', 'LIKE', '%'. request('search'). '%');
        }
        return view('dashboard', ['ideas' => $ideas->paginate(5)]);
    }
}
