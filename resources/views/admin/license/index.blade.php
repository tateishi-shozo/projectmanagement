@extends('layouts.basic')

@section('title', '資格編集')

@section('content')
<div class="container">
    <div class="row">
        <h1>資格一覧・追加</h1>
    </div>
    <div class="container" stylle="martgin-top:50px;">
        <h2>資格追加</h2>
        <form action="{{ action('Admin\LicenseController@create') }}" method="post">
            {{ csrf_field()}}
            <div class="form-group">
                <input type="text" name="name" class="form-control">
            </div>
            <button type="submit">追加する</button>
        </form>
        <h1>資格一覧</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th></th><th></th>
                </tr>
            </thead>
        </table>
        @foreach ($licenses as $license)
        <tr>
            <td>{{$license->name}}</td>
            <td>
                <form action="{{ action('Admin\licenseController@delete',['id' => $license->id]) }}">
                    {{ csrf_field() }}
                    <button type="submit">削除</button>
                </form>
            </td>
        </tr>
        @endforeach
    </div>
</div>
@endsection