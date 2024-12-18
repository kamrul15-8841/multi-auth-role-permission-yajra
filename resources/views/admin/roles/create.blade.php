@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Role</h1>


        <form method="POST" action="{{ isset($role) ? route('roles.update', $role->id) : route('roles.store') }}">
            @csrf
            @if(isset($role))
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="name">Role Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $role->name ?? old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="permissions">Permissions</label>
                <select name="permissions[]" id="permissions" class="form-control" multiple>
                    @foreach($permissions as $permission)
                        <option value="{{ $permission->id }}"
                            {{ isset($rolePermissions) && in_array($permission->id, $rolePermissions) ? 'selected' : '' }}>
                            {{ $permission->name }}
                        </option>
                    @endforeach
                </select>
            </div>


{{--            <div class="form-group">--}}
{{--                <label for="permissions">Permissions</label>--}}
{{--                <select name="permissions[]" id="permissions" class="form-control" multiple>--}}
{{--                    @foreach($permissions as $permission)--}}
{{--                        <option value="{{ $permission->id }}"--}}
{{--                            {{ isset($role) && in_array($permission->id, $rolePermissions) ? 'selected' : '' }}>--}}
{{--                            {{ $permission->name }}--}}
{{--                        </option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}

            <button type="submit" class="btn btn-primary">
                {{ isset($role) ? 'Update Role' : 'Create Role' }}
            </button>
        </form>

        {{--        <form action="{{ route('roles.store') }}" method="POST">--}}
{{--            @csrf--}}
{{--            <div class="mb-3">--}}
{{--                <label for="name" class="form-label">Role Name</label>--}}
{{--                <input type="text" name="name" id="name" class="form-control" required>--}}
{{--            </div>--}}

{{--            <div class="mb-3">--}}
{{--                <label for="permissions" class="form-label">Permissions</label>--}}
{{--                <div class="form-check">--}}
{{--                    @foreach ($permissions as $permission)--}}
{{--                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="form-check-input" id="permission-{{ $permission->id }}">--}}
{{--                        <label class="form-check-label" for="permission-{{ $permission->id }}">{{ $permission->name }}</label><br>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <button type="submit" class="btn btn-primary">Create Role</button>--}}
{{--        </form>--}}
    </div>
@endsection
