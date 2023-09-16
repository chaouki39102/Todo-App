    <!-- ====== Header Start ====== -->
    @if (authUser())
        <header class="bg-body-tertiary fixed-top shadow-sm">
            <div class="align-items-xl-center card-footer d-flex justify-content-end p-3 text-end">
                <img class="nav-avatar rounded-circle " src="{{getFile(auth()->user()->avatar)}}" alt="" style="width: 42px;">
                
                    <a href="#" class="btn" >
                        {{ auth()->user()->name }} 
                    </a> 
                <a class="btn btn-primary" href="{{ route('auth.logout') }}" role="button"> {{ __('Logout') }} </a> 
            </div>
        </header>
    @endif

    <!-- ====== Header End ====== -->
