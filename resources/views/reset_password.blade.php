<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<div class="form-gap"></div>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-center">
                        <h3><i class="fa fa-lock fa-4x"></i></h3>
                        <h2 class="text-center">Reset your password</h2>
                        @if(session()->has('message'))
                            <div class="alert alert-info">{{ session()->get('message') }}</div>
                        @endif
                        <div class="panel-body">
                            <form id="register-form" action="{{ route('password-policy.reset') }}" role="form" autocomplete="off" class="form" method="post">
                                @csrf
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-record color-blue"></i></span>
                                        <input id="old_password" name="old_password" placeholder="Current password" class="form-control" value="{{ old('old_password') }}"  type="password">
                                        <div class="input-group-addon">
                                            <div class="input-group-text">
                                                {{-- <span class="fas fa-lock"></span> --}}
                                                <span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password"></span>
                                            </div>
                                        </div>
                                    </div>
                                    @error('old_password') <span style="display: block" class="error invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-record color-blue"></i></span>
                                        <input id="password" name="password" placeholder="Password" class="form-control"  type="password">
                                        <div class="input-group-addon">
                                            <div class="input-group-text">
                                                {{-- <span class="fas fa-lock"></span> --}}
                                                <span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password"></span>
                                            </div>
                                        </div>
                                    </div>
                                    @error('password') <span style="display: block" class="error invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-record color-blue"></i></span>
                                        <input id="confirm_password" name="password_confirmation" placeholder="New password" class="form-control"  type="password">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                {{-- <span class="fas fa-lock"></span> --}}
                                                <span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password"></span>
                                            </div>
                                        </div>
                                    </div>
                                    @error('password_confirmation') <span style="display: block" class="error invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <button name="recover-submit" class="btn btn-lg btn-primary btn-block" type="submit">Reset Password</button>
                                </div>

                                <input type="hidden" class="hide" name="token" id="token" value="">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
        $(document).on('click', '.toggle-password', function () {

            $(this).toggleClass("fa-eye fa-eye-slash");

            var input = $(this).parents('.input-group').find('input');
            input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password')
        });

    </script>
