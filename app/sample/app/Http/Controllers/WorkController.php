<?php

namespace App\Http\Controllers;


use App\Http\Requests\WorkRequest;
use App\Http\Requests\CommonRequest;
use App\Models\User;
use App\Models\dayWorkInformation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(WorkRequest $request)
    {
        $validator = $request->getValidator();
        if ($validator->fails()) {
            // エラーが表示される
            echo $validator->getMessageBag()->first();
        }
        $responseData = [
            'message' => $validator->getMessageBag()->first()
            , 'employeeCode' => $request->input('employeeCode')

        ];



        return view('comprehensive.home', ['responseData' => $responseData]);
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
        //リダイレクト先指定のためcontrollerでバリデーション処理実装
        $validator = $request->getValidator();
        if ($validator->fails()) {
            $errorMessages = [];
            $errorMessages =  json_decode((string)$validator->getMessageBag(), true);
            log::info($errorMessages);
            log::info($errorMessages['startTime']);
            log::info($errorMessages['startTime'][0]);
            log::info($errorMessages);

            $responseData = [
                'errorMessages' => $errorMessages
                , 'employeeCode' => $request->input('employeeCode')
            ];

            return view('comprehensive.home', ['responseData' => $responseData]);
        }

        //リクエスト情報取得
        $startTime = $request->input('startTime');
        $endTime = $request->input('endTime');
        $details = $request->input('details');
        $employeeCode = $request->input('employeeCode');


        log::info($startTime);
        log::info($endTime);
        //勤務日取得
        $workDay = date('Y/m/d', strtotime($startTime));

        //勤務時間の計算
        $workTime = strtotime($endTime) - strtotime($startTime) / 60 / 60;

        //usersテーブルを検索
        $user = User::selectOneByCode($employeeCode);
        if (is_null($user) || empty($user)) {
            $errorMessage = '対象のユーザーが存在しません';
            return redirect() //1つ前の入力画面に戻す
                ->withInput() //入力値を保持する
                ->with([
                    'errorMessage' => $errorMessage,
                ]);
        }

        //日次勤怠の登録
        DB::beginTransaction();
        try {
            $dayWorkInformation = new dayWorkInformation();
            $dayWorkInformation->code = $employeeCode;
            $dayWorkInformation->day = $workDay;
            $dayWorkInformation->start_time = $startTime;
            $dayWorkInformation->end_time = $endTime;
            $dayWorkInformation->time = $workTime;
            $dayWorkInformation->details = $details;
            $dayWorkInformation->updated_by = $user->name;
            $dayWorkInformation->created_by = $user->name;

            $dayWorkInformation->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $errorMessage = '勤怠情報の登録に失敗しました';
            return redirect() //1つ前の入力画面に戻す
                ->withInput() //入力値を保持する
                ->with([
                    'errorMessage' => $errorMessage,
                ]);
        }

        $responseData = [
            'message' => '勤怠情報の登録に成功しました。', 'employeeCode' => $employeeCode
        ];

        log::info($responseData);
        return view('comprehensive.home', ['responseData' => $responseData]);
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
