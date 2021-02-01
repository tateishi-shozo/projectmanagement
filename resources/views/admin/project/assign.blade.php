@extends('layouts.basic')

@section('title', 'プロジェクト編集')

@section('content')
    <div class="container">
        <div class="row">
            <h2>プロジェクト</h2>
        </div>
        <div class="row">
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th>プロジェクト名</th>
                                <th>開始日</th>
                                <th>終了日</th>
                                <th>人数</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>{{ $project->project_name }}</th>
                                <td>{{ $project->start_date  }}</td>
                                <td>{{ $project->end_date  }}</td>
                                <td>{{ $project->number_of_people  }}</td>
                                @foreach($licenses as $license)
                                    <td>
                                        {{ in_array($license->id,$license_ids) ? $license->name : "" }}
                                        ×{{ array_key_exists($license->id,$license_required_least_counts) ? $license_required_least_counts[$license->id] : "" }}人
                                    </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection