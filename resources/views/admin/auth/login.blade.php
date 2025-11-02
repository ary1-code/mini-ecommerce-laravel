@extends('admin.layout.app')

@section('content')
    <!-- Start::app-content -->
    <div class="container-lg">
        <div class="row justify-content-center align-items-center authentication authentication-basic h-100">
            <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-6 col-sm-8 col-12">
                <div class="card custom-card my-4 auth-circle">
                    <div class="card-body p-5">
                        <p class="h4 mb-3 fw-semibold text-center">
                            ورود به پنل مدیریت
                        </p>
                        <p class="mb-4 text-muted text-center">
                            برای ورود به پنل مدیریت لطفا اطلاعات فرم را وارد کنید.
                        </p>

                        @error('general')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <form method="POST"
                              action="{{route('admin.auth.login.post')}}">
                            @csrf
                            <label for="login-email" class="form-label text-default">پست الکترونیکی</label>
                            <input
                                type="text"
                                name="email"
                                class="form-control"
                                id="login-email"
                                placeholder="پست الکترونیکی را وارد کنید"
                                value="{{old('email')}}"
                            />
                    <div>
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <br>
                </div>
                    <div class="col-xl-12">
                        <label for="login-password" class="form-label text-default">رمز عبور</label>
                        <div class="position-relative">
                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                id="login-password"
                                placeholder="رمز عبور را وارد کنید"
                            />
                        </div>
                        @error('password')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary">ورود</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- End::app-content -->

@endsection
