<style>
    .custom-sidebar .nav-link {
        color: white !important;
    }

    .custom-sidebar .nav-link:hover {
        color: #ffc107 !important;
    }
<<<<<<< HEAD

    .custom-sidebar .nav-link.active {
        background-color: #b1765c;
        color: white !important;
        padding-top: 5px !important; /* Adjust top padding for active link */
        padding-bottom: 5px !important;
        padding-left: 5px !important; /* Adjust bottom padding for active link */
    }

    .nav-item {
        margin-top: 10px;
    }
</style>

=======
</style>
>>>>>>> 3ee3ec3 (design sidebar and nav(admin))
<nav class="col-sm-2 sidebar py-5 custom-sidebar" style="background-color: #9b593c;">
    <div class="sidebar-sticky">
        <ul class="nav nav-pills flex-column mb-auto">
            <!-- DASHBOARD -->
            <li class="nav-item">
<<<<<<< HEAD
                <a href="dashboard.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'dashboard.php') ? 'active' : ''; ?>">
=======
                <a href="dashboard.php" class="nav-link">
>>>>>>> 3ee3ec3 (design sidebar and nav(admin))
                    <i class="fas fa-table"></i>
                    Dashboard
                </a>
            </li>

            <!-- USERS -->
            <li class="nav-item">
<<<<<<< HEAD
                <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'users.php') ? 'active' : ''; ?>" href="users.php">
=======
                <a class="nav-link" href="users.php">
>>>>>>> 3ee3ec3 (design sidebar and nav(admin))
                    <i class="fas fa-users"></i>
                    Users
                </a>
            </li>

            <!-- CONCOURSE -->
            <li class="nav-item">
<<<<<<< HEAD
                <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'maps.php' || basename($_SERVER['PHP_SELF']) == 'spaces.php') ? 'active' : ''; ?>"
                   href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-concourse" aria-controls="submenu-concourse">
=======
                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-concourse" aria-controls="submenu-concourse">
>>>>>>> 3ee3ec3 (design sidebar and nav(admin))
                    <i class="fas fa-map-marked-alt"></i>
                    Concourse
                </a>
                <div id="submenu-concourse" class="submenu collapse sidebar-collapse">
                    <ul class="nav flex-column">
                        <li class="nav-item">
<<<<<<< HEAD
                            <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'maps.php') ? 'active' : ''; ?>" href="maps.php">Maps</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'spaces.php') ? 'active' : ''; ?>" href="spaces.php">Spaces</a>
=======
                            <a class="nav-link" href="maps.php">Maps</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="spaces.php">Spaces</a>
>>>>>>> 3ee3ec3 (design sidebar and nav(admin))
                        </li>
                    </ul>
                </div>
            </li>

            <!-- VERIFICATIONS -->
            <li class="nav-item">
<<<<<<< HEAD
                <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'user_verification_transactions.php' || basename($_SERVER['PHP_SELF']) == 'concourse_verify.php') ? 'active' : ''; ?>"
                   href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-verifications" aria-controls="submenu-verifications">
=======
                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-verifications" aria-controls="submenu-verifications">
>>>>>>> 3ee3ec3 (design sidebar and nav(admin))
                    <i class="fa-solid fa-file-circle-check"></i>
                    Verifications
                </a>
                <div id="submenu-verifications" class="submenu collapse sidebar-collapse">
                    <ul class="nav flex-column">
                        <li class="nav-item">
<<<<<<< HEAD
                            <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'user_verification_transactions.php') ? 'active' : ''; ?>" href="user_verification_transactions.php">User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'concourse_verify.php') ? 'active' : ''; ?>" href="concourse_verify.php">Concourse</a>
=======
                            <a class="nav-link" href="user_verification_transactions.php">User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="concourse_verify.php">Concourse</a>
>>>>>>> 3ee3ec3 (design sidebar and nav(admin))
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
<<<<<<< HEAD
=======

>>>>>>> 3ee3ec3 (design sidebar and nav(admin))
