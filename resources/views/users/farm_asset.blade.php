@extends('users/layouts.farm_asset_master') 
@section('asset')
<article class="content forms-page">
    <div class="title-block">
        <!-- @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif -->
        <div class="title">
            <button type="button" class="btn btn-primary"  id="btnadd" data-toggle="modal"
            data-target="#addAsset">Add Asset</button>
        </div>
        <h3 class="title"> Assets</h3>

        <p class="title-description">
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-block">
                        <section class="example">
                            <div class="table-responsive">
                                <table id="assetTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Date Recorded</th>
                                            <th>Name </th>
                                            <th>Quantity</th>
                                            <th>Date Purchased</th>
                                            <th>Amount</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>12th July 2019</td>
                                            <td>Chicken Coop</td>
                                            <td>100</td>
                                            <td>22th August 2016</td>
                                            <td>5000</td>
                                            <td>askloiuytrewqwdfghjhgfds</td>
                                            <td>
                                                <!-- <button class="bttn btn-success">
                                                    <i class="fa fa-eye"></i>
                                                </button> -->
                                                <button class="bttn btn-info">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                                <button href="" class=" bttn btn-danger" data-toggle="modal" data-target="#deleteAssetModal">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
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


<!-- Modal -->
<div class="modal fade" id="deleteAssetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this asset
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" data-dismiss="modal" data-token="{{csrf_token()}}" class="delete-customer btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- ADD P MODAL -->
<div class="modal fade" id="addAsset" tabindex="-1" role="dialog" aria-labelledby="addAsset" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <section class="section">
            <div class="col-md-12">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelTitleId">Asset</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-content">
                    <div class="card card-block sameheight-item">
                        <form method="" id="employeeForm" action="">    
                            <div class="row form-group">
                                <div class="col-6">
                                    <div class="row">
                                        <label class="col-sm-4 form-control-label">Name<label style="color: red;">*</label></label>
                                        <div class="col-sm-8">
                                            <input required type="text" class="form-control" placeholder="Asset name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <label class="col-sm-4 form-control-label">D.O.P<label style="color: red;">*</label></label>
                                        <div class="col-sm-8">
                                            <input required type="text" class="form-control" placeholder="mm-dd-yy">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-6">
                                    <div class="row">
                                        <label class="col-sm-4 form-control-label">Quantity<label style="color: red;">*</label></label>
                                        <div class="col-sm-8">
                                            <input required type="number" class="form-control"  placeholder="0">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class=" row">
                                        <label  class="col-sm-4 form-control-label">Amount<label style="color: red;">*</label></label>
                                        <div class="col-sm-8">
                                            <input required type="text" class="form-control" placeholder="0.00">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-6">
                                    <div class="row">
                                        <label class="col-sm-4 form-control-label">Description</label>
                                        <div class="col-sm-8">
                                            <fieldset class="form-group">
                                                <textarea rows="2" class="form-control"></textarea>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection