
<script type="text/javascript">
//check for browser support
if(typeof(EventSource)!=="undefined") {
        //create an object, passing it the name and location of the server side script
        var statusSource = new EventSource("/checklogin.php");
        //detect message receipt
        statusSource.onmessage = function(event) {
                //write the received data to the page
                document.getElementById("loginStatus").innerHTML = event.data;
        };
}
else {
        document.getElementById("loginStatus").innerHTML="<?php echo $nosupporttxt;?>";
}
</script>

<script>
window.onscroll = function() {myFunction()};

var header = document.getElementById("myHeader");
var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}
</script>
