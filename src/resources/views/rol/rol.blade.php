@extends('layouts.backend')
@section('content')
<div class="content">
    <h3>
        @if(empty($roles))
        Crear
        @endif
        Rol
    </h3>
    <form method="post" action="/rol/guardar" class="js-validation">
        {{ csrf_field() }}
          <div class="row">
              <div class="form-group col-md-6">
                  <label for="val-username">Nombre Rol<span class="text-danger">*</span></label>
                  <input type="text" name="nombre" class="form-control" id="val-username" placeholder="Nombre" value="{{ (!empty($roles)) ? $roles->descripcion : '' }}" required="required">
              </div>
              <div class="form-group col-md-6">
                    <label class="d-block text-center"><span class="text-muted">Puedes modificar roles / o cambiar el nombre del Rol</span></label>
                    <button type="submit" class="btn btn-primary ml-3 w-100" id="btnguardar"><i class="fa fa-check mr-1"></i> Guardar</button>
              </div>
          </div>
        <input type="hidden" name="id" value="{{ (!empty($roles)) ? $roles->id : "" }}">
</div>

@if(!empty($roles))
 <!-- Main Container -->
 <main>
     <!-- Page Content -->
        <div class="content">
                <div class="block-content">
                    <!-- If you put a checkbox in thead section, it will automatically toggle all tbody section checkboxes -->
                    <table class="js-table-checkable table table-hover table-vcenter">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 70px;">
                                    <div class="custom-control custom-checkbox custom-control-primary d-inline-block">
                                        <input type="checkbox" class="custom-control-input" id="check-all" name="check-all">
                                        <label class="custom-control-label" for="check-all"></label>
                                    </div>
                                </th>
                                <th class="d-none d-sm-table-cell" style="width: 15%;">Tipo</th>
                                <th>Url</th>         
                                <th>Controller</th>   
                                <th class="d-none d-sm-table-cell" style="width: 20%;">Fecha Modificación</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permisos as $permiso)                                
                            <tr>
                                <td class="text-center">
                                    <div class="custom-control custom-checkbox custom-control-primary d-inline-block">
                                        <input type="checkbox" class="custom-control-input" id="input_{{$permiso['id']}}" name="permiso[]" value="{{$permiso['id']}}"                                      
                                        @foreach ($permisosrol as $pdelrol)    
                                            @if($pdelrol->id == $permiso['id']){
                                                {{"checked"}}
                                            }
                                            @endif
                                        @endforeach
                                        
                                        >
                                        <label class="custom-control-label" for="input_{{$permiso['id']}}"></label>
                                    </div>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                        <span class="badge  {{ $permiso['type'] == 'post' ?'badge-danger' : 'badge-warning' }}"> {{strtoupper($permiso['type'])}}</span>
                                    </td>
                                <td>                                   
                                    <p class="font-w600 mb-1">
                                        {{$permiso['url']}}
                                    </p>
                                </td>    
                                <td>                                   
                                    <p class="font-w600">
                                            {{$permiso['controller']}}
                                    </p>
                                    </td>                
                                <td class="d-none d-sm-table-cell">
                                    <em class="font-size-sm text-muted"> {{$permiso['updated_at']}}</em>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END Checkable Table -->
        </form>
    </main>
    <!-- END Main Container -->
@endif

@push('footer-script')
<script>
   
</script>
@endpush
@endsection
