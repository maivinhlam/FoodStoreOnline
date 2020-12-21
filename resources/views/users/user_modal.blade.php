{!! Modal::start($modal) !!}
    <div class="form-group row">
        <label for="input_name" class="col-sm-2 col-form-label">Name:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="input_name" name="name"
                {{-- placeholder="Enter name" value="{{ isset($user) ? $user->name : old('name')}}"> --}}
                placeholder="Enter name" value="{{ isset($user) ? $user->name : 'mai vinh lam'}}">
        </div>
    </div>

    <div class="form-group row">
        <label for="input_email" class="col-sm-2 col-form-label">Email:</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="input_email"
                {{-- name="email" placeholder="Enter email" value="{{ isset($user) ? $user->email : old('email')}}"> --}}
                name="email" placeholder="Enter email" value="{{ isset($user) ? $user->email : 'maivinhlam910@gmail.com'}}">
        </div>
    </div>

    <div class="form-group row">
        <label for="input_password" class="col-sm-2 col-form-label">Password:</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="input_password"
                {{-- name="password" placeholder="Enter password" value="{{ isset($user) ? $user->password : old('password')}}"> --}}
                name="password" placeholder="Enter password" value="{{ isset($user) ? $user->password : '1234'}}">
        </div>
    </div>

    <div class="form-group row">
        <label for="input_phone" class="col-sm-2 col-form-label">Phone:</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="input_phone" name="phone"
                {{-- placeholder="Enter Phone" value="{{ isset($user) ? $user->phone : old('phone')}}"> --}}
                placeholder="Enter Phone" value="{{ isset($user) ? $user->phone : '123456'}}">
        </div>
    </div>

    <div class="form-group row">
        <label for="input_avatar" class="col-sm-2 col-form-label">Avatar:</label>
        <div class="col-sm-10">
            <input type="file" name="avatar[]" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label for="input_address" class="col-sm-2 col-form-label">Address:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="input_address" name="address"
                placeholder="Enter Address" value="{{ isset($user) ? $user->address : old('address')}}">
        </div>
    </div>

    <div class="form-group row">
        <label for="input_role" class="col-sm-2 col-form-label">Role:</label>
        <div class="col-sm-10">
            <select name="role_id" id="input_role" class="form-control">
                <option value=""></option>
                @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

{!! Modal::end() !!}
