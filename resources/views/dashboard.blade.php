@php
    $total = 0;
    $totalspecial = 0;
@endphp
@extends('layouts.main');
@section('content')
<section class="section dashboard">
    <div class="row">
        <div class="col-lg-8">
            <div class="row">
              <div class="col-12">
                <div class="card top-selling overflow-auto">
  
                  <div class="card-body pb-0">
                    <h5 class="card-title">Hisob Kitoblar <span>Kunlik</span></h5>
  
                    <table class="table table-borderless">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Inson</th>
                          <th scope="col">Summa</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($data as $item)
                          <tr>
                              <td colspan="3">
                                  <b>{{ $loop->index+1 }}: {{ $item->name }}</b>
                              </td>  
                          </tr>
                          @php
                              $totalspecial = 0;
                          @endphp
                          @foreach ($item->staffes as $staff)
                              <tr>
                                  <td>
                                    <b>{{ $loop->index+1 }}</b>
                                  </td>
                                  <td>
                                    {{ $staff->name }}
                                  </td>
                                  <td>
                                    {{ number_format($staff->balance) }}
                                  </td>
                              </tr>
                              @php
                                  $totalspecial = $totalspecial + $staff->balance;
                              @endphp
                          @endforeach  
                              @php
                                  $total = $total + $totalspecial;
                              @endphp 
                            <tr>
                                <td colspan="3">
                                    <b>Jami: {{ number_format($totalspecial) }}</b>
                                </td>  
                            </tr> 
                        @endforeach
                        <tr>
                            <td colspan="3">
                                <b>Umumiy: {{ number_format($total) }}</b>
                            </td>  
                        </tr> 
                      </tbody>
                    </table>
  
                  </div>
  
                </div>
              </div>
              </div>
          </div>
        </div><!-- End Left side columns -->
      </div>
    </section>
@endsection
