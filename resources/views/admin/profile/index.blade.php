@extends('layouts.basic')

@section('title', 'ユーザー一覧')

@section('content')
   <div class="container">
        <div class="row">
            <h2>ユーザー一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-8">
        </div>
        <div class="row">
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th>ユーザー</th>
                                <th>名前</th>
                                <th>年齢</th>
                                <th>血液型</th>
                                <th>保有資格</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($profiles as $profile)
                                <tr>
                                    <th><img src="{{ asset('storage/image/' . $profile->image) }}" height="100" width="100"></th>
                                    <td>{{ $profile->user->name }}</td>
                                    <td>{{ $profile->getBirthDay() }}歳</td>
                                    <td>{{ $profile->blood_type  }}</td>
                                    @foreach($profile->licenses as $license)
                                        <td>{{ $license->name  }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
