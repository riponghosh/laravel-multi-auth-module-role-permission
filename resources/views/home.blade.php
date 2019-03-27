    @extends('layouts.app')

    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <select name="cars">
                            <option value="volvo">Admin</option>
                            <option value="saab">Saab</option>
                            <option value="fiat">Fiat</option>
                            <option value="audi">Audi</option>
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
                                <td>{{$route->action['prefix']}}</td>
                                <td>
                                    <input type="checkbox" name="vehicle" value="Car" checked>
                                </td>
                                <td>
                                    <input type="checkbox" name="vehicle" value="Car" checked>
                                </td>
                                <td>
                                    <input type="checkbox" name="vehicle" value="Car" checked>
                                </td>
                                <td>
                                    <input type="checkbox" name="vehicle" value="Car" checked>
                                </td>
                                <td>
                                    <input type="checkbox" name="vehicle" value="Car" checked>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
