@extends('layouts.backend')
@section('content')
<div class="block block-rounded block-bordered">
    <div class="block-header block-header-default">
        <h3 class="block-title">Listado de Roles</h3>
        <a type="button" class="btn btn-hero-success m-2" href="/rol/crear">
            <i class="fa fa-fw fa-plus mr-1"></i> Crear Rol
        </a>
    </div>
    @if (session('msg'))
    <div class="alert alert-success">
       {{ session('msg') }}
    </div>
    @endif
    <div class="block-content block-content-full">
        <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
        <div class="table-responsive">
        <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
        <thead>
        <tr>
            <th class="d-none d-sm-table-cell" style="width: 10%;">Nombre</th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($roles))
            @foreach($roles as $_rol)
            <tr>
                <td class="text-center color-primary">
                    <a  href="/rol/editar/{{ $_rol->id }}">
                        {{ $_rol->descripcion }}
                    </a>
                </td>
            </tr>
            @endforeach
        @else
            <tr>
                <td colspan="3">No hay Punto de Ventas</td>
            </tr>
        @endif
        </tbody>
        </table>
      </div>
    </div>
 </div>
@endsection
