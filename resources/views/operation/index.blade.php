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
                    <th scope="col" class="align-middle">Kirim Qilish</th>
                    <th scope="col" class="align-middle">Chiqim Qilish</th>
                    <th scope="col" class="align-middle">Tarix</th>
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
                            <button type="button"  data-bs-toggle="modal" data-bs-target="#modal{{ $loop->index }}"class="btn btn-success" ><i class="bi bi-arrow-down-square"></i></button> 
                            <div class="modal fade" id="modal{{ $loop->index }}" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                <form action="{{route('admin.operation.income', ['staff' => $staff->id])}}" method="post">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel2"><b>{{ $staff->name }}dan Kirim Qilish</b></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col-sm-12">
                                                <input type="numeric" class="form-control" placeholder="Summani Kiriting"  name="sum" required>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row mb-3">
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" placeholder="Izoh"  name="comment">
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

                        <td>
                            <button type="button"  class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal1{{ $loop->index }}"><i class="bi bi-arrow-up-square"></i></button> 
                            <div class="modal fade" id="modal1{{ $loop->index }}" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                <form action="{{route('admin.operation.outcome', ['staff' => $staff->id])}}" method="post">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel2"><b>{{ $staff->name }}ga Chiqim Qilish</b></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <a href="{{route('admin.operation.order', ['staff' => $staff->id])}}"  class="modal-title" id="exampleModalLabel2"><b>{{ $staff->name }}ga Zakaz Urish</b></a>
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col-sm-12">
                                                <input type="numeric" class="form-control" placeholder="Summani Kiriting" name="sum" required>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row mb-3">
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" placeholder="Izoh"  name="comment">
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
                        <td>
                            <a href="{{route('admin.operation.history',['staff'=>$staff])}}" class="btn btn-success"><i class="bi bi-list-task"></i></a>
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
                    <th scope="col" class="align-middle">Kirim Qilish</th>
                    <th scope="col" class="align-middle">Chiqim Qilish</th>
                    <th scope="col" class="align-middle">Tarix</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
<div class="modal fade" id="modalfilter" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
    <form action="{{ route('admin.operation.index') }}" method="get">
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