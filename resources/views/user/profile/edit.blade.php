@extends('layouts.basic')

@section('title', 'プロフィール編集')

@section('content')
    <div class="container">
        <div class="row">
            <h2>プロフィール編集</h2>
        </div>
        <div class="profile">
            <form action="{{ action('User\ProfileController@update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="name">
                    <label for="name">名前</label>
                        {{ $user->name }}
                </div>
                <div class="image">
                    <label for="image">プロフィール画像</label>
                        <input type="file" name="image" id="image">
                        @if(isset($user->profile->image))
                            <img src="{{ asset('storage/image/' . $profile->image) }}" alt='image' height="200" width="200">
                        @endif
                </div>
                <div class="user_id">
                    <input type="hidden" name="user_id" value="{{$user->id}}">
                </div>
                <div class="birthday">
                    <label for="birthday">誕生日</label>
                    <input type="date" name="birthday" id="birthday" value="{{ $profile->birthday }}">
                </div>
                <div class="blood_type">
                    <label for="blood_type">血液型</label>
                    <input type="radio" name="blood_type" id="blood_type" @if($profile->blood_type == "A") checked @endif value="A">A
                    <input type="radio" name="blood_type" id="blood_type" @if($profile->blood_type == "B") checked @endif value="B">B
                    <input type="radio" name="blood_type" id="blood_type" @if($profile->blood_type == "O") checked @endif value="O">O
                    <input type="radio" name="blood_type" id="blood_type" @if($profile->blood_type == "AB") checked @endif value="AB">AB
                </div>
                <div class="license_id">
                    <label for="license_id">保有資格</label>
                        @foreach($licenses as $license)
                        <table>
                            <tr>
                                <td>
                                    <input type="checkbox" name="license_ids[]" value="{{$license->id}}" {{ in_array($license->id,$license_ids) ? "checked" : "" }}>{{$license->name}}
                                </td>
                            </tr>
                        </table>
                        @endforeach
                </div>
                <div class="submit">
                    <input type="submit" value="更新">
                </div>
            </form>
        </div>
    </div>
@endsection