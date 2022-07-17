<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(Request $request){
        $user = User::paginate(15);
        return view('dashboard.user.index', compact('users'));
    }

    public function destroy(User $user){
        
    }
    
}
