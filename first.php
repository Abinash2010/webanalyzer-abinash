
<html>
<head>

</head>
<body onload="load();">
  <?php
  include 'first.php';
  $a=new webanalyzer();

echo $a->shapeSpace_system_load();
   ?>
</body>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>

<script  type="text/javascript">

setInterval(function(){
  var status=1;
     $.ajax({
       url: "session.php",
       type: "POST",
       data:status,
       success: function(data){

       },
     });

},300);


</script>
<script  type="text/javascript">

setInterval(function(){

     $.ajax({
       url: "sessionend.php",
       type: "POST",
       data:status,
       success: function(data){

       },
     });

},500);


</script>

</html>
