{!! Modal::start($modal) !!}
    <div class="form-group row">
        <label for="input_name" class="col-sm-2 col-form-label">Name:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="input_name" name="name"
                placeholder="Enter name" value="{{ isset($user) ? $user->name : old('name')}}">
        </div>
    </div>
    <div class="form-group row">
        <label for="input_email" class="col-sm-2 col-form-label">Email:</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="input_email"
                name="email" placeholder="Enter email" value="{{ isset($user) ? $user->email : old('email')}}">
        </div>
    </div>
    <div class="form-group row">
        <label for="input_password" class="col-sm-2 col-form-label">Password:</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="input_password"
                name="password" placeholder="Enter password" value="{{ isset($user) ? $user->password : old('password')}}">
        </div>
    </div>

{!! Modal::end() !!}