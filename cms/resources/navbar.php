<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/" target="_blank">
        <img src="/resources/bdlogo.png" width="75" height="75" alt="logo">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link <?php if(PAGE == 'MENU') echo 'active';?>" href="menu.php">Menu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if(PAGE == 'CATERING') echo 'active';?>" href="catering.php">Catering</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if(PAGE == 'SPECIALS') echo 'active';?>" href="specials.php">Specials</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if(PAGE == 'ANNOUNCEMENTS') echo 'active';?>" href="announcements.php">Announcements</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if(PAGE == 'CONTACT US') echo 'active';?>" href="contact_us.php">Contact Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if(PAGE == 'OTHER') echo 'active';?>" href="other.php">Other</a>
            </li>
        </ul>
    </div>
</nav>