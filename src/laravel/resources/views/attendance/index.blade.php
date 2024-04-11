<!-- index.blade.php -->
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>勤怠記録</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">勤怠記録</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('attendance.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="clock_in">出勤時間</label>
                                <input type="time" class="form-control" name="clock_in" value="{{ old('clock_in') }}"
                                    required min="00:00" max="23:59">
                            </div>
                            <div class="form-group">
                                <label for="clock_out">退勤時間</label>
                                <input type="time" class="form-control" name="clock_out"
                                    value="{{ old('clock_out') }}" required min="00:00" max="23:59">
                            </div>
                            <div class="form-group">
                                <label for="work_details">作業内容</label>
                                <textarea class="form-control" name="work_details" required>{{ old('work_details') }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">保存</button>
                        </form>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-header">勤怠記録</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>日付</th>
                                    <th>出勤時間</th>
                                    <th>退勤時間</th>
                                    <th>作業内容</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendances as $attendance)
                                    <tr>
                                        <td>{{ $attendance['work_date'] }}</td>
                                        <td>{{ $attendance['clock_in'] }}</td>
                                        <td>{{ $attendance['clock_out'] }}</td>
                                        <td>{{ $attendance['work_details'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
