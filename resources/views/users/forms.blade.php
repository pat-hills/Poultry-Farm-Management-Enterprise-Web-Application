@extends('users.layout')


@section('content')

    <section class="section">
                        <div class="row sameheight-container">
                            <div class="col-md-6">
                                <div class="card card-block sameheight-item">
                                    <div class="title-block">
                                        <h3 class="title"> Control Sizing </h3>
                                    </div>
                                    <form role="form">
                                        <div class="form-group">
                                            <input class="form-control form-control-lg" type="text" placeholder=".form-control-lg"> </div>
                                        <div class="form-group">
                                            <input class="form-control" type="text" placeholder="Default input"> </div>
                                        <div class="form-group">
                                            <input class="form-control form-control-sm" type="text" placeholder=".form-control-sm"> </div>
                                        <div class="form-group">
                                            <select class="form-control form-control-lg">
                                                <option>Option one</option>
                                                <option>Option two</option>
                                                <option>Option three</option>
                                                <option>Option four</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control">
                                                <option>Option one</option>
                                                <option>Option two</option>
                                                <option>Option three</option>
                                                <option>Option four</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control form-control-sm">
                                                <option>Option one</option>
                                                <option>Option two</option>
                                                <option>Option three</option>
                                                <option>Option four</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card card-block sameheight-item">
                                    <div class="title-block">
                                        <h3 class="title"> Column sizing </h3>
                                    </div>
                                    <form role="form">
                                        <div class="row form-group">
                                            <div class="col-6">
                                                <input type="text" class="form-control" placeholder=".col-6"> </div>
                                            <div class="col-6">
                                                <input type="text" class="form-control" placeholder=".col-6"> </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-2">
                                                <input type="text" class="form-control" placeholder=".col-2"> </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control" placeholder=".col-3"> </div>
                                            <div class="col-7">
                                                <input type="text" class="form-control" placeholder=".col-7"> </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-2">
                                                <input type="text" class="form-control" placeholder=".col-2"> </div>
                                            <div class="col-2 col-offset-1">
                                                <input type="text" class="form-control" placeholder=".col-2"> </div>
                                            <div class="col-2 col-offset-2">
                                                <input type="text" class="form-control" placeholder=".col-2"> </div>
                                            <div class="col-2 col-offset-1">
                                                <input type="text" class="form-control" placeholder=".col-2"> </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-3">
                                                <input type="text" class="form-control" placeholder=".col-3"> </div>
                                            <div class="col-4 col-offset-1">
                                                <input type="text" class="form-control" placeholder=".col-4"> </div>
                                            <div class="col-3 col-offset-1">
                                                <input type="text" class="form-control" placeholder=".col-3"> </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-4">
                                                <input type="text" class="form-control" placeholder=".col-4"> </div>
                                            <div class="col-3 col-offset-3">
                                                <input type="text" class="form-control" placeholder=".col-3"> </div>
                                            <div class="col-2">
                                                <input type="text" class="form-control" placeholder=".col-2"> </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-3">
                                                <input type="text" class="form-control" placeholder=".col-3"> </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control" placeholder=".col-3"> </div>
                                            <div class="col-5 col-offset-1">
                                                <input type="text" class="form-control" placeholder=".col-5"> </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                    <div class="subtitle-block">
                        <h3 class="subtitle"> Form Layouts </h3>
                    </div>
                    <section class="section">
                        <div class="row sameheight-container">
                            <div class="col-md-6">
                                <div class="card card-block sameheight-item">
                                    <div class="title-block">
                                        <h3 class="title"> Basic Forms </h3>
                                    </div>
                                    <form role="form">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email"> </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Password</label>
                                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"> </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card card-block sameheight-item">
                                    <div class="title-block">
                                        <h3 class="title"> Forms Using the Grid </h3>
                                    </div>
                                    <form>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 form-control-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="inputEmail3" placeholder="Email"> </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-2 form-control-label">Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="inputPassword3" placeholder="Password"> </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-success">Sign in</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>

 @endsection