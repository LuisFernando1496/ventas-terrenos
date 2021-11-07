<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Unidades de negocio
            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                class="font-semibold btn btn-outline-success  float-right">
                <i class="bi bi-pencil">Crear Unidad</i>
            </button>
        </h2>
    </x-slot>
    <div class="d-flex flex-column bd-highlight mb-3">

        <form class="  float-right " style="margin-top: 20px ;width: 450px; padding-left: 70px">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Bascar...">
            </div>


        </form>

    </div>
@foreach ($business as $unit)
<div class="p-2 bd-highlight">
    <div class="col-auto d-flex flex-row justify-content-center alig-items-center">
        <div class="card mb-3" style="width: 90%; margin-top: 20px">
            <div class="row g-0">
                <div class="col-md-4 position-relative">

                    <img src="{{ asset($unit->photo) }}"
                        class="rounded position-absolute top-50 start-50 translate-middle"
                        style="width: 250px;height:250px" alt="">

                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h3 class="card-title"><strong>{{$unit->name}}</strong></h3>
                        <p class="card-text">{{$unit->description}}</p>
                        <br>
                        <hr>
                        <br>
                        <div class="card-text">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Total de proyectos</th>
                                        <th>Proyectos en desarrollo</th>
                                        <th>Proyectos terminados</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center">
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                        <div class="card-text">
                            <p><small class="text-muted">Unidad de negocio creada {{$unit->created_at->diffForHumans()}}</small></p>
                            <a href="#" class="float-right btn btn-outline-danger btn-sm"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-trash" viewBox="0 0 16 16">
                                    <path
                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                    <path fill-rule="evenodd"
                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                </svg></a>
                            <button class="float-right btn btn-outline-warning btn-sm"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path
                                        d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                </svg></button>


                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endforeach
  



    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('bussinesUnit.store') }}" method="POST" enctype="multipart/form-data" >
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Crear Unidad de negocio</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Nombre de la unidad</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Descripción</label>
                                    <textarea type="text" cols="1" rows="0.5" class="form-control" name="description"
                                        required> </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Subir imagen</label>
                                    <input type="file" class="form-control" name="imagen" required> 
                                </div>
                            </div>
                        </div>
                      
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success">Crear</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
</x-app-layout>
