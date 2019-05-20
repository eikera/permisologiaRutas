@extends('layouts.backend')
@section('content')
<div class="content">
    <h3>
        Crear Permisos / Rutas
    </h3>
    <form method="post" action="/permisos/guardar" class="js-validation">
        {{ csrf_field() }}
          <div class="row">
             <div class="form-group col-md-2">
                        <label for="val-username">Tipo<span class="text-danger">*</span></label>
                        <select class="js-select2 form-control" id="example-select2" name="type" style="width: 100%;" data-placeholder="Tipo">
                                <option></option>
                                <option value="get">GET</option>
                                <option value="post">POST</option>
                            </select>

                </div>
              <div class="form-group col-md-3">
                  <label for="val-username">Url<span class="text-danger">*</span></label>
                  <input type="text" name="url" class="form-control" id="val-username" placeholder="/URL" value="{{ (!empty($roles)) ? $roles->descripcion : '' }}" required="required">
              </div>
              <div class="form-group col-md-4">
                    <label for="val-username">Controller<span class="text-danger">*</span></label>
                    <input type="text" name="controller" class="form-control" id="val-username" placeholder="Controller@index" value="{{ (!empty($roles)) ? $roles->descripcion : '' }}" required="required">
                </div>
                <div class="form-group col-md-3">
                        <label for="val-username">Alias <span class="text-danger">*</span></label>
                        <input type="text" name="nombre" class="form-control" id="val-username" placeholder="alias" value="{{ (!empty($roles)) ? $roles->descripcion : '' }}" required="required">
                </div>
              <div class="col-md-12">
                    <button type="submit" class="btn btn-primary w-100" id="btnguardar"><i class="fa fa-check mr-1"></i> Guardar</button>
              </div>
          </div>
    </form>
</div>

 <!-- Main Container -->
 <main>
     <!-- Page Content -->
        <div class="content">
                <div class="block-content">
                    <!-- If you put a checkbox in thead section, it will automatically toggle all tbody section checkboxes -->
                    <table class="js-table-checkable table table-hover table-vcenter">
                        <thead>
                            <tr>
                                <th class="d-none d-sm-table-cell" style="width: 15%;">Tipo</th>
                                <th>Url</th>         
                                <th>Controller</th>   
                                <th class="d-none d-sm-table-cell" style="width: 20%;">Fecha Modificación</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permisos as $permiso)                                
                            <tr>
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
    </main>
    <!-- END Main Container -->

@push('footer-script')
<script>
   
</script>
@endpush
@endsection
