@extends('dashboards.admins.layouts.admin-dash-layout')
@section('title','Dashboard')

@section('content')

<div class="container">
    <h1>User Listing</h1>

    <!-- Filter Form -->

    <!-- Add your filter fields here -->


    <!-- Add other filter fields such as email, min experience, max experience, skills, job location -->

    <button data-toggle="modal" data-target="#myModal" class="btn btn-primary mb-1" style="float: right;">Apply
        Filters</button>


    <!-- User List -->
    <table class="table" id="std_table_ajax">
        <thead>
            <tr>
                <th>Sno</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Experience</th>
                <th>Location</th>
                <th>Photo</th>
                <th>Resume</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($userArr as $user)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{ $user['name']}}</td>
                <td>{{ $user['email'] }}</td>
                <td>{{ $user['phone'] }}</td>
                <td>{{ $user['experience'] }}</td>
                <td>{{ $user['location']['location'] }}</td>
                <td>
                    @if($user['picture'])
                    <img src="{{  $user['picture'] }}" alt="User Photo" width="50">
                    @else
                    No Photo
                    @endif
                </td>
                <td>
                @if($user['resume'])
                <a href="users/resumes/{{$user['resume']}}" download="resume" target="_blank">Download</a>
                @else
                No Resume
                @endif
                </td>
                <td>
                <i class="fas fa-trash-alt" title="delete user" onclick="callFilter({{  $user['id'] }});"></i>
                 </td>

            </tr>
            @endforeach
        </tbody>
    </table>


    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Apply Filter</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">
                    <form id="filterForm">
                        <div class="form-group">
                            <label for="search">Search Name Or Email</label>
                            <input type="text" class="form-control" id="search" name="search" required>
                        </div>

                        <div class="form-group">
                            <label for="minExp">Min Exp:</label>
                            <input type="number" min="0" class="form-control" id="minExp" name="minExp" required>
                        </div>
                        <div class="form-group">
                            <label for="maxExp">Max Exp:</label>
                            <input type="number" max="60" class="form-control" id="maxExp" name="maxExp" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Skills:</label>
                            <input type="skill" class="form-control" id="skill" name="skill" required>
                        </div>
                        <div class="form-group">
                            <label for="gender">Location:</label>
                            <select class="form-control" name="location_id">
                                <option value="" selected>Choose</option>
                                @foreach($locationArr as $key=>$value)
                                <option value="{{$value['id']}}">{{$value['location']}}</option>
                                @endforeach

                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="callFilter()">Apply</button>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

<script>
function callFilter(id = '') {
    if (id == '') {
        var val = $('form#filterForm').serialize();
    } else {
        var val = {
            id: id
        };
    }

    $.ajax({
        url: 'admin/filterUser',
        type: "GET",
        data: val,
        cprocessData: false,
        dataType: 'json',
        contentType: false,
        beforeSend: function() {
            $(document).find('span.error-text').text('');
        },
        success: function(data) {
            $('#std_table_ajax').html(data.msg);
        },
        error: function(data) {
            console.log(data); // Here you could see the error
        }
    });
}

</script>