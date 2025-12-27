<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Foundation\Application;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

class AuctionController extends Controller
{
    public function frontIndex($param)
    {
        $good = DB::table('goods')
            ->join('users', 'goods.user_id', '=', 'users.id')
            ->select('goods.*', 'users.name', 'users.url_photo')
            ->where('goods.id', $param)->first();

        $candidateTerpilih = DB::table('auctions')
            ->where('choose', 1)
            ->where('good_id', $param)
            ->count();

        if ($candidateTerpilih) {
            $auctions = DB::table('auctions')
                ->where('good_id', $param)
                ->orderBy('choose', 'desc')
                ->get();
        } else {
            $auctions = DB::table('auctions')
                ->where('good_id', $param)
                ->orderBy('bargain_price', 'desc')
                ->get();
        }

        return Inertia::render("Front/Bid", [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            "good" => $good,
            "auctions" => $auctions,
            "candidateTerpilih" => $candidateTerpilih
        ]);
    }

    public function frontStore(Request $request)
    {
        // validation
        $request->validate([
            'open_price' => 'required|numeric',
            'candidate' => 'required|string',
            'candidate_nomor' => 'required|numeric',
            'bargain_price' => [
                'required',
                'numeric',
                // validation manual/custom
                function ($attribute, $value, $fail) use($request) {
                    if ($value <= $request->open_price) {
                        $fail('The ' . str_replace(["_", "-"], " ", $attribute) . ' must be more than the open price.');
                    }
                }
            ]
        ]);

        // create Auction
        $post = Auction::create([
            'good_id' => $request->good_id,
            'user_id' => $request->user_id,
            'candidate' => $request->candidate,
            'candidate_nomor' => $request->candidate_nomor,
            'bargain_price' => $request->bargain_price
        ]);

        if ($post) {
            return Redirect::route("bid", $post->good_id)->with('message', 'Tawaran Anda berhasil dikirim!');
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginate = ($request->show) ? (int)$request->show : 10;
        $search = $request->search;
        $field = ($request->field) ? $request->field : "auctions.created_at";
        $listing = ($request->listing) ? $request->listing : "desc";

        if(session()->get('category_id')){
            $goodID = session()->get('category_id');
        }else{
            $goodID = ((int)$request->category_id) ? (int)$request->category_id : "";
        }

        $currentPage = ((int)$request->currentPage) ? (int)$request->currentPage : 1;
        Paginator::currentPageResolver(function() use($currentPage) {
            return $currentPage;
        });

        if($goodID){
            $auctions = DB::table('auctions')
            ->leftJoin('goods', 'auctions.good_id', '=', 'goods.id')
            ->select('auctions.*', 'goods.good_name', 'goods.open_price', 'goods.closing_date')
            ->where('auctions.user_id', Auth::id())
            ->where('auctions.good_id', $goodID)
            ->where(
                fn ($query) =>
                $query->where('auctions.candidate', 'like', "%{$search}%")
                ->orWhere('goods.good_name', 'like', "%{$search}%")
                ->orWhere('goods.open_price', 'like', "%{$search}%")
                ->orWhere('auctions.bargain_price', 'like', "%{$search}%")
                ->orWhere('goods.closing_date', 'like', "%{$search}%")
            )
            ->orderBy($field, $listing)
            ->paginate($paginate);

            $candidateTerpilih = Auction::where('choose', 1)->where('auctions.good_id', $goodID)->where('user_id', Auth::id())->count();
        }else{
            $auctions = [];
            $candidateTerpilih = null;
        }

        $goods = DB::table('goods')->orderBy('good_name', 'asc')
        ->select('goods.id', 'goods.good_name')
        ->where('goods.user_id', Auth::id())
        ->get();
        return Inertia::render('Users/Pelelangan', [
            'goods' => $goods,
            'goodID' => (string)$goodID,
            'auctions' => $auctions,
            'candidateTerpilih' => $candidateTerpilih,
            'show' => (string)$paginate,
            'search' => $search,
            'currentPage' => $currentPage
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Auction $post)
    {
        // dd($request->all());
        $post->choose = !$post->choose;
        $post->save();
        if ($post) {
            if ($post->choose) {
                return Redirect::route("auctions.show")->with('message', 'Kandidat berhasil terpilih!')->with('category_id', $request->category_id);
            } else {
                return Redirect::route("auctions")->with('category_id', $request->category_id);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
