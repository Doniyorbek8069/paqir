
@extends('layouts.main');
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.order.store',['staff'=>$staff]) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success float-end" ><i class="ri-save-3-line"></i></button> 
            
            <input type="text" class="form-control"   id="myInput" onkeyup="searchtable('myInput','myTable')" placeholder="Qidirish"> 
            <table class="table table-hover" id="myTable">
                <thead>
                    <tr>
                        <th scope="col" class="align-middle">#</th>
                        <th scope="col" class="align-middle">Mahsulot Nomi</th>
                        <th scope="col" class="align-middle">Soni</th>
                        <th scope="col" class="align-middle">Narxi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $item)
                        <tr id="{{ $item->category_id }}">
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td colspan="2">  
                                <input type="number" step="0.001" class="form-control float-right" placeholder="Dona" name="products[{{$loop->index}}][amount]" oninput="calculate()" >
                                <input type="hidden" placeholder="Dona" name="products[{{$loop->index}}][id]" value="{{ $item->id }}">
                            </td>
                            <td>
                                <input type="number" step="0.001" class="form-control float-center" placeholder="Narx" name="products[{{$loop->index}}][price]" value="{{ $item->price }}" oninput="calculate()">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tr>
                    <td colspan="5">
                        <b>
                            <p id="text">

                            </p>
                        </b>
                    </td>
                </tr>
            </table>
            <input type="text" class="form-control" name="comment" placeholder="Komment" > 
        </form>
    </div>
</div>
@endsection