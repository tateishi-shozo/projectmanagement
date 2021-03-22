@extends('layouts.basic')

@section('title', 'プロジェクト編集')

@section('content')
    <div class="container">
        <div class="row">
            <h2>プロジェクト編集</h2>
        </div>
        <div class="project">
            <form action="{{ action('Admin\ProjectController@update') }}" method="post">
                @csrf
                <div class="project_name">
                    <label for="project_name">プロジェクト名</label>
                    <input type="text" name="project_name" id="project_name" value="{{ $project->project_name}}">
                </div>
                 <div class="start_date">
                    <label for="start_date">開始日</label>
                    <input type="date" name="start_date" id="start_date" value="{{ $project->start_date}}">
                </div>
                <div class="end_date">
                    <label for="end_date">終了日</label>
                    <input type="date" name="end_date" id="end_date" value="{{ $project->end_date}}">
                </div>
                <div class="number_of_people">
                    <label for="number_of_people">人数</label>
                    <input type="number" name="number_of_people" id="number_of_people"　min="1" size="2" value="{{ $project->number_of_people}}">
                </div>
                <div class="memo">
                    <label for="memo">メモ</label>
                    <textarea row="5" cols="30" name="memo"></textarea>
                </div>
                <div class="license_id">
                    <label for="license_id">必要資格・人数</label>
                        @foreach($licenses as $license)
                        <table>
                            <tr>
                                <td>
                                    <input type="checkbox" name="license_ids[]" value="{{$license->id}}" {{ in_array($license->id,$license_ids) ? "checked" : "" }}>{{$license->name}}
                                    ×<input type="number" name="required_least_counts_{{$license->id}}"　min="1" size="2" value="{{ array_key_exists($license->id,$license_required_least_counts) ? $license_required_least_counts[$license->id] : "" }}">人
                                </td>
                            </tr>
                        </table>
                        @endforeach
                </div>
                <div>
                    <input type="hidden" name="id" value="{{ $project->id }}">
                </div>
                <div class="submit">
                    <input type="submit"　class="btn btn-primary" value="完了">
                </div>
            </form>
        </div>
    </div>
@endsection