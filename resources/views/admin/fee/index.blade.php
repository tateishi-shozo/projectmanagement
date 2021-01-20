@extends('layouts.basic')

@section('title', '料金編集')

@section('content')
<div class="container">
    <div class="row">
        <h1>料金登録</h1>
    </div>
    <div class="container" stylle="martgin-top:50px;">
        <form action="{{ action('Admin\FeeController@create') }}" method="post">
            {{ csrf_field()}}
            <div class="form-group">
                場所<input type="text" name="place" class="form-control">
            </div>
            <div class="form-group">
                分類<input type="text" name="classification" class="form-control">
            </div>
            <div class="form-group">
               金額 <input type="number" name="price" class="form-control" min='0'>円/t(トン)
            </div>
            <button type="submit">追加</button>
        </form>
        <h3>料金一覧</h3>
        @foreach ($fee as $fee)
        <table>
            <tr>
                <td>{{$fee->place}}</td>
                <td>{{$fee->classification}}</td>
                <td>{{$fee->price}}円/t(トン)</td>
                <td>
                    <a href="{{ action('Admin\FeeController@delete',['id' => $fee->id]) }}">削除</a>
                </td>
            </tr>
        </table>
        @endforeach
    </div>
</div>
@endsection