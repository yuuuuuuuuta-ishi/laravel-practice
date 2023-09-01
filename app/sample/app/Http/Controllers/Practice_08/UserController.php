<?php

namespace App\Http\Controllers\Practice_08;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Practice_08\GetUserRequest;
use App\Http\Requests\Practice_08\UpdateUserRequest;
use App\Http\Requests\Practice_08\CreateUserRequest;
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

        return view('practice_08.index', ['responseData' => $responseData]);
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
        $codeLatest = User::getLatestCode();
        $codeInt = (int)$codeLatest->code;
        log::info($codeInt);
        $code = str_pad($codeInt++, 5, 0, STR_PAD_LEFT);

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
                'practice_08.create',
                [
                    'responseData' => $responseData
                ],
                500
            );
        }

        //返却値初期設定
        $responseData = [];
        $users = User::getAll()->withPath('/Practice_08/user');
        $responseData = [
            'users' => $users, 'message' => '社員コード : ' . $code . ' のデータを更新しました。'
        ];

        log::info($responseData);

        return view('practice_08.index', ['responseData' => $responseData]);
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
            return view('practice_08.edit', ['responseData' => $responseData]);
        }

        $responseData = [
            'user' => $user
        ];

        log::info($responseData);

        return view('practice_08.edit', ['responseData' => $responseData]);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return view('practice_08.create');
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
            return response()->view('practice_08.edit', ['responseData' => $responseData], 400);
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
                'practice_08.edit',
                [
                    'responseData' => $responseData
                ],
                500
            );
        }

        //返却値初期設定
        $responseData = [];
        $users = User::getAll()->withPath('/Practice_08/user');
        $responseData = [
            'users' => $users, 'message' => '社員コード : ' . $code . ' のデータを更新しました。'
        ];

        log::info($responseData);

        return view('practice_08.index', ['responseData' => $responseData]);
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
            return response()->view('practice_08.edit', ['responseData' => $responseData], 400);
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
                'practice_08.index',
                [
                    'responseData' => $responseData
                ],
                500
            );
        }

        //返却値初期設定
        $responseData = [];
        $users = User::getAll();
        $responseData = [
            'users' => $users, 'message' => '社員コード : ' . $code . ' のデータを削除しました。'
        ];

        log::info($responseData);

        return view('practice_08.index', ['responseData' => $responseData]);
    }
}
