<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <!-- form card login -->
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h3 class="mb-0">Administration</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="/post_login" class="form" role="form" autocomplete="off" id="formLogin" novalidate="">
                                <div class="form-group">
                                    <label for="uname1">Email</label>
                                    <input name="email" type="text" class="form-control form-control-lg rounded-0" name="uname1" id="uname1"
                                           required="">
                                    <div class="invalid-feedback">Oops, you missed this one.</div>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input name="password" type="password" class="form-control form-control-lg rounded-0" id="pwd1" required=""
                                           autocomplete="new-password">
                                    <div class="invalid-feedback">Enter your password too!</div>
                                </div>
                                <input name="role" type="hidden" value="admin"/>
                                <button type="submit" class="btn btn-success btn-lg float-right" id="btnLogin">Login</button>
                            </form>
                        </div>
                        <!--/card-block-->
                    </div>
                    <!-- /form card login -->
                </div>
            </div>
            <!--/row-->
        </div>
        <!--/col-->
    </div>
    <!--/row-->
</div>