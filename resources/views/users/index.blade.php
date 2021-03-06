@extends('layouts.app2')

@section('content')
    <!-- This is the styling for the table because the text is white by default. -->
    <style type="text/css">
        th, td{
            color:black;
        }
        
        .nav-tabs>li>a:hover {
            background-color: #23527c;
            color: #23527c;
        } 
        .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus{
            background-color:#2c3e50;
            color:#161f29;
        }
    </style>

    <!--###########################################################################-->
    <!--####   The Basic Scafolding for a dashboard for buttons and access.    ####-->
    <!--###########################################################################-->
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-8 col-md-offset-2">
            <!-- This is the admin dashboard stuff with the colum sizing. -->
            <h1 style="color:#2c3e50;">Welcome Admin</h1>
            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a style="color: white;" href="#adminToggle1" data-toggle="tab"><strong>My Profile</strong></a></li>
                <li><a style="color: white;" href="#adminToggle2" data-toggle="tab"><strong>Manage Access</strong></a></li>
                <li><a style="color: white;" href="#adminToggle3" data-toggle="tab"><strong>Manage Students</strong></a></li>
                <li><a style="color: white;" href="#adminToggle4" data-toggle="tab"><strong>Manage Mentors</strong></a></li>
                <li><a style="color: white;" href="#adminToggle5" data-toggle="tab"><strong>Manage Employees</strong></a></li>
                <li><a style="color: white;" href="#adminToggle6" data-toggle="tab"><strong>Manage Visits</strong></a></li>
                <li><a style="color: white;" href="#adminToggle7" data-toggle="tab"><strong>Manage Grades</strong></a></li>
                <li><a style="color: white;" href="#adminToggle8" data-toggle="tab"><strong>Manage Notes</strong></a></li>
                <li><a style="color: white;" href="#adminToggle9" data-toggle="tab"><strong>Generate Report</strong></a></li>
            </ul>
            <!--#############################################################################-->
            <!--####                        The End of the Table.                        ####-->
            <!--#############################################################################-->



            <!--#############################################################################-->
            <!--####     The Basic Scafolding for a table to change user Permissions.    ####-->
            <!--#############################################################################-->
            <div class="tab-content">
                <!-- This is the first admin toggle or the profile information relating to the mentors. -->
                <div id="adminToggle1" class="tab-pane fade in active" >
                    <h1>My Profile</h1>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <tbody>
                                <tr class="bg-info"/>
                                <tr>
                                    <td>Last Name</td>
                                    <td><?php echo ($admin['lastName']); ?></td>
                                </tr>
                                <tr>
                                    <td>First Name</td>
                                    <td><?php echo ($admin['firstName']); ?></td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td><?php echo ($admin['address']); ?></td>
                                </tr>
                                <tr>
                                    <td>City </td>
                                    <td><?php echo ($admin['city']); ?></td>
                                </tr>
                                <tr>
                                    <td>State</td>
                                    <td><?php echo ($admin['state']); ?></td>
                                </tr>
                                <tr>
                                    <td>Zip </td>
                                    <td><?php echo ($admin['zip']); ?></td>
                                </tr>
                                <tr>
                                    <td>Phone</td>
                                    <td><?php echo ($admin['phone']); ?></td>
                                </tr>
                                <tr>
                                    <td>Type</td>
                                    <td><?php echo ($admin->roles[0]['name']); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- The Update user function. -->
                    <a class="btn btn-primary" href="{{ route('users.edit',$admin->id) }}">Update Information</a>
                </div>

                <div id="adminToggle2" class="tab-pane fade" >
                    <h1>Manage Access Requests</h1>
                    <div class="table-responsive">
                        <!-- The code to list all the mentors and other people stuff that can admin can see and create.-->
                        <table class="table table-bordered table-striped table-hover table-inverse">
                            <thead>
                                <tr class="bg-info">
                                    <th>Last Name</th>
                                    <th>First Name</th>
                                    <th>Current Address</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Zip</th>
                                    <th>Primary Email</th>
                                    <th>Phone</th>
                                    <th>Requested Role</th>
                                    <th>Admin</th>
                                    <th>Employee</th>
                                    <th>Mentor</th>
                                    <th>Pending</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                            <form action="{{ route('users.assign') }}" method="post">
                                                <td>{{ $user->lastName }}</td>
                                                <td>{{ $user->firstName }}</td>
                                                <td>{{ $user->address }}</td>
                                                <td>{{ $user->city }}</td>
                                                <td>{{ $user->state }}</td>
                                                <td>{{ $user->zip }}</td>
                                                <td>{{ $user->email }} <input type="hidden" name="email" value="{{$user->email}}"></td> 
                                                <td>{{ $user->phone }}</td>
                                                <td>{{ $user->role_request }}</td>
                                                <td><input type="checkbox" {{ $user->hasRole('Admin')  ? 'checked' : ''}} name="role_admin"></td>
                                                <td><input type="checkbox" {{ $user->hasRole('Employee')  ? 'checked' : ''}} name="role_employee"></td>
                                                <td><input type="checkbox" {{ $user->hasRole('Mentor')  ? 'checked' : ''}} name="role_mentor"></td>
                                                <td><input type="checkbox" {{ $user->hasRole('Pending')  ? 'checked' : ''}} name="role_pending"></td>
                                                {{csrf_field()}}
                                                <td><button class="btn btn-primary" type="submit">Assign Roles</button></td>
                                            </form>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- This is the second part of the radio button information. -->
                <div id="adminToggle3" class="tab-pane fade" >
                    <h1>All Student Profile</h1>
                    {!! Form::open(['route'=> 'users.index', 'method' => 'GET', 'class' => 'navbar-form navbar-right', 'role' => 'search']) !!}
                        <div class="input-group">
                            {!! Form::text('studentTerm', Request::get('studentTerm'), ['class'=>'form-control', 'placeholder' => 'Search...']) !!}
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <i class="glyphicon glyphicon-search"></i>
                                </button>
                            </span>
                        </div>
                    {!! Form::close() !!}
                    <a class="btn btn-primary" style="margin: 10px 0px 10px 250px;" href="{{ action('StudentController@create') }}"><span style="margin: 3px 10px 0px 0px;" class="glyphicon glyphicon-briefcase"></span>Create a Student</a><br/>
                    <div class="table-responsive">
                        <!-- The code to list all the students and other people stuff that can admin can see and create.-->
                        <table class="table table-bordered table-striped table-hover table-inverse">
                            <thead>
                                <tr class="bg-info">
                                    <th>Last Name</th>
                                    <th>First Name</th>
                                    <th>Current Address</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Zip</th>
                                    <th>Primary Email</th>
                                    <th>Phone</th>
                                    <th colspan="3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    <tr>
                                                <td>{{ $student->lastName }}</td>
                                                <td>{{ $student->firstName }}</td>
                                                <td>{{ $student->address }}</td>
                                                <td>{{ $student->city }}</td>
                                                <td>{{ $student->state }}</td>
                                                <td>{{ $student->zip }}</td>
                                                <td>{{ $student->email }}
                                                <td>{{ $student->phone }}</td>
                                                <td><a class="btn btn-primary" href="{{ route('students.edit',$student->id) }}"><span style="margin: 3px 10px 0px 0px;" class="glyphicon glyphicon-pencil"></span>Update</a></td>
                                                <td><a class="btn btn-primary" href="{{ route('students.show',$student->id) }}"><span style="margin: 3px 10px 0px 0px;" class="glyphicon glyphicon-eye-open"></span>Read</a></td>
                                                <td>
                                                    {!! Form::open(['method' => 'DELETE', 'route'=>['students.destroy', $student->id]])!!}
                                                    {!! Form::button('<span style="margin: 3px 5px 0px 0px;" class="glyphicon glyphicon-trash"></span>Delete', ['class' => 'btn btn-danger','name'=>'remove_levels']) !!}
                                                    {!! Form::close() !!}
                                                </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- This is the third part of the radio button scafolding. -->
                <div id="adminToggle4" class="tab-pane fade" >
                    <h1>All Mentor Profile</h1>
                    {!! Form::open(['route'=> 'users.index', 'method' => 'GET', 'class' => 'navbar-form navbar-right', 'role' => 'search']) !!}
                        <div class="input-group">
                            {!! Form::text('mentorTerm', Request::get('mentorTerm'), ['class'=>'form-control', 'placeholder' => 'Search...']) !!}
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <i class="glyphicon glyphicon-search"></i>
                                </button>
                            </span>
                        </div>
                    {!! Form::close() !!}
                    <a class="btn btn-primary" style="margin: 10px 0px 10px 250px;" href="{{ action('UserController@create',"Mentor") }}"><span style="margin: 3px 10px 0px 0px;" class="glyphicon glyphicon-briefcase"></span>Create a Mentor</a><br/>
                    <div class="table-responsive">
                        <!-- The code to list all the mentors and other people stuff that can admin can see and create.-->
                        <table class="table table-bordered table-striped table-hover table-inverse">
                            <thead>
                                <tr class="bg-info">
                                    <th>Last Name</th>
                                    <th>First Name</th>
                                    <th>Current Address</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Zip</th>
                                    <th>Primary Email</th>
                                    <th>Phone</th>
                                    <th colspan="3" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mentors as $mentor)
                                    <tr>
                                                <td>{{ $mentor->lastName }}</td>
                                                <td>{{ $mentor->firstName }}</td>
                                                <td>{{ $mentor->address }}</td>
                                                <td>{{ $mentor->city }}</td>
                                                <td>{{ $mentor->state }}</td>
                                                <td>{{ $mentor->zip }}</td>
                                                <td>{{ $mentor->email }}
                                                <td>{{ $mentor->phone }}</td>
                                                <td><a class="btn btn-primary" href="{{ route('users.edit',$mentor->id) }}"><span style="margin: 3px 10px 0px 0px;" class="glyphicon glyphicon-pencil"></span>Update</a></td>
                                                <td><a class="btn btn-primary" href="{{ route('users.show',$mentor->id) }}"><span style="margin: 3px 10px 0px 0px;" class="glyphicon glyphicon-eye-open"></span>Read</a></td>
                                                <td>
                                                    {!! Form::open(['method' => 'DELETE', 'route'=>['users.destroy', $mentor->id]])!!}
                                                    {!! Form::button('<span style="margin: 3px 5px 0px 0px;" class="glyphicon glyphicon-trash"></span>Delete', ['class' => 'btn btn-danger','name'=>'remove_levels']) !!}
                                                    {!! Form::close() !!}
                                                </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                    <!-- This is the fourth part of the radio button scafolding. -->
                <div id="adminToggle5" class="tab-pane fade" >
                    <h1>All Employee profile</h1>
                    {!! Form::open(['route'=> 'users.index', 'method' => 'GET', 'class' => 'navbar-form navbar-right', 'role' => 'search']) !!}
                        <div class="input-group">
                            {!! Form::text('employeeTerm', Request::get('employeeTerm'), ['class'=>'form-control', 'placeholder' => 'Search...']) !!}
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <i class="glyphicon glyphicon-search"></i>
                                </button>
                            </span>
                        </div>
                    {!! Form::close() !!}
                    <a class="btn btn-primary" style="margin: 10px 0px 10px 250px;" href="{{ action('UserController@create', "Employee") }}"><span style="margin: 3px 10px 0px 0px;" class="glyphicon glyphicon-briefcase"></span>Create an Employee</a><br/>
                    <div class="table-responsive">
                        <!-- The code to list all the employees and other people stuff that can admin can see and create.-->
                        <table class="table table-bordered table-striped table-hover table-inverse">
                            <thead>
                                <tr class="bg-info">
                                    <th>Last Name</th>
                                    <th>First Name</th>
                                    <th>Current Address</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Zip</th>
                                    <th>Primary Email</th>
                                    <th>Phone</th>
                                    <th colspan="3" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                                <td>{{ $employee->lastName }}</td>
                                                <td>{{ $employee->firstName }}</td>
                                                <td>{{ $employee->address }}</td>
                                                <td>{{ $employee->city }}</td>
                                                <td>{{ $employee->state }}</td>
                                                <td>{{ $employee->zip }}</td>
                                                <td>{{ $employee->email }}
                                                <td>{{ $employee->phone }}</td>
                                                <td><a class="btn btn-primary" href="{{ route('users.edit',$employee->id) }}"><span style="margin: 3px 10px 0px 0px;" class="glyphicon glyphicon-pencil"></span>Update</a></td>
                                                <td><a class="btn btn-primary" href="{{ route('users.show',$employee->id) }}"><span style="margin: 3px 10px 0px 0px;" class="glyphicon glyphicon-eye-open"></span>Read</a></td>
                                                <td>
                                                    {!! Form::open(['method' => 'DELETE', 'route'=>['users.destroy', $employee->id]])!!}
                                                    {!! Form::button('<span style="margin: 3px 5px 0px 0px;" class="glyphicon glyphicon-trash"></span>Delete', ['class' => 'btn btn-danger','name'=>'remove_levels']) !!}
                                                    {!! Form::close() !!}
                                                </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- This is the fourth part of the radio button scafolding. -->
                <div id="adminToggle6" class="tab-pane fade" >
                    <h1>All Visits</h1>
                    {!! Form::open(['route'=> 'users.index', 'method' => 'GET', 'class' => 'navbar-form navbar-right', 'role' => 'search']) !!}
                        <div class="input-group">
                            {!! Form::text('visitTerm', Request::get('visitTerm'), ['class'=>'form-control', 'placeholder' => 'Search...']) !!}
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <i class="glyphicon glyphicon-search"></i>
                                </button>
                            </span>
                        </div>
                    {!! Form::close() !!}
                    <a class="btn btn-primary" style="margin: 10px 0px 10px 230px;" href="{{ action('VisitController@create') }}"><span style="margin: 3px 10px 0px 0px;" class="glyphicon glyphicon-briefcase"></span>Create a visit</a><br/>
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
                                        <td><a class="btn btn-primary" href="{{ route('visits.edit',$visit->id) }}"><span style="margin: 3px 10px 0px 0px;" class="glyphicon glyphicon-pencil"></span>Update</a></td>
                                        <td><a class="btn btn-primary" href="{{ route('visits.show',$visit->id) }}"><span style="margin: 3px 10px 0px 0px;" class="glyphicon glyphicon-eye-open"></span>Read</a></td>
                                        <td>
                                            {!! Form::open(['method' => 'DELETE', 'route'=>['visits.destroy', $visit->id]])!!}
                                                    {!! Form::button('<span style="margin: 3px 5px 0px 0px;" class="glyphicon glyphicon-trash"></span>Delete', ['class' => 'btn btn-danger','name'=>'remove_levels']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- This is the fifth part of the radio bnutton Scafolding. -->
                <div id="adminToggle7" class="tab-pane fade" >
                    <h1>All Grade</h1>
                    {!! Form::open(['route'=> 'users.index', 'method' => 'GET', 'class' => 'navbar-form navbar-right', 'role' => 'search']) !!}
                        <div class="input-group">
                            {!! Form::text('gradeTerm', Request::get('gradeTerm'), ['class'=>'form-control', 'placeholder' => 'Search...']) !!}
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <i class="glyphicon glyphicon-search"></i>
                                </button>
                            </span>
                        </div>
                    {!! Form::close() !!}
                    <a class="btn btn-primary" style="margin: 10px 0px 10px 230px;" href="{{ action('GradeController@create') }}"><span style="margin: 3px 10px 0px 0px;" class="glyphicon glyphicon-briefcase"></span>Create a grade</a><br/>
                    <div class="table-responsive">
                    <!-- The code to list all the grades and other people stuff that can admin can see and create.-->
                        <table class="table table-bordered table-striped table-hover table-inverse">
                            <thead>
                                <tr class="bg-info">
                                    <th>Subject</th>
                                    <th>Period</th>
                                    <th>Grade</th>
                                    <th>Comments</th>
                                    <th>Student</th>
                                    <th colspan="3" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($grades as $grade)
                                    <tr>
                                        <td>{{ $grade->subject }}</td>
                                        <td>{{ $grade->period }}</td>
                                        <td>{{ $grade->actual }}</td>
                                        <td>{{ $grade->comments }}</td>
                                        <td>{{ $grade->student->firstName }}</td>
                                        <td><a class="btn btn-primary" href="{{ route('grades.edit',$grade->id) }}"><span style="margin: 3px 10px 0px 0px;" class="glyphicon glyphicon-pencil"></span>Update</a></td>
                                        <td><a class="btn btn-primary" href="{{ route('grades.show',$grade->id) }}"><span style="margin: 3px 10px 0px 0px;" class="glyphicon glyphicon-eye-open"></span>Read</a></td>
                                        <td>
                                            {!! Form::open(['method' => 'DELETE', 'route'=>['grades.destroy', $grade->id]])!!}
                                                    {!! Form::button('<span style="margin: 3px 5px 0px 0px;" class="glyphicon glyphicon-trash"></span>Delete', ['class' => 'btn btn-danger','name'=>'remove_levels']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- This is the second mentor toggle or the student information relating to the mentors. -->
                <div id="adminToggle8" class="tab-pane fade">
                    <h1>Manage Note/Comments</h1>
                    <div class="table-responsive" style="color:black;">
                        <table class="table table-bordered table-striped table-hover table-inverse">
                            <thead>
                                <tr class="bg-info">
                                    <th>Visit Date</th>
                                    <th>Mentor</th>
                                    <th>Student</th>
                                    <th>Note</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($notes as $note)
                                    <tr>
                                        <td>{{$note->visit->Date}}</td> 
                                        <td>{{$note->user->firstName}}</td>
                                        <td>{{$note->student->firstName}}</td>
                                        <td>{{ $note->description }}</td>
                                        <td><a class="btn btn-primary" href="{{ route('notes.show',$note->id) }}"><span style="margin: 3px 10px 0px 0px;" class="glyphicon glyphicon-eye-open"></span>Show</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="adminToggle9" class="tab-pane fade" >
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-primary"><span style="margin: 0px 5px 0px 0px;" class="glyphicon glyphicon-save"></span>Export</button>
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu" id="export-menu">
                            <li id="export-to-excel"><a href="{{ URL::to('getExport') }}">Export to Excel</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Other</a></li>
                        </ul>
                    </div>
                    <h1>All Reports</h1>
                    <div class="table-responsive">   
                        <table class="table table-bordered table-striped table-hover table-inverse">
                            <thead>
                                <tr class="bg-info">
                                    <th>lastName</th>
                                    <th>firstName</th>
                                    <th>Current Address</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Zip</th>
                                    <th>Primary Email</th>
                                    <th>phone</th>
                                    <th colspan="2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    <tr>
                                            <td>{{ $student->lastName }}</td>
                                            <td>{{ $student->firstName }}</td>
                                            <td>{{ $student->address }}</td>
                                            <td>{{ $student->city }}</td>
                                            <td>{{ $student->state }}</td>
                                            <td>{{ $student->zip }}</td>
                                            <td>{{ $student->email }}</td>
                                            <td>{{ $student->phone }}</td>
                                            <td><a class="btn btn-primary" href="{{ route('PDF.show',$student->id) }}"><span style="margin: 3px 10px 0px 0px;" class="glyphicon glyphicon-eye-open"></span>Read Report</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!--#############################################################################-->
    <!--####                        The End of the Table.                        ####-->
    <!--#############################################################################-->


    
@endsection