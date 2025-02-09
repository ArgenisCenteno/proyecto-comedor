<div class="row">
    <!-- RIF Field -->
    <div class="form-group col-sm-12 col-md-6">
        <label for="rif"><strong>RIF:</strong></label>
        {!! Form::text('rif', null, ['class' => 'form-control round', 'required']) !!}
    </div>

    <!-- Razón Social Field -->
    <div class="form-group col-sm-12 col-md-6">
        <label for="razon_social"><strong>Nombre / Razón Social:</strong></label>
        {!! Form::text('razon_social', null, ['class' => 'form-control round', 'required']) !!}
    </div>

    <!-- Teléfono Field -->
    <div class="form-group col-sm-12 col-md-6">
    <label for="telefono"><strong>Teléfono:</strong></label>
    <div class="row">
        <div class="col-md-3">
            {!! Form::select('prefijo', [
                '0412' => '0412',
                '0414' => '0414',
                '0426' => '0426',
                '0424' => '0424'
            ], null, ['class' => 'form-control round', 'required']) !!}
        </div>
        <div class="col-md-8">
            {!! Form::text('telefono', null, ['id' => 'telefono', 'class' => 'form-control round', 'required']) !!}
        </div>
    </div>
</div>

    <!-- Email Field -->
    <div class="form-group col-sm-12 col-md-6">
        <label for="email"><strong>Email:</strong></label>
        {!! Form::email('email', null, ['class' => 'form-control round', 'required']) !!}
    </div>

    <!-- Estado Field -->
    <div class="form-group col-sm-12 col-md-6">
        <label for="estado"><strong>Estado:</strong></label>
        {!! Form::select('estado', ['MONAGAS' => 'Monagas'], null, ['class' => 'form-control round', 'required']) !!}
    </div>

    <!-- Municipio Field -->
    <div class="form-group col-sm-12 col-md-6">
        <label for="municipio"><strong>Municipio:</strong></label>
        {!! Form::select('municipio', ['EZEQUIEL ZAMORA' => 'Ezequiel Zamora'], null, ['class' => 'form-control round', 'required']) !!}
    </div>

    <!-- Parroquia Field -->
    <div class="form-group col-sm-12 col-md-6">
        <label for="parroquia"><strong>Parroquia:</strong></label>
        {!! Form::select('parroquia', [
    'PUNTA DE MATA' => 'Punta de Mata',
    'TEJERO' => 'Tejero'
], null, ['class' => 'form-control round', 'required']) !!}
    </div>

</div>

<!-- Botones de acción -->
<div class="float-end">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary round', 'id' => 'submit_btn']) !!}
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Restricción para los campos "estado", "parroquia" y "municipio"
        document.querySelectorAll('#estado, #parroquia, #municipio').forEach(function (input) {
            input.addEventListener('input', function () {
                const regex = /^[a-zA-ZñÑ\s]*$/;
                if (!regex.test(this.value)) {
                    this.value = this.value.replace(/[^a-zA-ZñÑ\s]/g, '');
                }
            });
        });

        // Restricción para el campo "telefono"
        const telefonoInput = document.getElementById('telefono');
    telefonoInput.addEventListener('input', function () {
        const regex = /^[0-9]*$/;
        if (!regex.test(this.value) || this.value.length > 8) {
            this.value = this.value.replace(/[^0-9]/g, '').slice(0, 8);
        }
    });

        // Validación para el campo "rif"
        const rifInput = document.getElementById('rif');
        const submitButton = document.getElementById('submit_btn');
        const rifError = document.createElement('small');
        rifError.style.color = 'red';
        rifInput.parentNode.appendChild(rifError);


        rifInput.addEventListener('input', function () {
            const rifPattern = /^[VJPG][0-9]{8}[0-9]$/;
            if (!rifPattern.test(this.value)) {
                rifError.textContent = 'RIF inválido. Debe seguir el formato correcto.';
                rifInput.style.border = '2px solid red'
                submitButton.disabled = true;
            } else {
                rifError.textContent = '';
                rifInput.style.border = ''
                submitButton.disabled = false;
            }
        });
    });
</script>