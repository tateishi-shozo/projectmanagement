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
            @if (count($errors) > 0)
                <ul>
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            @endif
            <div class="col-md-12 mx-auto">
                <div class="form-group">
                    <label for="place">場所</label>
                    <input type="text" name="place" class="form-control">
                </div>
                <div class="form-group">
                    <label for="classification">分類</label>
                    <input type="text" name="classification" class="form-control">
                </div>
                <div class="form-group">
                    <label for="price">金額</label>
                    <input type="number" name="price" class="form-control" min='0'>円/t(トン)
                </div>
                <button type="submit" class='btn btn-primary'>追加</button>
            </div>
        </form>
        <div class="col-md-12 mx-auto">
            <h3>料金一覧</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>場所</th>
                        <th>分類</th>
                        <th>金額</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fee as $fee)
                        <tr>
                            <td>{{$fee->place}}</td>
                            <td>{{$fee->classification}}</td>
                            <td>{{$fee->price}}円/t(トン)</td>
                            <td>
                                <a href="{{ action('Admin\FeeController@delete',['id' => $fee->id]) }}"　role="button" class="btn btn-primary">削除</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection