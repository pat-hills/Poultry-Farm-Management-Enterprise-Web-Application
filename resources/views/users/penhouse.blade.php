@extends('users/layouts.penhousemaster') 
@section('penhouse')

<article class="content forms-page">
    <div class="title-block">
        @if (Session::has('message'))
        <p class="alert {{Session::get('alert-class', 'alert-info') }}"> {{ Session::get('message') }}</p>
        @endif
        <div class="title">
            <button type="button" class="btn btn-primary" id="btnadd" data-toggle="modal" data-target="#addPenhouse">Add Penhouse</button>

        </div>
        <h3 class="title">Penhouses</h3>

        <p class="title-description">
            </p>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-block">
                        <section class="example">
                            <div class="table-responsive" style=>
                                <table id="dataTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Date Created</th>
                                            <th>Pen House Name</th>
                                            <th>Pen Number </th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($penHouse as $pen)
                                        <tr>
                                            <td>{{\Carbon\Carbon::parse($pen->date_paid)->format('jS \o\f F, Y')}}</td>
                                            <td>{{$pen->pen_name}}</td>
                                            <td>{{$pen->pen_number}}</td>
                                            <td>{{$pen->stocked}}</td>
                                            <td>
                                                <button class="btn btn-info" data-toggle="modal" data-target="#addBranch">
                                                                <i class="fa fa-pencil"></i>
                                                            </button>
                                                <button class="btn btn-danger" data-toggle="modal" data-target="#confirm-modal">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                            </td>
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



<!-- ADD PENHOUSE MODAL -->
<div class="modal fade" id="addPenhouse" tabindex="-1" role="dialog" aria-labelledby="addPenhouse" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <section class="section">
            <div class="col-md-12">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelTitleId">Penhouse Recording</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-content">
                    <div class="card card-block sameheight-item">
                        <form method="POST" action="{{route('birds.penhouses')}}" class="mt-5">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Penhouse Name</label>
                                        <input required type="text" class="form-control" name='penHouse' placeholder="Enter penhouse name">
                                    </div>
                                </div>

                                <div class="col-md-12 col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Pen Number</label>
                                        <input required type="text" value="{{$penNum+1}}" class="form-control" name="penNumber" placeholder="Enter pen number ">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection