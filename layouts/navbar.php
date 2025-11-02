
<?php
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-gradient shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold fs-4 " href="/travels/">
      Travels
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="catDropdown" role="button" data-bs-toggle="dropdown"> Categories</a>
          <ul class="dropdown-menu shadow">
            <li><a class="dropdown-item" href="/travels/dashboard/catogeries/create.php"> Create catogeries</a></li>
            <li><a class="dropdown-item" href="/travels/dashboard/catogeries/edit.php"> Edit catogeries</a></li>
            <li><a class="dropdown-item" href="/travels/dashboard/catogeries/show.php"> Show catogeries</a></li>
            
          </ul>
        </li>

    
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="hotelDropdown" role="button" data-bs-toggle="dropdown"> Hotels</a>
          <ul class="dropdown-menu shadow">
            <li><a class="dropdown-item" href="/travels/dashboard/hotel/create.php"> Create Hotels</a></li>
            <li><a class="dropdown-item" href="/travels/dashboard/hotel/edit.php"> Edit Hotels</a></li>
            <li><a class="dropdown-item" href="/travels/dashboard/hotel/show.php"> Show Hotels</a></li>
          </ul>
        </li>

       
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="packDropdown" role="button" data-bs-toggle="dropdown"> Packages</a>
          <ul class="dropdown-menu shadow">
            <li><a class="dropdown-item" href="/travels/dashboard/packegs/create.php"> Create Package</a></li>
            <li><a class="dropdown-item" href="/travels/dashboard/packegs/edit.php"> Edit Package</a></li>
            <li><a class="dropdown-item" href="/travels/dashboard/packegs/show.php"> Show Packages</a></li>
          </ul>
        </li>

     
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown"> Users</a>
          <ul class="dropdown-menu shadow">
            <li><a class="dropdown-item" href="/travels/dashboard/users/create.php"> Create Users</a></li>
            <li><a class="dropdown-item" href="/travels/dashboard/users/edit.php"> Edit Users</a></li>
            <li><a class="dropdown-item" href="/travels/dashboard/users/show.php"> Show Users</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown"> Contacts</a>
          <ul class="dropdown-menu shadow">
            <li><a class="dropdown-item" href="/travels/dashboard/Contacts/edit.php"> Edit Contacts</a></li>
            <li><a class="dropdown-item" href="/travels/dashboard/Contacts/show.php"> Show Contacts</a></li>
          </ul>
        </li>

         <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown"> Reserve</a>
          <ul class="dropdown-menu shadow">
            <li><a class="dropdown-item" href="/travels/dashboard/reserve/reserve.php"> Show Reserve</a></li>
          </ul>
        </li>

      </ul>
    </div>
  </div>
</nav>

<style>

  .bg-gradient {
font-family: Arial, Helvetica, sans-serif;
    background : linear-gradient(90deg, #0b0f33 0%, #1a237e 50%, #4a148c 100%) !important;
  }
.navbar-brand{
font-size: 30px;
font-weight: bold;
  color: #2011e9ff !important;
}
 
  .nav-link {
    font-weight: 500;
    color: #2011e9ff !important;

  }

  
  .dropdown-menu {
    border-radius: 15px;
    overflow: hidden;
    border: none;
  }

  .dropdown-item:hover {
    background-color: #0d6efd;
    color: #fff;
  }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>