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
            <h2>アサイン済</h2>
                <tbody>
                    <div class="card-columns">
                    @foreach($notassingusers as $notassinguser)
                            <div class="card ml-3" style="width:10rem;">
                                <img class="card-img-top" src="{{ asset('storage/image/' . $notassinguser->image) }}" alt="Card image cap" height="150">
                                <div class="card-body">
                                    <h4 class="card-title">{{$notassinguser->name }}</h4>
                                    <span class="badge badge-success">Success</span>
                                    <input type="hidden" name="start_date" value="{{ $project->start_date }}">
                                    <input type="hidden" name="end_date" value="{{ $project->end_date }}">
                                    <input type="submit" class="btn btn-primary" value="削除">
                                    <input type="hidden" id="user_id" name="user_id" value="{{ $notassinguser->user_id }}">
                                    <input type="hidden" id="id" name="id" value="{{ $project->id }}">
                                </div>
                            </div>
                    @endforeach
                    </div>
                </tbody>
    </div>
    <div class="row">
        <form action="{{ action('Admin\ProjectController@record') }}" method="post">
            @csrf
            <h2>候補者</h2>
                <tbody>
                    <div class="card-columns">
                    @foreach($users as $user)
                            <div class="card ml-3" style="width:10rem;">
                                <img class="card-img-top" src="{{ asset('storage/image/' . $user->image) }}" alt="Card image cap" height="150">
                                <div class="card-body">
                                    <h4 class="card-title">{{$user->name }}</h4>
                                    <span class="badge badge-success">Success</span>
                                    <input type="hidden" name="start_date" value="{{ $project->start_date }}">
                                    <input type="hidden" name="end_date" value="{{ $project->end_date }}">
                                    <input type="hidden" name="user_id" value="{{ (string)$user->user_id }}">
                                    <input type="hidden" name="id" value="{{ $project->id }}">
                                    <input type="submit" class="btn btn-primary" value="追加">
                                </div>
                            </div>
                    @endforeach
                    </div>
                </tbody>
        </form>
    </div>
</div>

@endsection