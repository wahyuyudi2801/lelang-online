<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Good;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $qtyGood = Good::where('user_id', Auth::id())->count();
        $qtyAuction = Auction::where('user_id', Auth::id())->count();

        return Inertia::render('Users/Dashboard', [
            'goods' => $qtyGood,
            'auctions' => $qtyAuction,
        ]);
    }

    public function profile($id)
    {
        $user = User::find($id);
        return Inertia::render('Users/ProfileUser', ['user' => $user]);
    }

    public function updateProfile(Request $request, User $post)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nomor' => 'required|numeric',
            'email' => 'required|string|email|max:255',
            'address' => 'required|string',
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'url_photo' => 'nullable',
        ]);

        // logika pemberian nama url_photo
        if (empty($request->url_photo)) {
            $url_photo = NULL;
        } elseif (gettype($request->url_photo) == "object") {
            $url_photo = time() . '.' . $request->url_photo->extension();
            $path = public_path('images/users');
            if (!empty($post->url_good) && file_exists($path . '/' . $post->url_good)) {
                unlink($path . '/' . $post->url_good);
            }
        } else {
            $url_photo = $request->url_photo;
        }

        // logika password
        if(!empty($request->password)){
            $post->update([
                'name' => $request->name,
                'nomor' => $request->nomor,
                'email' => $request->email,
                'address' => $request->address,
                'password' => $request->password,
                'url_photo' => $url_photo,
            ]);
        }else{
            $post->update([
                'name' => $request->name,
                'nomor' => $request->nomor,
                'email' => $request->email,
                'address' => $request->address,
                'url_photo' => $url_photo,
            ]);
        }

        if($post){
            if(gettype($request->url_photo) == 'object'){
                $request->url_photo->move($path, $url_photo);
            }
            return Redirect::route("profile", $post->id)->with('message', 'Profile Berhasil diperbarui!');
        }
    }

    public function indexAdmin()
    {
        $qtyUsers = User::where('role_id', '!=', 1)->where('status', '>', 0)->count();
        $qtyNewUsers = User::where('role_id', '!=', 1)->where('status', 0)->count();
        $qtyGood = Good::count();
        $qtyAuction = Auction::count();

        return Inertia::render('Admin/DashboardAdmin', [
            'users' => $qtyUsers,
            'newUsers' => $qtyNewUsers,
            'goods' => $qtyGood,
            'auctions' => $qtyAuction,
        ]);
    }
}
