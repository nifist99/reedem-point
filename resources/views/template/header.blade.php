<!-- partial:partials/_navbar.html -->
<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
    <div class="me-3">
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
        <span class="icon-menu"></span>
      </button>
    </div>
    <div>
      <a class="navbar-brand brand-logo" href="index.html">
        <img src="{{url('assets/images/logo.jpg')}}" width="100%" alt="logo" />
      </a>
      <a class="navbar-brand brand-logo-mini" href="index.html">
        <img src="{{url('assets/images/logo.jpg')}}" alt="logo" />
      </a>
    </div>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-top"> 
    <ul class="navbar-nav">
      <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
        <h1 class="welcome-text"><span class="text-black fw-bold">{{Session::get('name')}}</span></h1>
        <h3 class="welcome-sub-text">google scraping, feeture whatspro.id </h3>
      </li>
    </ul>
    <ul class="navbar-nav ms-auto">
      <li class="nav-item dropdown"> 
        <a class="nav-link count-indicator" id="countDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="icon-bell"></i>
          <span class="count"></span>
        </a>
      </li>
      <li class="nav-item dropdown d-none d-lg-block user-dropdown">
        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
          <img class="img-xs rounded-circle" src="{{url('assets/images/logo.jpg')}}" alt="Profile image"> </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
          <div class="dropdown-header text-center">
            <img class="img-md rounded-circle" src="{{url('assets/images/logo.jpg')}}" width="50px" alt="Profile image">
            <p class="mb-1 mt-3 font-weight-semibold">{{Session::get('name')}}</p>
            <p class="fw-light text-muted mb-0">{{Session::get('email')}}</p>
          </div>
          <a class="dropdown-item" href="{{url('account')}}"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile </a>
          <form action="{{url('logout')}}" id="logout" method="POST">
            @csrf
            <a href="javascript:void(0)" onclick="logout()" class="dropdown-item"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
          </form>
          
        </div>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
</nav>

@push('js')   
<script>
function logout(){
    Swal.fire({
        title: 'Are you sure logout?',
        text: "You won't logout",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#696cff',
        cancelButtonColor: '#ff3e1d',
        confirmButtonText: 'Yes'
        }).then((result) => {
        if (result.isConfirmed) {
          document.getElementById("logout").submit();
            Swal.fire(
            'Logout!',
            'Your has been Logout.',
            'success'
            )
        }
        })
    }
</script>
@endpush
<!-- partial -->