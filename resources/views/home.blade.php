    @extends('layouts.app')

    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    <form method="POST" action="{{ route('access_store') }}">
                        @csrf
                        <div class="card-body">
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif
                            <select name="role_id" onchange="window.location.href='/role/'+this.value">
                                <option value="">Select Role</option>
                                @foreach($roles as $role)
                                <option value="{{$role->id}}" @if(request()->id==$role->id)  selected @endif>{{$role->name}}</option>
                                @endforeach
                            </select>
                            <table style="width: 100%">
                                <tr>
                                    <th>Module</th>
                                    <th>Read</th>
                                    <th>Create</th>
                                    <th>Edit</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                                @php $pre=''@endphp
                                @foreach (Route::getRoutes() as $route) 
                                @if($route->uri!=$route->action['prefix']&&$route->action['prefix']&&($pre!=$route->action['prefix']) )
                                @php $pre=$route->action['prefix'] @endphp
                                <tr>
                                    <td>
                                        {{$route->action['prefix']}} 
                                        {{-- <input type="text" name="module" value="{{$route->action['prefix']}}" style="display: none;"> --}}
                                    </td>
                                    <td>
                                        <input type="checkbox" name="{{$route->action['prefix']}}[]" value="read" @if(strpos(strstr(strstr($module_access_string, $route->action['prefix'].'-'), ",", true),'read'))checked @endif>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="{{$route->action['prefix']}}[]" value="create" checked>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="{{$route->action['prefix']}}[]" value="edit" checked>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="{{$route->action['prefix']}}[]" value="update" checked>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="{{$route->action['prefix']}}[]" value="delete" checked>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </table>
                        </div>
                        <div class="form-group row mb-2 col-md-12">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
