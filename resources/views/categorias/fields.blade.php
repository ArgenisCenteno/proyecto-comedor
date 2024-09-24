<div class="row">
    <!-- Name Field -->
    <div class="form-group col-sm-12 col-md-6">
       <label for=""><strong>Nombre</strong></label>
        {!! Form::text('nombre', null, ['class' => 'form-control round']) !!}
    </div>
    <div class="form-group col-sm-12 col-md-6">
       <label for=""><strong>Estado</strong></label>
        {!! Form::select('status', [
           '1' => 'Activo',
           '0' => 'Inactivo',
            ], null, ['class' => 'form-control round']) !!}

    </div>
</div>

<!-- Submit Field -->
<div class="float-end">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary round']) !!}
</div>