<div class="row">
    <!-- Nombre Field -->
    <div class="form-group col-sm-12 col-md-4">
        <label for="nombre"><strong>Nombre:</strong></label>
        {!! Form::text('nombre', $producto->nombre, ['class' => 'form-control round', 'required']) !!}
    </div>

    <!-- Descripción Field -->
    <div class="form-group col-sm-12 col-md-4">
        <label for="descripcion"><strong>Descripción:</strong></label>
        {!! Form::textarea('descripcion', $producto->descripcion, ['class' => 'form-control round', 'rows' => 3, 'required']) !!}
    </div>

    <!-- Cantidad Field -->
    <div class="form-group col-sm-12 col-md-4">
        <label for="cantidad"><strong>Cantidad:</strong></label>
        {!! Form::number('cantidad', $producto->cantidad, ['class' => 'form-control round', 'step' => '1', 'required']) !!}
    </div>
</div>

<div class="row">
    <!-- Subcategoría Field -->
    <div class="form-group col-sm-12 col-md-4">
        <label for="sub_categoria_id"><strong>Categoría:</strong></label>
        {!! Form::select('sub_categoria_id', $subcategorias, $producto->categoria_id, ['class' => 'form-control round', 'placeholder' => 'Selecciona una subcategoría', 'required']) !!}
    </div>

    <!-- Disponible Field -->
    <div class="form-group col-sm-12 col-md-4">
        <label for="disponible"><strong>Disponible:</strong></label>
        {!! Form::select('disponible', ['1' => 'Disponible', '0' => 'No Disponible'], $producto->disponible, ['class' => 'form-control round', 'required']) !!}
    </div>

    <!-- Unidad de Medida Field -->
    <div class="form-group col-sm-12 col-md-4">
        <label for="unidad_medida"><strong>Unidad de Medida:</strong></label>
        {!! Form::select('unidad_medida', [
            'pieza' => 'Pieza',
            'litro' => 'Litro',
            'kilogramo' => 'Kilogramo',
            'metro' => 'Metro',
            'centimetro' => 'Centímetro',
            'unidad' => 'Unidad',
        ], $producto->unidad_medida, ['class' => 'form-control round', 'placeholder' => 'Selecciona una unidad de medida', 'required']) !!}
    </div>
</div>

<!-- Botones de acción -->
<div class="float-end">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary round']) !!}
</div>

<script src="{{asset('js/sweetalert2.js')}}"></script>


