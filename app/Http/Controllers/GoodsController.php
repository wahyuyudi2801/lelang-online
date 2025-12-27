<?php

namespace App\Http\Controllers;

use App\Models\Good;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use function GuzzleHttp\Promise\all;
use function PHPUnit\Framework\isEmpty;

class GoodsController extends Controller
{
    // back end e front end
    public function barang(Request $request, $param)
    {
        if ($param == "all") {
            $barang = DB::table('goods')
                ->leftJoin('categories', 'goods.category_id', '=', 'categories.id')
                ->leftJoin('users', 'goods.user_id', '=', 'users.id')
                ->select('goods.id', 'goods.good_name', 'goods.url_good', 'categories.category_name', 'goods.open_price')
                ->where('users.status', 1)
                ->orderBy('goods.created_at', 'desc')
                ->get();
            } else {
                $barang = DB::table('goods')
                ->leftJoin('categories', 'goods.category_id', '=', 'categories.id')
                ->leftJoin('users', 'goods.user_id', '=', 'users.id')
                ->select('goods.id', 'goods.good_name', 'goods.url_good', 'categories.category_name', 'goods.open_price')
                ->where('users.status', 1)
                ->where('categories.category_name', $param)
                ->orderBy('goods.created_at', 'desc')
                ->get();
            // dd($param);
        }

        $categories = DB::table('categories')
            ->select('*')
            ->orderBy('category_name', 'asc')
            ->get();

        return Inertia::render("Front/DaftarLelangAc", [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'goods' => $barang,
            'categories' => $categories
        ]);
    }

    // back end e pelelang
    public function index(Request $request)
    {
        $paginate = ($request->show) ? (int)$request->show : 10;
        $search = $request->search;
        $field = ($request->field) ? $request->field : "goods.created_at";
        $listing = ($request->listing) ? $request->listing : "desc";

        $currentPage = ((int)$request->currentPage) ? (int)$request->currentPage : 1;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $goods = DB::table('goods')
            ->leftJoin('categories', 'goods.category_id', '=', 'categories.id')
            ->select('goods.id', 'goods.good_name', 'goods.open_price', 'goods.closing_date', 'goods.url_good', 'categories.category_name')
            ->where("goods.user_id", Auth::id())
            ->where(
                fn ($query) =>
                $query->where('goods.good_name', 'like', "%{$search}%")
                    ->orWhere('categories.category_name', 'like', "%{$search}%")
                    ->orWhere('goods.open_price', 'like', "%{$search}%")
                    ->orWhere('goods.closing_date', 'like', "%{$search}%")
            )
            ->orderBy($field, $listing)
            ->paginate($paginate);

        return Inertia::render("Users/BarangLelang", [
            "goods" => $goods,
            "show" => (string)$paginate,
            "search" => $search,
            "currentPage" => $currentPage,
        ]);
    }

    public function create()
    {
        $categories = Category::orderBy('category_name', 'asc')->get();

        return Inertia::render("Users/TambahBarangLelang", [
            'categories' => $categories,
            'status' => true
        ]);
    }

    public function store(Request $request)
    {
        // set validation
        $request->validate([
            'category_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'good_name' => 'required|string',
            'open_price' => 'required|numeric',
            'closing_date' => 'required|date',
            'url_good' => 'required',
            'description' => 'required|string'
        ]);

        // set name file & path file
        $nameImg = time() . '.' . $request->url_good->extension();
        $path = public_path('images');

        // create goods
        $post = Good::create([
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
            'good_name' => $request->good_name,
            'open_price' => $request->open_price,
            'closing_date' => $request->closing_date,
            'url_good' => $nameImg,
            'description' => $request->description
        ]);

        if ($post) {
            // update field qty in table categories
            $countGoods = Good::where('category_id', $request->category_id)->count();
            $category = Category::find($request->category_id);
            $category->qty = $countGoods;
            $category->save();

            // move file image
            $request->url_good->move($path, $nameImg);
            return Redirect::route('tambahBarang')->with('message', 'Data Berhasil Disimpan!');
        }
    }

    public function edit(Good $post)
    {
        // get first data table goods
        // $good = Good::where("id", $id)->first();
        // get category to input select category
        $categories = Category::orderBy('category_name', 'asc')->get();
        // if data good == null (jika data table good tidak ada)
        if ($post === null) {
            return Inertia::render("NotFound");
        }
        return Inertia::render("Users/EditBarangLelang", [
            "good" => $post,
            "categories" => $categories,
        ]);
    }

    public function update(Request $request, Good $post)
    {
        $request->validate([
            'category_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'good_name' => 'required|string',
            'open_price' => 'required|numeric',
            'closing_date' => 'required|date',
            'url_good' => 'required',
            'description' => 'required|string'
        ]);

        // ambil data yang akan di-update
        // $update = Good::find($id);

        if (gettype($request->url_good) == "object") {
            $nameImg = time() . '.' . $request->url_good->extension();
            $path = public_path('images');
            if (!empty($post->url_good) && file_exists($path . '/' . $post->url_good)) {
                unlink($path . '/' . $post->url_good);
            }
        } else {
            $nameImg = $request->url_good;
        }

        $post->update([
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
            'good_name' => $request->good_name,
            'open_price' => $request->open_price,
            'closing_date' => $request->closing_date,
            'url_good' => $nameImg,
            'description' => $request->description
        ]);


        if ($post) {
            if (gettype($request->url_good) == "object") {
                $request->url_good->move($path, $nameImg);
            }
            return Redirect::route("auctionItem")->with('message', 'Data Berhasil Di-update!');
        }
    }

    public function destroy($id)
    {
        // find post by ID
        $post = Good::findOrfail($id);
        // get category id in post
        $categoryID = $post->category_id;
        // create path images
        $path = public_path('images');

        // check file is exists
        if (!empty($post->url_good) && file_exists($path . '/' . $post->url_good)) {
            // delete image in path images
            unlink($path . '/' . $post->url_good);
        }
        // delete post
        $post->delete();

        if($post){
            // count category id in Good where category id in post
            $countGoods = Good::where('category_id', $categoryID)->count();

            // find category by category id by post
            $category = Category::find($categoryID);
            // update qty category
            $category->qty = $countGoods;
            $category->save();

            return redirect()->route('auctionItem')->with('message', 'Data Berhasil Dihapus!');
        }
    }
}
