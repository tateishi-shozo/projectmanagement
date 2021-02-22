@extends('layouts.basic')

@section('title', 'プロジェクト編集')

@section('content')
<div class="container">
    <div class="row">
        <h2>プロジェクト</h2>
    </div>
    <div class="row">
        <div class="list-news col-md-12 mx-auto">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th>プロジェクト名</th>
                        <th>開始日</th>
                        <th>終了日</th>
                        <th>人数</th>
                        <th>必要資格・人数</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $project->project_name }}</td>
                        <td>{{ $project->start_date }}</td>
                        <td>{{ $project->end_date }}</td>
                        <td>{{ $project->number_of_people }}</td>
                        @foreach($project->licenses as $license)
                            <td>{{ $license->name }}×{{ $license->pivot->required_least_count }}人</td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="list-news col-md-12 mx-auto">
            <h2>アサイン可能な人</h2>
                <tr>
                   <th></th>
                   <th>名前</th>
                   <th>開始日</th>
                   <th>終了日</th>
                   <th>資格</th>
                </tr>
            <form action="{{ action('Admin\ProjectController@record') }}" method="post">
                @csrf
                @foreach($users as $user)
                <tr>
                    <td><img src="{{ asset('storage/image/' . $user->image) }}" height="50" width="50"></td>
                    <td>{{$user->name }}</td>
                    <td><input type="date" name="start_date" value="{{ $project->start_date }}"></td>
                    <td>〜<input type="date" name="end_date" value="{{ $project->end_date }}"></td>
                    <td>
                        <input type="submit" class="btn btn-primary" value="追加">
                    </td>
                    <td><input type="hidden" id="user_id" name="user_id" value="{{ $user->user_id }}"></td>
                    <td><input type="hidden" id="id" name="id" value="{{ $project->id }}"></td>
                </tr>
                @endforeach
            </form>
        </div>
    </div>
</div>

@endsection