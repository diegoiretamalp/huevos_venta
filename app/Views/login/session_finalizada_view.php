<!-- <div class="container">
    <div class="card-body">
        <h4 class="text-center p-2"><?= isset($title) ? $title : 'Su sesión a Expirado' ?></h4>
        <hr>
        <h6 class="alert alert-primary text-center"><i class="fa fa-info-circle"></i> <?= isset($alerta) ? $alerta : '' ?></h6>
        <hr>
        <div class="col-12">
            <a type="button" href="<?= base_url('login') ?>" class="btn btn-dark btn-block"><i class="fa fa-angle-double-right"></i> Iniciar Sesión</a>
        </div>
    </div>
</div> -->

<div class="ms-content-wrapper ms-auth">
    <div class="ms-auth-container">
        <div class="ms-auth-col">
            <div class="ms-auth-bg"></div>
        </div>
        <div class="ms-auth-col">
            <div class="ms-auth-form">
                <form class="needs-validation" novalidate="">
                    <h1>Login to Account</h1>
                    <p>Please enter your email and password to continue</p>
                    <div class="mb-3">
                        <label for="validationCustom08">Email Address</label>
                        <div class="input-group">
                            <input type="email" class="form-control" id="validationCustom08" placeholder="Email Address" required="">
                            <div class="invalid-feedback">
                                Please provide a valid email.
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="validationCustom09">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="validationCustom09" placeholder="Password" required="">
                            <div class="invalid-feedback">
                                Please provide a password.
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="ms-checkbox-wrap">
                            <input class="form-check-input" type="checkbox" value="">
                            <i class="ms-checkbox-check"></i>
                        </label>
                        <span> Remember Password </span>
                        <label class="d-block mt-3"><a href="#" class="btn-link" data-toggle="modal" data-target="#modal-12">Forgot Password?</a></label>
                    </div>
                    <button class="btn btn-primary mt-4 d-block w-100" type="submit">Sign In</button>
                    <span class="d-block text-center my-4">Or</span>
                    <button type="button" class="btn mt-4 d-block w-100 btn-social-login"> <img src="..\..\assets\img\others\facebook.png" alt="image"> <span>Login with Facebook</span> </button>
                    <button type="button" class="btn mt-4 d-block w-100 btn-social-login"> <img src="..\..\assets\img\others\google.png" alt="image"> <span>Login with Google</span> </button>
                    <p class="mb-0 mt-3 text-center">Don't have an account? <a class="btn-link" href="default-register.html">Create Account</a> </p>
                </form>
            </div>
        </div>
    </div>

</div>