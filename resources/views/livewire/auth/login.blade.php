<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-10">
                <div class="card o-hidden border-0 shadow-lg">
                    <div class="card-body p-0">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                            </div>
                            @if (session()->has('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <form wire:submit.prevent='login'>
                                <div class="form-group">
                                    <input wire:model='email' type="email" class="form-control form-control-user"
                                        id="exampleInputEmail" aria-describedby="emailHelp"
                                        placeholder="Enter Email Address...">
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <input wire:model='password' type="password" class="form-control form-control-user"
                                        id="exampleInputPassword" placeholder="Password">
                                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Login
                                </button>
                            </form>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
