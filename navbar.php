<nav class="navbar navbar-expand-lg navbar-light position-sticky top-0 bg-white" style="z-index: 10;">
    <div class="container">
        <img class="col-1 rounded-circle my-2 mx-2" src="static/rifan.jpg">
        <a class="navbar-brand" href="#">RIFAN</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if (isset($_SESSION["admin"])) { ?>
                    <li class="nav-item"><a class="nav-link active" href="AdminDash.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="CreateAgent.php">Create Agent</a></li>
                    <li class="nav-item"><a class="nav-link" href="CreateFarmer.php">Create Farmer</a></li>
                    <li class="nav-item"><a class="nav-link" href="ViewAgent.php">View Agents</a></li>
                    <li class="nav-item"><a class="nav-link" href="EditAgent.php">Edit Agents</a></li>
                    <li class="nav-item"><a class="nav-link" href="DeleteAgent.php">Delete Agent</a></li>
                    <li class="nav-item"><a class="nav-link" href="ViewFarmer.php">View Farmers</a></li>
                    <li class="nav-item"><a class="nav-link" href="EditFarmer.php">Edit Farmers</a></li>
                    <li class="nav-item"><a class="nav-link" href="DeleteFarmer.php">Delete Farmer</a></li>
                    <li class="nav-item"><a class="nav-link" href="ViewLga.php">View LGAs</a></li>
                <?php } ?>

                <?php if (isset($_SESSION["agent"]) && !isset($_SESSION["admin"])) { ?>
                    <li class="nav-item"><a class="nav-link active" href="AgentDash.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="CreateFarmer.php">Create Farmer</a></li>
                    <li class="nav-item"><a class="nav-link" href="ViewFarmer.php">View Farmers</a></li>
                    <li class="nav-item"><a class="nav-link" href="EditFarmer.php">Edit Farmers</a></li>
                    <li class="nav-item"><a class="nav-link" href="DeleteFarmer.php">Delete Farmers</a></li>
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