<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
// use Illuminate\Pagination\CursorPaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

use function PHPUnit\Framework\isEmpty;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $paginate = ((int)$request->paginate) ? (int)$request->paginate : 10;
        $search = $request->search;

        $value1 = ($request->nama) ? $request->nama : 'created_at';
        $value2 = ($request->value) ? $request->value : 'desc';

        $currentPage = ((int)$request->currentPage) ? (int)$request->currentPage : 1;
        Paginator::currentPageResolver(function() use($currentPage) {
            return $currentPage;
        });
        $users = User::orderBy($value1, $value2)
            ->where([['role_id', '!=', 1], ['id', '!=', Auth::id()]])
            ->where(
                fn ($query) =>

                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('nomor', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%")
            )
            ->paginate($paginate);

        return Inertia::render('Admin/Members', [
            'users' => $users,
            'paginasi' => (string)$paginate,
            'cari' => $request->search,
            'halamanSekarang' => $currentPage,
        ]);
    }

    public function update(Request $request, $users){
        $users = User::find($users);
        $users->status = !$users->status;
        $users->save();

        return Redirect::route('members', $request->all());
    }



    // public function asd(Request $request)
    // {
    //     (int)$paginate = ($request->paginate) ? $request->paginate : 10;
    //     $search = $request->search;

    //     $value1 = ($request->nama) ? $request->nama : 'created_at';
    //     $value2 = ($request->value) ? $request->value : 'desc';

    //     $currentPage = $request->currentPage;
    //     Paginator::currentPageResolver(function() use($currentPage) {
    //         return $currentPage;
    //     });
    //     $users = User::orderBy('created_at', 'desc')
    //         ->where([['role_id', '!=', 1], ['id', '!=', Auth::id()]])
    //         ->where(
    //             fn ($query) =>

    //             $query->where('name', 'like', "%{$search}%")
    //             ->orWhere('email', 'like', "%{$search}%")
    //             ->orWhere('nomor', 'like', "%{$search}%")
    //             ->orWhere('address', 'like', "%{$search}%")
    //         )
    //         ->orderBy($value1, $value2)
    //         ->paginate($paginate);

    //     ddd($request->all(), $users);
    // }
}
