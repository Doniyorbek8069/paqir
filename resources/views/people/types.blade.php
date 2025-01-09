
@extends('layouts.main');
@section('content')
<div class="card">
    <div class="card-body">
        @if($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{$error}}</div>
            @endforeach
        @endif      
        <div class="mb-5"> 
            <div class="float-start"> 
                <h5 class="card-title">Insonlar Turlari</h5> 
            </div> 
            <p></p> 
            <button type="button"  class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#modalstore"><i class="bi bi-plus-square-dotted"></i></button> 
        </div> 
            <input type="text" class="form-control"  name="karobka" id="myInput" onkeyup="searchtable('myInput','myTable')" placeholder="Qidirish"> 
  
        <table class="table table-hover" id="myTable">
            <thead>
                <tr>
                    <th scope="col" class="align-middle">#</th>
                    <th scope="col" class="align-middle">Nomi</th>
                    <th scope="col" class="align-middle">Amallar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($types as $type)
                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{ $type->name }}</td>
                        <td>
                            <button type="button"  class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal{{ $loop->index }}"><i class="bi bi-pencil"></i></button> 
                            <div class="modal fade" id="modal{{ $loop->index }}" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                <form action="{{route('admin.staff.typeupdate', ['type' => $type->id])}}" method="post">
                                    @csrf
                                    @method('put')
                                    <div class="modal-header">
                                        <input type="hidden" name="territory_id" value="{{ $type->id }}" required>
                                        <h5 class="modal-title" id="exampleModalLabel2">Extiyot bo'ling Savdo Agenti o'zgarishi orqalik</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" placeholder="Nomini Kiriting" name="name" value="{{ $type->name }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Yopish</button>
                                    <button type="submit" class="btn btn-primary">Saqlash</button>
                                    </div>
                                </div>
                                </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
<div class="modal fade" id="modalstore" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
    <form action="{{route('admin.staff.typestore')}}" method="POST">
        @csrf
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel2">Hudud Qo'shish</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            @csrf
            <div class="row mb-3">
                <div class="col-sm-12">
                    <input type="text" class="form-control" placeholder="Hudud Nomini Kiriting" name="name"  required>
                </div>
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Yopish</button>
        <button type="submit" class="btn btn-primary">Saqlash</button>
        </div>
    </div>
    </form>
    </div>
</div>