@extends('layouts.basic')

@section('title', '日報作成')

@section('content')
    <div class="container">
        <div class="row">
            <h2>日報作成</h2>
        </div>
        <div class="dialy">
            <form action="{{ action('User\DialyController@create') }}" method="post" >
                @csrf
                <div class="name">
                    <label for="name">作成者</label>
                        {{ $user->name }}
                </div>
                <div class="user_id">
                    <input type="hidden" name="user_id" value="{{$user->id}}">
                </div>
                <div class="project_id">
                    <label for="project_id">プロジェクト名</label>
                        <select name="project_id">
                            @foreach($projects as $project)
                                 <option value="{{$project->id}}" size="1">{{$project->project_name}}　{{$project->end_date}}</option>
                            @endforeach
                        </select>
                </div>
                <div class="fee_id">
                    <label for="fee_id">料金</label>
                        @foreach($fees as $fee)
                        <table>
                            <tr>
                                <td>
                                    <input type="checkbox" name="fee_ids[]" value="{{$fee->id}}">{{$fee->place}}{{$fee->classification}}{{$fee->price}}円/t(トン)
                                    <input type="number" name="weight_{{$fee->id}}" step="0.01">t(トン)
                                </td>
                            </tr>
                        </table>
                        @endforeach
                </div>
                <div class="memo">
                    <label for="memo">メモ</label>
                        <textarea name="memo"></textarea>
                </div>
                <div class="submit">
                    <input type="submit">
                </div>
            </form>
        </div>
    </div>
@endsection