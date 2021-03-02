@extends('users/layouts.cyclelistmaster')
@section('cyclelist')

<article class="content forms-page">
            <div class="title-block">
                <h3 class="title">List of farm batches</h3>

                <p class="title-description"> 

           
            
            
            </p> 
            </div>

            <section class="section">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-block">
                                <section class="example">
                                    <div class="table-responsive">
                                        <table id="dataTable" class="table table-bordered table-hover" >
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Batches</th>
                                                    {{-- <th>Quantity</th> --}}
                                                    {{-- <th>Status</th>
                                                    <th>Action</th>        --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($stockTracking as $track) 
                                                <tr>
                                                    <td>{{\Carbon\Carbon::parse($track->created_at)->format('jS \o\f F, Y')}}</td>
                                                    <td>{{$track->batch_id}}</td>
                                                    {{-- <td>{{$track->number_of_stock}}</td> --}}
{{--                                                    
                                                    <td>Open</td>
                                                    <td>
                                                        
                                                     

                                                    <button class="delete-stocking-url delete-modal btn btn-danger" data-toggle="modal" data-target="#deletePenStockingModal" data-href="">
                                                        <i class="fa fa-trash"></i>
                                                    </button><br>
                                                    </td>

                                                     --}}
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
</article>       
@endsection