@extends('layouts.basic')

@section('title', '日報編集')

@section('content')
    <div class="container">
        <div class="row">
            <h2>日報編集</h2>
        </div>
            @if ($errors->has('exception') or count($errors) > 0)
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        <div class="dialy">
            <form action="{{ action('User\DialyController@update') }}" method="post" >
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
                        {{$dialy->project->project_name}}　{{$dialy->project->end_date}}
                </div>
                <div class="fee_id">
                    <label for="fee_id">料金</label>
                        @foreach($fees as $fee)
                        <table>
                            <tr>
                                <td>
                                    <input type="checkbox" name="fee_ids[]" value="{{$fee->id}}" {{ in_array($fee->id,$fee_ids) ? "checked" : "" }} >{{$fee->place}}{{$fee->classification}}{{$fee->price}}円/t(トン)
                                    <input type="number" name="weight_{{$fee->id}}" step="0.01" value="{{ array_key_exists($fee->id,$fee_weight) ? $fee_weight[$fee->id] : "" }}">t(トン)
                                </td>
                            </tr>
                        </table>
                        @endforeach
                </div>
                <div class="memo">
                    <label for="memo">メモ</label>
                        <textarea name="memo">{{$dialy->memo}}</textarea>
                </div>
                <input type="hidden" name="id" value="{{ $dialy->id }}">
                <div class="submit">
                    <input type="submit" class="btn btn-primary" value="完了">
                </div>
            </form>
        </div>
    </div>
@endsection