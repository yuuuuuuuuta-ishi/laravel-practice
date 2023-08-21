<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GetUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(request $request)
    {
        //返却値初期設定
        $responseData = [];

        $message = data_get($request, 'message', null);


        $users = User::getAll();

        $responseData = [
            'users' => $users
        ];
        if(is_null($message )){
            $responseData['message'] = $message;
        }

        log::info($responseData);

        return view('user.index', ['responseData' => $responseData]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CreateUserRequest $request)
    {
        $name = $request->input('name');
        $age = $request->input('age');
        $branch = $request->input('branch');
        $department = $request->input('department');
        $post = $request->input('post');
        $entryDate = $request->input('entryDate');

        //コードの採番
        $codeLatest = (int)User::getLatestCode();
        $code = str_pad($codeLatest++, 5, 0, STR_PAD_LEFT);

        //データの更新
        DB::beginTransaction();
        try {
            $user = new User();
            $user->code = $code;
            $user->name = $name;
            $user->age = $age;
            $user->branch = $branch;
            $user->department = $department;
            $user->post = $post;
            $user->entry_date = $entryDate;
            $user->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $responseData = [
                'errorMessage' => 'データの登録に失敗しました。'
                ,'user' => $user
            ];
            return response()->view(
                'user.create',
                [
                    'responseData' => $responseData
                ],
                500
            );
        }

        //返却値初期設定
        $responseData = [];
        $users = User::getAll()->withPath('/user');
        $responseData = [
            'users' => $users, 'message' => '社員コード : ' . $code . ' のデータを更新しました。'
        ];

        log::info($responseData);

        return view('user.index', ['responseData' => $responseData]);
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
    public function show()
    {
        return view('user.create');
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
    public function update(UpdateUserRequest $request)
    {

        $code = $request->input('code');
        $name = $request->input('name');
        $age = $request->input('age');
        $branch = $request->input('branch');
        $department = $request->input('department');
        $post = $request->input('post');
        $entryDate = $request->input('entryDate');

        //usersテーブルを検索
        $user = User::selectOneByCode($code);

        //検索結果の判定
        if (is_null($user) || empty($user)) {
            $responseData = [
                'errorMessage' => '社員は存在しません'
            ];
            return response()->view('user.edit', ['responseData' => $responseData], 400);
        }

        //データの更新
        DB::beginTransaction();
        try {

            $user->code = $code;
            $user->name = $name;
            $user->age = $age;
            $user->branch = $branch;
            $user->department = $department;
            $user->post = $post;
            $user->entry_date = $entryDate;
            $user->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $responseData = [
                'errorMessage' => 'データの更新に失敗しました。'
                ,'user' => $user
            ];
            return response()->view(
                'user.edit',
                [
                    'responseData' => $responseData
                ],
                500
            );
        }

        //返却値初期設定
        $responseData = [];
        $users = User::getAll()->withPath('/user');
        $responseData = [
            'users' => $users, 'message' => '社員コード : ' . $code . ' のデータを更新しました。'
        ];

        log::info($responseData);

        return view('user.index', ['responseData' => $responseData]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
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
            return response()->view('user.edit', ['responseData' => $responseData], 400);
        }

        //データの削除
        DB::beginTransaction();
        try {
            $user->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $responseData['errorMessage']  = 'データの削除に失敗しました';
            return response()->view(
                'comprehensive.home',
                [
                    'responseData' => $responseData
                ],
                500
            );
        }

        return Route::Get('/user');
        //返却値初期設定
        $responseData = [];
        $users = User::getAll();
        $responseData = [
            'users' => $users, 'message' => '社員コード : ' . $code . ' のデータを削除しました。'
        ];

        log::info($responseData);

        return view('user.index', ['responseData' => $responseData]);
    }
}
