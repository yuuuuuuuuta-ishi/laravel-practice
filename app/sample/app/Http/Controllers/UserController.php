<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GetUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //返却値初期設定
        $responseData = [];


        $users = User::getAll();

        $responseData = [
            'users' => $users
        ];

        log::info($responseData);

        return view('user.index', ['responseData' => $responseData]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function get(GetUserRequest $request)
    {
        //リクエスト情報取得
        $code = $request->input('code');


        //usersテーブルを検索
        $user = User::selectOneByCode($code);

        //検索結果の判定
        if (is_null($user) || empty($user)) {
            $responseData = [
                'errorMessage' => '社員は存在しません'
            ];
            return view('user.edit', ['responseData' => $responseData]);
        }

        $responseData = [
            'user' => $user
        ];

        log::info($responseData);

        return view('user.edit', ['responseData' => $responseData]);
    }

    /**
     * Display the specified resource.
     */
    public function show(GetUserRequest $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
