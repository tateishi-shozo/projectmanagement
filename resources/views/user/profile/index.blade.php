@extends('layouts.basic')

@section('title', 'プロフィール')

@section('content')
    <div class="container">
        <div class="row">
            <h2>プロフィール</h2>
        </div>
        <div class="profile">
            <div class="image">
                <label for="image"></label>
                @if(isset($user->profile->image))
                  <img src="{{ asset('storage/image/' . $profile->image) }}" alt='image'height="200" width="200">
                @else
                    <img src="/storage/noimage.png">
                @endif
            </div>
            <div class="name">
                <label for="name">名前</label>
                    {{ $user->name }}
            </div>
            <div class="birthday">
                <label for="birthday">誕生日</label>
                {{ $profile->birthday }}
            </div>
            <div class="blood_type">
                <label for="blood_type">血液型</label>
                {{ $profile->blood_type }}
            </div>
            <div class="license_id">
                <label for="license_id">保有資格</label>
                    @foreach($profile->licenses as $license)
                    <table>
                        <tr>
                            <td>
                                {{$license->name}}
                            </td>
                        </tr>
                    </table>
                    @endforeach
                </div>
            </form>
            <div class="col-md-4">
                <a href="{{ action('User\ProfileController@edit') }}" role="button" class="btn btn-primary">編集する</a>
            </div>
        </div>
    </div>
@endsection