@extends('layouts.basic')

@section('title', 'プロジェクト編集')

@section('content')
<div class="container">
    <div class="row">
        <h2>プロジェクト</h2>
    </div>
    <div class="row m-1">
        <div class="float-right">
        <a href="{{ action('Admin\ProjectController@index')}}" role="button" class="btn btn-primary">完了</a>
        </div>
    </div>
    <div class="col-md-12 mx-auto">
        <table class="table table-striped">
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
    <div class="m-auto">
        <h2 class="border bg-primary text-white" style="padding:10px;">アサイン可能</h2>
    </div>
    <div class="col-md-12 mx-auto">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ユーザー</th>
                    <th>名前</th>
                    <th>追加</th>
                </tr>
            </thead>
            <tbody>
                 @foreach($users as $user)
                        <tr>
                            <th><img src="{{ $user->image }}" height="100" width="100"></th>
                            <td>{{ $user->name }}</td>
                            <td>
                                <form action="{{ action('Admin\ProjectController@record') }}" method="post">
                                @csrf
                                    <input type="hidden" name="start_date" value="{{ $project->start_date }}">
                                    <input type="hidden" name="end_date" value="{{ $project->end_date }}">
                                    <input type="hidden" name="user_id" value="{{ $user->user_id }}">
                                    <input type="hidden" name="id" value="{{ $project->id }}">
                                    <input type="submit" class="btn btn-primary" value="追加">
                                </form>
                            </td>
                        </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="m-auto">
        <h2 class="border bg-secondary text-white" style="padding:10px;">アサイン可能</h2>
    </div>
    <div class="col-md-12 mx-auto">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ユーザー</th>
                    <th>名前</th>
                    <th>アサイン済</th>
                    <th>削除</th>
                </tr>
            </thead>
            <tbody>
                 @foreach($notassingusers as $notassinguser)
                        <tr>
                            <th><img src="{{ $notassinguser->image }}" height="100" width="100"></th>
                            <td>{{ $notassinguser->name }}</td>
                            <td>{{ $notassinguser->project_name }}</td>
                            <td>
                                <form action="{{ action('Admin\ProjectController@remove') }}" method="post">
                                @csrf
                                    <input type="hidden" name="start_date" value="{{ $project->start_date }}">
                                    <input type="hidden" name="end_date" value="{{ $project->end_date }}">
                                    <input type="hidden" id="user_id" name="user_id" value="{{ (int)$notassinguser->user_id }}">
                                    <input type="hidden" id="id" name="id" value="{{ $project->id }}">
                                    <input type="submit" class="btn btn-primary" value="削除">
                                </form>
                            </td>
                        </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection