<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <a class="navbar-brand" href="/"><img src="/resources/bdlogo.png" alt="B&D Logo" height="75"/></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav d-flex w-100">
            <li class="nav-item">
                <a class="nav-link font-weight-bold <?php if(PAGE == 'HOME') echo 'active';?>" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link font-weight-bold <?php if(PAGE == 'MENU') echo 'active';?>" href="menu.php">Menu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link font-weight-bold <?php if(PAGE == 'CATERING') echo 'active';?>" href="catering.php">Catering</a>
            </li>
            <li class="nav-item">
                <a class="nav-link font-weight-bold <?php if(PAGE == 'CONTACT US') echo 'active';?>" href="contact_us.php">Contact Us</a>
            </li>   
            <li class="nav-item align-self-end ml-auto">
                <a class='text-white' href='https://www.facebook.com/brians.deli'><i class='fab fa-facebook-square fa-lg'></i> Follow us on Facebook!</a>
            </li>
        </ul>
    </div> 
</nav>