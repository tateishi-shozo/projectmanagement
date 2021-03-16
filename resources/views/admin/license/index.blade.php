@extends('layouts.basic')

@section('title', '資格編集')

@section('content')
<div class="container">
    <div class="row">
        <h1>資格編集</h1>
    </div>
    <div class="container" stylle="martgin-top:50px;">
        <h3>資格名</h3>
        <form action="{{ action('Admin\LicenseController@create') }}" method="post">
            {{ csrf_field()}}
            <div class="form-group">
                <input type="text" name="name" class="form-control">
            </div>
            <input type="submit" class="btn btn-primary" value="追加">
        </form>
        <h3>登録資格</h3>
        @foreach ($licenses as $license)
        <table class="table">
            <tr>
                <td>{{$license->name}}</td>
                <td>
                    <a href="{{ action('Admin\LicenseController@delete',['id' => $license->id]) }}">削除</a>
                </td>
            </tr>
        </table>
        @endforeach
    </div>
</div>
@endsection