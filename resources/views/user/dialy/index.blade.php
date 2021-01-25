@extends('layouts.basic')

@section('title', '日報一覧')

@section('content')
   <div class="container">
        <div class="row">
            <h2>日報一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ action('User\DialyController@add') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
        </div>
        <div class="row">
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th>プロジェクト名</th>
                                <th>作成者</th>
                                <th>作成日</th>
                                <th>合計金額</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dialys as $dialy)
                                <tr>
                                    <th>{{ $dialy->projects->name }}</th>
                                    <td>{{ $dialy->users->name  }}</td>
                                    <td>{{ $dialy->created_at }}</td>
                                    <td>{{ $total_fee  }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
