@extends('layouts.basic')

@section('title', 'プロフィール登録')

@section('content')
    <div class="container">
        <div class="row">
            <h2>プロフィール登録</h2>
        </div>
        <div class="profile">
            <form action="{{ action('User\ProfileController@create') }}" method="post" enctype="multipart/form-data">
                @csrf
                 @if (count($errors) > 0)
                    <ul>
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="name">
                    <label for="name">名前</label>
                        {{ $user->name }}
                </div>
                <div class="image">
                    <label for="image">プロフィール画像</label>
                    <br><input type="file" name="image" id="image">
                </div>
                <div class="user_id">
                    <input type="hidden" name="user_id" value="{{$user->id}}">
                </div>
                <div class="birthday">
                    <label for="birthday">誕生日</label>
                    <input type="date" name="birthday" id="birthday">
                </div>
                <div class="blood_type">
                    <label for="blood_type">血液型</label>
                    <input type="radio" name="blood_type" id="blood_type"　value="A">A
                    <input type="radio" name="blood_type" id="blood_type"　value="B">B
                    <input type="radio" name="blood_type" id="blood_type"　value="O">O
                    <input type="radio" name="blood_type" id="blood_type"　value="AB">AB
                </div>
                <div class="license_id">
                    <label for="license_id">保有資格</label>
                        @foreach($licenses as $license)
                        <table>
                            <tr>
                                <td>
                                    <input type="checkbox" name="license_ids[]" value="{{$license->id}}">{{$license->name}}
                                </td>
                            </tr>
                        </table>
                        @endforeach
                </div>
                <div class="submit">
                    <input type="submit"class="btn btn-primary" value="完了">
                </div>
            </form>
        </div>
    </div>
@endsection