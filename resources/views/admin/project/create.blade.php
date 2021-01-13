@extends('layouts.basic')

@section('title', 'プロジェクトの新規作成')

@section('content')
    <div class="container">
        <div class="row">
            <h2>新規プロジェクト</h2>
        </div>
        <div class="project">
            <form action="{{ action('Admin\ProjectController@create') }}" method="post">
                <div class="project_name">
                    <label for="project_name">プロジェクト名</label>
                    <input type="text" name="project_name" id="project_name">
                </div>
                 <div class="project_name">
                    <label for="project_name">開始日</label>
                    <input type="date" name="project_name" id="project_name">
                </div>
                <div class="project_name">
                    <label for="project_name">終了日</label>
                    <input type="date" name="project_name" id="project_name">
                </div>
                <div class="project_name">
                    <label for="project_name">人数</label>
                    <input type="number" name="project_name" id="project_name"　min="1">
                </div>
                <div class="project_name">
                    <label for="project_name">メモ</label>
                    <textarea row="5" cols="30"></textarea>
                </div>
                <div class="license_id">
                    <label for="project_name">必要資格</label>
                        @foreach($licenses as $license)
                            <input type="checkbox" name="license_id" value="{{$license->id}}">{{$license->name}}
                        @endforeach
                </div>
                <div class="project_name">
                    <input type="submit" name="project_name" id="project_name"　min="1">
                </div>
            </form>
        </div>
    </div>
@endsection