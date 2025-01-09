@php
    $total = 0;
@endphp
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
                <h5 class="card-title">Insonlar</h5> 
            </div> 
            <p></p> 
            <button type="button"  class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#modalstore"><i class="bi bi-plus-square-dotted"></i></button> 
            <button type="button"  class="btn btn-secondary float-end" data-bs-toggle="modal" data-bs-target="#modalfilter"><i class="bi bi-funnel"></i></button> 
        </div> 
            <input type="text" class="form-control"  name="karobka" id="myInput" onkeyup="searchtable('myInput','myTable')" placeholder="Qidirish"> 
        <table class="table table-hover" id="myTable">
            <thead>
                <tr>
                    <th scope="col" class="align-middle">#</th>
                    <th scope="col" class="align-middle">Nomi</th>
                    <th scope="col" class="align-middle">Toifasi</th>
                    <th scope="col" class="align-middle">Balans</th>
                    <th scope="col" class="align-middle">Amallar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($staffes as $staff)
                <tr id="{{ $staff->type_id }}">
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{ $staff->name }}</td>
                        <td>{{ $staff->type->name }}</td>
                        <td>{{ number_format($staff->balance) }}</td>
                        @php
                            $total = $total + $staff->balance;
                        @endphp
                        <td>
                            <button type="button"  class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal{{ $loop->index }}"><i class="bi bi-pencil"></i></button> 
                            <div class="modal fade" id="modal{{ $loop->index }}" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                <form action="{{route('admin.staff.update', ['staff' => $staff->id])}}" method="post">
                                    @csrf
                                    @method('put')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel2">Tahrirlash</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row mb-3">
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" placeholder="Nomini Kiriting" name="name" value="{{ $staff->name }}" required>
                                            </div>
                                        </div>
                                        <p></p>
                                        <div class="row mb-3">
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" placeholder="Telegram Chat Id" name="tg_chat_id" value="{{ $staff->tg_chat_id }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <select class="form-select" name="type_id" required>
                                                <option value="">Toifani tanlash</option>
                                                @foreach ($types as $type)
                                                    <option value="{{ $type->id }}" @if($type->id == $staff->type_id) {{ 'selected' }} @endif>
                                                        {{ $type->name }}
                                                    </option>
                                                @endforeach
                                            </select>
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
            <tfoot>
                <tr>
                    <th scope="col" class="align-middle">#</th>
                    <th scope="col" class="align-middle">Nomi</th>
                    <th scope="col" class="align-middle">Toifasi</th>
                    <th scope="col" class="align-middle">{{ number_format($total) }}</th>
                    <th scope="col" class="align-middle">Amallar</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
<div class="modal fade" id="modalstore" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
    <form action="{{route('admin.staff.store')}}" method="POST">
        @csrf
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel2">Hudud Qo'shish</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            @csrf
            <div class="row mb-3">
                <div class="col-sm-12">
                    <input type="text" class="form-control" placeholder="Ismni Kiriting" name="name"  required>
                </div>
            </div>
            <p></p>
            <div class="row mb-3">
                <div class="col-sm-12">
                    <input type="number" class="form-control" placeholder="Qarzdorlik" name="balance"  required>
                </div>
            </div>
            <p></p>
            <div class="row mb-3">
                <div class="col-sm-12">
                    <input type="text" class="form-control" placeholder="Telegram Chat Id" name="tg_chat_id"  >
                </div>
            </div>
            <div class="col-sm-12">
                <select class="form-select" name="type_id" required>
                    <option value="">Inson Toifasini</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}">
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
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


<div class="modal fade" id="modalfilter" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
    <form action="{{ route('admin.staff.index') }}" method="get">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel2">Filtrlash</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row mb-3">
                <div class="col-sm-12">
                    <select class="form-select"  name="type_id">
                        <option value="">Toifani Tanlash</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Yopish</button>
            <button type="submit" class="btn btn-primary">Tanlash</button>
        </div>
    </div>
    </form>
    </div>
</div>