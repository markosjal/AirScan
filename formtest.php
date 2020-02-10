<form  id='test-form'>

  <div id="field5" style="display: none;">
  <input type="radio" name="home" value="no" disabled>6no&nbsp;&nbsp;&nbsp;
  <input type="radio" name="home" value="yes" disabled>6yes<br>
  </div>


  <div id="field6" style="display: block;">
  <input onChange="getValueb(this)" type="radio" name="home" value="no" checked >5no&nbsp;&nbsp;&nbsp;
  <input onChange="getValueb(this)" type="radio" name="home" value="yes">5yes<br>
  </div>


  <br/>
  
  
  <div id="field4" style="display: none;">
  <input type="radio" name="away" value="no" disabled>4no&nbsp;&nbsp;&nbsp;
  <input type="radio" name="away" value="yes" disabled>4yes<br>
  </div>
  
    <div id="field3" style="display: block;">
  <input onChange="getValuec(this)" type="radio" name="away" value="no" checked>3no&nbsp;&nbsp;&nbsp;
  <input onChange="getValuec(this)" type="radio" name="away" value="yes">3yes<br>
  </div>
</form>  



<script type="text/javascript">
function getValueb(b) {
  if(b.value == 'no'){
    document.getElementById("field4").style.display = 'none'; // you need a identifier for changes
        document.getElementById("field3").style.display = 'block'; // you need a identifier for changes
  }
  else{
    document.getElementById("field4").style.display = 'block';  // you need a identifier for changes
        document.getElementById("field3").style.display = 'none';  // you need a identifier for changes
    
  }
}
</script>
<script type="text/javascript">
function getValuec(c) {
  if(c.value == 'no'){
    document.getElementById("field5").style.display = 'none'; // you need a identifier for changes
        document.getElementById("field6").style.display = 'block'; // you need a identifier for changes
  }
  else{
    document.getElementById("field5").style.display = 'block';  // you need a identifier for changes
        document.getElementById("field6").style.display = 'none';  // you need a identifier for changes
    
  }
}
</script>
