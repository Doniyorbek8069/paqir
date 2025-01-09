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
                <h5 class="card-title">{{$staff->name}}</h5> 
            </div> 
            <p></p> 
        </div> 
            <input type="text" class="form-control"  name="karobka" id="myInput" onkeyup="searchtable('myInput','myTable')" placeholder="Qidirish"> 
        <table class="table table-hover" id="myTable">
            <thead>
                <tr>
                    <th scope="col" class="align-middle">#</th>
                    <th scope="col" class="align-middle">Sana</th>
                    <th scope="col" class="align-middle">Kirim</th>
                    <th scope="col" class="align-middle">Chiqim</th>
                    <th scope="col" class="align-middle">Turi</th>
                    <th scope="col" class="align-middle">Qarzdorlik</th>
                    <th scope="col" class="align-middle">Izoh</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{ $item->date }}</td>
                        <td>{{ number_format($item->input) }}</td>
                        <td>{{ number_format($item->output) }}</td>
                        <td>
                            @foreach ($types as $type)
                                @if ($type['id'] == $item->type)
                                    <b>{{ $type['name'] }}</b> 
                                @endif
                            @endforeach
                        </td>
                        <td>{{ number_format($item->debt) }}</td>
                       
                        <td>
                            {{ $item->comment }}
                        </td>
                        <td>
                            @if ($item->output > 0)
                                @if (count($item->order->products) > 0)
                                    @foreach ($item->order->products as $productone)
                                        {{ $productone->name->name }} : {{ number_format($productone->number) }} * {{ number_format($productone->price) }} <br>
                                    @endforeach
                                @endif 
                            @endif
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