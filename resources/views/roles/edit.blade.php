@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ action('App\Http\Controllers\RoleController@update') }}">
                            <div class="form-group">
                                <label for="role">Update Role</label>
                                @foreach($roles as $role)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->name }}" {{ ($user->hasRole($role->name)) ? "checked": ""  }}>
                                    <label class="form-check-label">
                                        {{ $role->name }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            <input type="hidden" name="user_id" value="{{ $user->id }}"/>
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <input type="submit" class="btn btn-lg btn-primary navbar-panda" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
