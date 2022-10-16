<h4><b>Here is the information submitted by you:<b></h4>
<p>Name: <b><?php echo $_POST["name"] ?? ''; ?></b></p>
<p>Country Probability 1: </p>
<p>Country Probability 2: </p>
<p>Country Probability 3: </p>


<?php
$name = $_POST["name"];
?>

<script>

$(document).ready(function(){

    var requestData = {   name :  $name };

    $.getJSON('https://nationalize.io/', requestData)

    .done(function(data){
        console.log("call done ok");

        $("#name").html("<b>Name:</b> " +data.name);
        $("#country").html("<b>Country:</b> " +data.country);
        $("#probability").html("<b>Probability:</b> " +data.probability);

    })

    .fail(function(jqXHR){
        console.log("failure: " + jqXHR.status);
    })

    .always(function(){
        console.log("Request completed");
    });
    
});
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>	