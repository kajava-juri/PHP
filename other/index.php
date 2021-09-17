<html>
<head>
<script>
function showCD(str) {
  if (str=="") {
    document.getElementById("txtHint").innerHTML="";
    return;
  }
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("txtHint").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","getcd.php?q="+str,true);
  xmlhttp.send();
}

function showCD2(str) {
  if (str=="") {
    document.getElementById("txtHint").innerHTML="";
    return;
  }
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("txtHint").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","getcd.php?q="+str,true);
  xmlhttp.send();
}
</script>
</head>
<body>

<form>
Select a CD:
<select name="cds" onchange="showCD(this.value)">
  <option value="">Select a CD:</option>
  <option value="Bob Dylan">Bob Dylan</option>
  <option value="Bee Gees">Bee Gees</option>
  <option value="Cat Stevens">Cat Stevens</option>
</select>
</form>
<div id="txtHint"><b>CD info will be listed here...</b></div>

<br>
<br>
<br>
<br>
<br>
<hr>



<select onchange="showCD2(this.value)">
<option value="">Select a title:</option>
<?php 
  $xmlDoc = new DOMDocument();
  $xmlDoc->load("cd_catalog.xml");
  $x = $xmlDoc->getElementsByTagName('TITLE');

  for($i = 0; $i < $x -> length - 1; $i++){
    $y = $x->item($i)->nodeValue;

?>
  <option value="<?php echo $y ?>"><?php echo $y ?></option>

  <?php } ?>
</select>

</body>
</html>