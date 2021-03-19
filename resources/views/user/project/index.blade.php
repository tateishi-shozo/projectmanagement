@extends('layouts.basic')

@section('title','プロジェクト一覧')

@section('content')
   <div class="container">
        <div class="row">
            <h2>プロジェクト</h2>
        </div>
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>プロジェクト名</th>
                                <th>開始日</th>
                                <th>終了日</th>
                                <th>残日数</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->projects as $user_project)
                                <tr>
                                    <th>{{ $user_project->project_name }}</th>
                                    <td>{{ $user_project->start_date  }}</td>
                                    <td>{{ $user_project->end_date  }}</td>
                                    <td>{{ $user_project->getRemainingdays()  }}</td>
                                    <td>
                                        <div>
                                            <a href="{{ action('User\DialyController@create', ['id' => $user_project->id]) }}" role="button" class="btn btn-primary">日報作成</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
