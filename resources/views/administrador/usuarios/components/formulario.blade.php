<div>
    <label for="nombreUsuario">Nombre:</label>
    <input name="name" type="text" value="@isset($usuario){{$usuario->name}}@else{{old('name')}}@endisset">   
</div>

<div>
    <label for="emailUsuario">Email:</label>
    <input name="email" type="text" value="@isset($usuario){{$usuario->email}}@else{{old('email')}}@endisset">
</div>

@isset($usuario)
    <div>
        <input type="radio" id="radio_con_password" name="cambio_password" value="generar" onclick="generarPassword('con_password')">
        <label for="">Generar nueva contraseña</label>

        <input type="radio" id="radio_sin_password" name="cambio_password" value="no_generar" onclick="generarPassword('sin_password')" checked>
        <label for="">Mantener la contraseña</label>
    </div>

@endisset

<div id="campo_password">
    <label for="passwordUsuario">Contraseña:</label>
    <input name="password" type="password" >
</div>

<div>
    <h5>Listado de roles</h5>

    @if(isset($usuario))
        @foreach ($roles as $rol)
            <div>
                <label>
                    <input type="checkbox" name="roles[]" value="{{$rol->id}}"  {{ $usuario->roles && $usuario->roles->contains($rol->id) ? 'checked' : '' }}>
                    {{$rol->name}}
                </label>
            </div>
        @endforeach
    @else

        @foreach ($roles as $rol)
            <div>
                <label>
                    <input type="checkbox" name="roles[]" value="{{$rol->id}}">
                    {{$rol->name}}
                </label>
            </div>
        @endforeach

    @endif
    
</div>


<div>
    <button type="submit">Aceptar</button>
</div>


<script>
    var campo_password = document.getElementById('campo_password');

    campo_password.style.display = 'none';

    function generarPassword(generar) {

        if (generar === 'con_password') {
            campo_password.style.display = 'block';
            
        } else if (generar === 'sin_password') {
            campo_password.style.display = 'none';
        }
    }
</script>