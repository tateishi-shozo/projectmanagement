@extends('layouts.basic')

@section('title', '日報一覧')

@section('content')
<div class="container">
    <div class="row">
        <h2>日報一覧</h2>
    </div>
    <div class="m-1">
        <div class="col-md-4">
            <a href="{{ action('User\DialyController@add') }}" role="button" class="btn btn-primary">新規作成</a>
        </div>
    </div>
    <div class="row">
        <div class="list-news col-md-12 mx-auto">
            <div class="row">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>プロジェクト名</th>
                            <th>作成者</th>
                            <th>作成日</th>
                            <th>合計金額</th>
                            <th>メモ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dialies as $dialy)
                            <tr>
                                <th>{{ $dialy->project->project_name }}</th>
                                <td>{{ $dialy->user->name  }}</td>
                                <td>{{ $dialy->created_at }}</td>
                                <td>
                                    @php
                                    $total = 0;
                                    
                                    foreach($dialy->fees as $fee){
                                        $total += $fee->pivot->weight*$fee->price;
                                        }
                                    
                                    echo $total;
                                     
                                    @endphp
                                </td>
                                <td>{{ $dialy->memo }}</td>
                                <td>
                                    <div>
                                        <a href="{{ action('User\DialyController@edit', ['id' => $dialy->id]) }}">編集</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="link">
                {{ $dialies->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
