<?php

namespace App\Http\Controllers;


use App\Http\Requests\WorkRequest;
use App\Models\User;
use Illuminate\Support\Facades\Log;


class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WorkRequest $request)
    {
        //リクエスト情報取得
        $endTime = $request->input('endTime');
        $startTime = $request->input('startTime');
        $details = $request->input('details');
        $employeeCode = $request->input('employeeCode');

        //usersテーブルを検索
        $user = User::selectOneByCode($employeeCode);



        $message = '入力されたコードまたはパスワードが違います。';
        //検索結果の判定
        if (is_null($user) || empty($user)) {
            $message = '入力されたコードまたはパスワードが違います。';
            return back(400) //1つ前の入力画面に戻す
                ->withInput() //入力値を保持する
                ->with([
                    'message' => $message,
                ]);
        }

        log::info($message);
        return view('comprehensive.home', ['message' => $message]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
    public function update(WorkRequest $request)
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
