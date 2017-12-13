





<style>
.custom{
  width:50%;
  margin:0 auto;
  min-width:350px;
}
.panel {
    position: absolute;
    top: 40%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
}
.panel-heading{
    text-align:center;
    
}
h4{
    font-size:4em;
}
h3{
    text-align:center;
}

</style>

<div class="panel panel-default custom">
<div class="panel-heading"><h4>Proximate Events</h4></div>
<div class="panel-body">
<form id="address-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <div class="form-group">
                    <h3>What's going on near you?</h3>
                    <input type="text" name="location" class="form-control" placeholder="Use my location">
                </div>
            </div>
        </div>
            <div class="col-lg-4 col-lg-offset-4">
                <input type="submit" class="btn btn-success btn-send center-block" value="Find Events">
            </div>
        </div>

</form>
</div>
</div>
</div>