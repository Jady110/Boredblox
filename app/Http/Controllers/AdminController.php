<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminController extends Controller
{
    public function users()
    {
        abort_unless(auth()->user()->is_admin, 403);

        $users = User::withCount('games')
            ->orderBy('name')
            ->get();

        return view('admin.users', compact('users'));
    }
}
