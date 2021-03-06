@extends('layouts.app2')

@section('content')
    <!-- This is the styling for the table because the text is white by default. -->
    <style type="text/css">
        th, td{
            color:black;
        }
    </style>
    <!-- This is the visit dashboard stuff with the colum sizing. -->
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Admin Acess Dashboard</div>
                <div class="panel-body">                   
                    <a style="margin: 10px 10px 10px 10px;" class="btn btn-primary" href="{{action('UserController@create')}}">Admins</a>
                    <a style="margin: 10px 10px 10px 10px;" class="btn btn-primary" href="{{action('VisitController@index')}}">Visit</a>
                    <a style="margin: 10px 10px 10px 10px;" class="btn btn-primary" href="{{action('GradeController@index')}}">Grade</a>
                </div>
            </div>
        </div>
    </div>

    <!-- The code to list all the students and other people stuff that can visit can see and create.-->
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-8 col-md-offset-2">
        <div class="table-responsive">
                <!-- The code to list all the visits and other people stuff that can admin can see and create.-->
                <table class="table table-bordered table-striped table-hover table-inverse">
                    <thead>
                    <tr class="bg-info">
                        <th>Date</th>
                        <th>Attendance</th>
                        <th>Mentor</th>
                        <th>Student</th>
                        <th colspan="3" class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($visits as $visit)
                        <tr>
                            <td>{{ $visit->Date }}</td>
                            <td>{{ $visit->check }}</td>
                            <td>{{ $visit->user->firstName }}</td>
                            <td>{{ $visit->student->firstName }}</td>
                            <td><a class="btn btn-primary" href="{{ route('visits.edit',$visit->id) }}">Update</a></td>
                            <td><a class="btn btn-primary" href="{{ route('visits.show',$visit->id) }}">Read</a></td>
                            <td>
                                {!! Form::open(['method' => 'DELETE', 'route'=>['visits.destroy', $visit->id], 'onSubmit'=> 'if(!confirm("Deleting the visit will clear the attendance and notes relating to it.\n\nAre you Sure you want to delete the Visit?")){return false;}'])!!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    <hr/>
                    </tbody>
                </table>
                </div>
        </div>
    </div>
@endsection