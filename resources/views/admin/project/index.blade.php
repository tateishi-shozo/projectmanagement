@extends('layouts.basic')

@section('title','プロジェクト一覧')

@section('content')
   <div class="container">
        <div class="row">
            <h2>プロジェクト</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ action('Admin\ProjectController@add') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
            <div class="col-md-8">
                <form action="{{ action('Admin\ProjectController@index') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">タイトル</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="project_name" value="{{ $cond_project_name }}">
                        </div>
                        <div class="col-md-2">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th>プロジェクト名</th>
                                <th>開始日</th>
                                <th>終了日</th>
                                <th>残日数</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($projects as $project)
                                <tr>
                                    <th>{{ $project->project_name }}</th>
                                    <td>{{ $project->start_date  }}</td>
                                    <td>{{ $project->end_date  }}</td>
                                    <td>{{ $project->getRemainingdays()  }}</td>
                                    <td>
                                        <div>
                                            <a href="{{ action('Admin\ProjectController@edit', ['id' => $project->id]) }}">編集</a>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <a href="{{ action('Admin\ProjectController@delete', ['id' => $project->id]) }}" >削除</a>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <a href="{{ action('Admin\ProjectController@assign', ['id' => $project->id]) }}" role="button" class="btn btn-primary">アサイン</a>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="hidden" name="id" value="{{ $project->id }}">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="link">
            {{ $projects->links() }}
        </div>
    </div>
@endsection
