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
                <h5 class="card-title">Kirimlar Tarixi </h5> 
            </div> 
            <p></p> 
            <button type="button"  class="btn btn-secondary float-end" data-bs-toggle="modal" data-bs-target="#modalfilter"><i class="bi bi-funnel"></i></button> 
        </div> 
            <input type="text" class="form-control"  name="karobka" id="myInput" onkeyup="searchtable('myInput','myTable')" placeholder="Qidirish"> 
        <table class="table table-hover" id="myTable">
            <thead>
                <tr>
                    <thead>
                        <th>#</th>
                        <th>Inson</th>
                        <th>Sana</th>
                        <th>Summa</th>
                        <th>Izoh</th>
                    </thead>
                </tr>
            </thead>
            <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>
                                {{ $loop->index + 1 }}
                            </td>
                            <td>
                                {{ $item->custom->name }}
                            </td>
                            <td>
                                {{ $item->date }}
                            </td>
                            <td>
                                {{ number_format($item->sum) }}
                            </td>
                            @php
                                $total = $total + $item->sum;
                            @endphp
                            <td>
                                {{ $item->comment }}
                            </td>
                        </tr>
                    @endforeach
            </tbody>
            <tfoot>
               <tr>
                    <th>#</th>
                    <th>Inson</th>
                    <th>Sana</th>
                    <th>{{ number_format($total) }}</th>
                    <th>Izoh</th>
               </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
<div class="modal fade" id="modalfilter" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
    <form action="{{ route('admin.operation.incomes') }}" method="get">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel2">Filtrlash</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row mb-3">
                <div class="col-sm-12">
                    <select class="form-select"  name="custom_id">
                        <option value="">Insonni Tanlash</option>
                        @foreach ($staffes as $staff)
                            <option value="{{$staff->id}}">{{ $staff->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <p></p>
            <div class="row mb-3">
                <div class="input-group flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping">Sanadan</span>
                    <input type="date" class="form-control" aria-label="Username" aria-describedby="addon-wrapping" name="from">
                </div>
                <p></p>
                <div class="input-group flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping">Sanagacha</span>
                    <input type="date" class="form-control" aria-label="Username" aria-describedby="addon-wrapping" name="to">
                </div>
            </div>
            <br>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Yopish</button>
            <button type="submit" class="btn btn-primary">Tanlash</button>
        </div>
    </div>
    </form>
    </div>
</div>