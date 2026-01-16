<nav class="navbar navbar-expand-lg navbar-dark bg-dark position-sticky top-0" style="z-index: 10;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="static/rifan.jpg" alt="RIFAN Logo" class="logo">
            RIFAN
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <?php if (isset($_SESSION["admin"])) { ?>
                    <li class="nav-item"><a class="nav-link active" href="AdminDash.php">Dashboard</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownAgents" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Agents
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdownAgents">
                            <li><a class="dropdown-item" href="CreateAgent.php">Create Agent</a></li>
                            <li><a class="dropdown-item" href="ViewAgent.php">View Agents</a></li>
                            <li><a class="dropdown-item" href="EditAgent.php">Edit Agents</a></li>
                            <li><a class="dropdown-item" href="DeleteAgent.php">Delete Agent</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownFarmers" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Farmers
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdownFarmers">
                            <li><a class="dropdown-item" href="CreateFarmer.php">Create Farmer</a></li>
                            <li><a class="dropdown-item" href="ViewFarmer.php">View Farmers</a></li>
                            <li><a class="dropdown-item" href="EditFarmer.php">Edit Farmers</a></li>
                            <li><a class="dropdown-item" href="DeleteFarmer.php">Delete Farmer</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="ViewLga.php">View LGAs</a></li>
                <?php } ?>

                <?php if (isset($_SESSION["agent"]) && !isset($_SESSION["admin"])) { ?>
                    <li class="nav-item"><a class="nav-link active" href="AgentDash.php">Dashboard</a></li>
                     <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownFarmersAgent" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Farmers
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdownFarmersAgent">
                            <li><a class="dropdown-item" href="CreateFarmer.php">Create Farmer</a></li>
                            <li><a class="dropdown-item" href="ViewFarmer.php">View Farmers</a></li>
                            <li><a class="dropdown-item" href="EditFarmer.php">Edit Farmers</a></li>
                            <li><a class="dropdown-item" href="DeleteFarmer.php">Delete Farmers</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="ViewLga.php">View LGAs</a></li>
                <?php } ?>

                <?php if (isset($_SESSION["admin"]) || isset($_SESSION["agent"])) { ?>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                <?php } ?>

                <?php if (!isset($_SESSION["admin"]) && !isset($_SESSION["agent"])) { ?>
                    <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact Us</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>