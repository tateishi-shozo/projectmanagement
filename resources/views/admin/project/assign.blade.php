@extends('layouts.basic')

@section('title', 'プロジェクト編集')

@section('content')
    <div class="container">
        <div class="row">
            <h2>プロジェクト</h2>
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
                                <th>人数</th>
                                <th>必要資格・人数</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $project->project_name }}</td>
                                <td>{{ $project->start_date  }}</td>
                                <td>{{ $project->end_date  }}</td>
                                <td>{{ $project->number_of_people  }}</td>
                                @foreach($project->licenses as $license)
                                    <td>
                                        {{ $license->name }}
                                        ×{{ $license->pivot->required_least_count }}人
                                    </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                    <div class="container" stylle="martgin-top:50px;">
                        <h3>アサイン可能な人</h3>
                        @foreach($project->getAssignableUsers() as $user)
                            <form action="{{ action('Admin\ProjectController@record') }}" method="post">
                                <tr>
                                    <td>{{$user->name }}</td>
                                    <td><input type="date" name="start_date" value="{{ $project->start_date }}"></td>
                                    <td>〜<input type="date" name="endt_date" value="{{ $project->end_date }}"></td>
                                    <td><button type="submit">追加</button></td>
                                </tr>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection