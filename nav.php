<nav class="navbar navbar-inverse navbar-fixed-top">

    <div class="container-fluid">

        <div class="navbar-header">
        
        <a class="navbar-brand" href="#">PROXIMATE<span class="glyphicon glyphicon-home" aria-hidden="true"></span></a>
        
        </div>

        <form class="navbar-form navbar-right" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group">
            <input type="text" name="location" class="form-control" placeholder="Lookup another place...">
            </div>
            <button type="submit" class="btn btn-default">Find Events</button>
        </form>

    </div>

</nav>
