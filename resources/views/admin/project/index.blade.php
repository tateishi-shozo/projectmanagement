@extends('layouts.basic')

@section('title','プロジェクト一覧')

@section('content')
   <div class="container">
        <div class="m-auto">
            <h2>プロジェクト</h2>
        </div>
        <div class="row">
            <div class="col-md-4 ">
                <a href="{{ action('Admin\ProjectController@add') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
            <div class="col-md-8">
                <form action="{{ action('Admin\ProjectController@index') }}" method="get">
                    @csrf
                    <label class="col-md-3">ブロジェクト名</label>
                        <input type="text" class="form-control" name="cond_project_name" value="{{ $cond_project_name }}">
                    <div class="float-right">
                        <select name="sort_by">
                            <option value="">更新順</option>
                            <option value="asc" {{ $sort_by=='asc' ? 'selected' : '' }}>開始日が古い順</option>
                            <option value="desc" {{ $sort_by=='desc' ? 'selected' : '' }}>開始日が新しい順</option>
                        </select>
                        <input type="submit" class="btn btn-primary btn-sm" value="検索">
                    </div>
               </form>
           </div>
        </div>
        <div class="m-auto">
            <div class="col-md-12 mx-auto">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>プロジェクト名</th>
                                <th>開始日</th>
                                <th>終了日</th>
                                <th>残日数</th>
                                <th>人数</th>
                                <th>担当者</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($projects as $project)
                                <tr>
                                    <th>{{ $project->project_name }}</th>
                                    <td>{{ $project->start_date  }}</td>
                                    <td>{{ $project->end_date  }}</td>
                                    <td>{{ $project->getRemainingdays()  }}</td>
                                    <td>{{ $project->number_of_people}}</td>
                                    <td>
                                        @foreach($project->users as $user)
                                        <div class="float-left m-1">
                                            <img src="{{ $user->profile->image }}" width="50" height="50" class="rounded-circle">
                                            <p class="text-center">{{ $user->name }}</p>
                                        </div>
                                        @endforeach
                                    </td>
                                    <td>
                                        <div>
                                            <a href="{{ action('Admin\ProjectController@edit', ['id' => $project->id]) }}">編集</a>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <a href="{{ action('Admin\ProjectController@assign', ['id' => $project->id]) }}" role="button" class="btn btn-primary">担当</a>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <a href="{{ action('User\DialyController@create', ['id' => $project->id]) }}" role="button" class="btn btn-primary">日報</a>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="hidden" name="id" value="{{ $project->id }}">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                <div class="link">
                    {{ $projects->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
