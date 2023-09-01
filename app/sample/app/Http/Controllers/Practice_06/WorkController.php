<?php

namespace App\Http\Controllers\Practice_06;

use App\Http\Controllers\Controller;
use App\Http\Requests\Practice_06\WorkRequest;
use App\Http\Requests\Practice_06\GetWorkInfoRequest;
use App\Models\User;
use App\Models\DayWorkInformation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GetWorkInfoRequest $request)
    {
        $month = data_get($request, 'month', null);
        $employeeCode = session('code');

        //返却値初期設定
        $responseData = [];
        $responseData['employeeCode'] = $employeeCode;

        //リダイレクト先指定のためcontrollerでバリデーション処理実装
        $validator = $request->getValidator();
        if ($validator->fails()) {
            $validations =  json_decode((string)$validator->getMessageBag(), true);
            return response()->view('practice_06.home',['responseData' => $responseData, 'validations' => $validations], 422);
        }

        //users存在判定
        if (self::isExistUser($employeeCode)) {
            $errorMessage = '対象のユーザーが存在しません';
            return response()->view('practice_06.home', ['responseData' => $responseData, 'errorMessage' => $errorMessage], 400);
        }

        //入力値で勤怠情報を取得
        log::info($month);
        $workInfo = DayWorkInformation::getMonthWorkInfo($employeeCode, $month)
        ->withPath('/practice_06/work/get');

        log::info($workInfo);
        $responseData = [
            'employeeCode' => $employeeCode, 'workInfo' => $workInfo, 'workMonth' => $month
        ];

        return view('practice_06.home', ['responseData' => $responseData]);
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
        //返却値初期設定
        $responseData = [];
        $employeeCode = session('code');
        $responseData['employeeCode'] = $employeeCode;

        //リダイレクト先指定のためcontrollerでバリデーション処理実装
        $validator = $request->getValidator();
        if ($validator->fails()) {
            $validations =  json_decode((string)$validator->getMessageBag(), true);
            $responseData['workInfo'] = DayWorkInformation::getMonthWorkInfo($employeeCode);
            return response()->view('practice_06.home',['responseData' => $responseData, 'validations' => $validations], 422);
        }

        //リクエスト情報取得
        $startTime = $request->input('startTime');
        $endTime = $request->input('endTime');
        $details = $request->input('details');
        $employeeCode = $request->input('employeeCode');

        //勤務日取得
        $workDay = date('Y/m/d', strtotime($startTime));

        //勤務時間の計算
        $workTime = (strtotime($endTime) - strtotime($startTime)) / 60;

        //users存在判定
        if (self::isExistUser($employeeCode)) {
            $errorMessage = '対象のユーザーが存在しません';
            return response()->view('practice_06.home', ['responseData' => $responseData, 'errorMessage' => $errorMessage], 400);
        }

        //日次勤怠の登録
        DB::beginTransaction();
        $user = User::selectOneByCode($employeeCode);
        try {
            $dayWorkInformation = new DayWorkInformation();
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
            $responseData['errorMessage']  = '勤怠情報の登録に失敗しました';
            return response()->view(
                'practice_06.home',
                [
                    'responseData' => $responseData
                ],
                500
            );
        }

        $responseData['message'] =  '勤怠情報の登録に成功しました。';
        $responseData['workInfo'] = DayWorkInformation::getMonthWorkInfo($employeeCode)
        ->withPath('/practice_06/work/get');
        log::info($responseData);
        return view('practice_06.home', ['responseData' => $responseData]);
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


    /**
     * isExistUser
     *
     * @param  mixed $employeeCode
     * @return bool
     */
    private  function isExistUser(string $employeeCode)
    {
        //users存在判定
        $user = User::selectOneByCode($employeeCode);
        return (is_null($user) || empty($user));
    }
}
