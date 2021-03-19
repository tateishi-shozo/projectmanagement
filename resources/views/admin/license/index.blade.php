@extends('layouts.basic')

@section('title', '資格編集')

@section('content')
<div class="container">
    <div class="row">
        <h1>資格編集</h1>
    </div>
    <div class="container" stylle="martgin-top:50px;">
        <form action="{{ action('Admin\LicenseController@create') }}" method="post">
            {{ csrf_field()}}
            @if (count($errors) > 0)
                <ul>
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            @endif
            <div class="form-group">
                <label for='name'>資格名</label>
                <input type="text" name="name" class="form-control">
            </div>
            <input type="submit" class="btn btn-primary" value="追加">
        </form>
        <div class="col-md-12 mx-auto">
            <h3>登録資格</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>資格名</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($licenses as $license)
                <tr>
                    <td>{{$license->name}}</td>
                    <td>
                        <a href="{{ action('Admin\LicenseController@delete',['id' => $license->id]) }}" role="button" class="btn btn-primary">削除</a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection