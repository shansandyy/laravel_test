<?php

namespace App\Http\Controllers;

use App\Models\Product;
use  Illuminate\support\Facades\DB;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // database
        // DB::enableQueryLog();
        // $data = DB::table('sbl_team_data')
        //     ->leftJoin('sbl_teams', 'sbl_team_data.team_id', '=', 'sbl_teams.id')
        //     ->select('*')
        //     ->get();

        // $data = DB::table('sbl_team_data')
        //     ->leftJoin('sbl_teams', function ($join) {
        //         $join->on('sbl_teams.id', '=', 'sbl_team_data.team_id')
        //             ->where('sbl_teams.total_win', '>', '200');
        //     })
        //     ->select('*')
        //     ->get();

        $data = DB::table('sbl_team_data')
            ->leftJoin('sbl_teams', function ($join) {
                $join->on('sbl_teams.id', '=', 'sbl_team_data.team_id')
                    ->where('sbl_teams.total_win', '>', '200');
            })
            ->select('*');
        // ->dd();

        // $data = DB::table('owner')->insertGetId(['team_id' => '3']);


        // request
        // dump($request -> age, 10);
        // $data = $request -> all();
        // $input = $request->only(['name', 'sex']);
        // $name = $request->input('products.0.name');
        // $names = $request->input('products.*.name');
        // $newData = $this -> getData();

        // dd(DB::getQueryLog());


        DB::enableQueryLog();
        # redis 相較由 DB 快了一倍
        // dump(now());
        // for ($i = 0; $i < 50000; $i++) {
        // $product = json_decode(Redis::get('products'));  // redis
        $product = Product::with('favorite_user')->orderBy('created_at')->get();   // DB
        // }


        // dump(now());

        $requestId = (string) Str::uuid();

        // Log::withContext([
        //     'request-id' => $requestId,
        // ]);

        # logging
        // Log::info([
        //     'request-id' => $requestId,
        //     'name' => 'Leo',
        // ]);
        // Log::info(print_r(DB::getQueryLog(), true));

        Log::info('get uuid NUM:', ['request-id' => $requestId]);

        return response($product);




        // Response
        // return response()->view('welcome');
        // return response('ok');
        // return response('finish', 400);
        // return response()->json(['status' => false, 'user_data' => $data], 500);
        // return response()->redirectTo('/name');
        // return response('Hello World', 200)
        //         ->header('Content-Type', 'text/plain')        
        //         ->header('Cache-control', 'no-cache');
        // return back()->withInput();  //返回上一頁
        // return redirect()->away('https://www.google.com'); // 外部網域
        // return redirect()->action(
        //     [UserController::class, 'profile'], ['id' => 1]
        // );
    }

    /** 
     * 創建 service 
     */
    public function ShortUrlService()
    {
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
        // $data = $this->getData();
        // $postData = $request->all();
        // $data->push(collect($postData));
        // dump($data);

        // $request
        return $request;
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
        return 'id' . $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updateData = $request->all();
        $data = $this->getData();
        $idData = $data->where('id', $id)->first();
        $idData = $idData->merge(collect($updateData));
        return response($idData);
    }

    /**
     * Remove the specified resource from storage. -> merge(collect($updateData))
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->getData();
        $delData = $data->filter(function ($item) use ($id) {
            return $item['id'] != $id;
        });

        return response($delData->values());
    }

    public function getData()
    {
        return collect([
            collect([
                'id' => 1,
                'name' => 'phone',
                'num' => 'TR99'
            ]),
            collect([
                'id' => 2,
                'name' => 'air',
                'num' => 'TR66'
            ]),
            collect([
                'id' => 3,
                'name' => 'mini',
                'num' => 'TR22'
            ]),
        ]);
    }
}
