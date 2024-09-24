<div class="row">
    <!-- RIF Field -->
    <div class="form-group col-sm-12 col-md-6">
        {!! Form::label('cedula', 'Cedula:', ['class' => 'bold']) !!}
        {!! Form::text('cedula', $usuario->Cedula ?? null, ['class' => 'form-control round', 'required']) !!}
        @error('cedula')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <!-- Email -->
    <div class="form-group col-sm-12 col-md-6">
        {!! Form::label('email', 'Correo Electrónico:', ['class' => 'bold']) !!}
        {!! Form::email('email', $usuario->email ?? null, ['class' => 'form-control round', 'required']) !!}
        @error('email')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <!-- Name Field -->
    <div class="form-group col-sm-12 col-md-6">
        {!! Form::label('name', 'Nombre:', ['class' => 'bold']) !!}
        {!! Form::text('name', $usuario->name ?? null, ['class' => 'form-control round', 'required']) !!}
        @error('name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <!-- Cédula -->
    <div class="form-group col-sm-12 col-md-6">
        {!! Form::label('cedula', 'Cédula:', ['class' => 'bold']) !!}
        {!! Form::text('cedula', $usuario->cedula ?? null, ['class' => 'form-control round', 'required']) !!}
        @error('cedula')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <!-- Estado -->
    <div class="form-group col-sm-12 col-md-6">
        {!! Form::label('status', 'Estado:', ['class' => 'bold']) !!}
        {!! Form::select('status', ['Activo' => 'Activo', 'Inactivo' => 'Inactivo'], $usuario->status ?? null, ['class' => 'form-control round', 'required']) !!}
        @error('status')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <!-- Contraseña -->
    <div class="form-group col-sm-12 col-md-6">
        {!! Form::label('password', 'Contraseña:', ['class' => 'bold']) !!}
        {!! Form::password('password', ['class' => 'form-control round']) !!} <!-- Aquí puedes dejarlo opcional -->
        <span id="errorMessage" style="color: red; display: none;"></span>
        @error('password')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <!-- Role Selection -->
    <div class="form-group col-sm-12 col-md-6">
        {!! Form::label('role', 'Rol:', ['class' => 'bold']) !!}
        <select class="form-select" id="role" name="role" required>
            <option value="">Selecciona un rol</option>
            @foreach($roles as $role)
                <option value="{{ $role->name }}" {{ ($usuario->roles->contains('name', $role->name) ? 'selected' : '') }}>{{ ucfirst($role->name) }}</option>
            @endforeach
        </select>
        @error('role')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <!-- Submit Button -->
    <div class="form-group col-sm-12 mt-3">
        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
