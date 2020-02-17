<html>
<head>
<!--	<?php echo $map['js']; ?> -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url('Assets/css/style.css'); ?>">

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

</head>
<body>
<!--	<?php echo $map['html']; ?> -->

<div style="width: 100%"><iframe width="100%" height="400" src="https://maps.google.com/maps?width=100%&amp;height=400&amp;hl=en&amp;coord=23.751931, 90.367109&amp;q=saka%20international%20ltd+(saka)&amp;ie=UTF8&amp;t=&amp;z=20&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a href="https://www.maps.ie/map-my-route/">sakaint</a></iframe></div><br />
	 

<!--<button onclick="getLocation()">Try It</button> -->

<p id="demo">

</p>
<p id = '1' style="color: green">
	
</p>
<p id = '2' style="color: red">
</p>
<div id='9'>
	
</div>
<?php
echo form_open('UserController/mapTestCont');
echo form_input(['name'=>'lat','class'=>'form-control', 'id'=>'3', 'required'=>'required']); 
echo form_input(['name'=>'long','class'=>'form-control','id'=>'4', 'required'=>'required']);
echo form_submit(['name'=>'submit','value'=>'Login','class'=>'btn btn-primary', 'style'=>'margin: 10px 0 0 40px;']);
 echo form_close();
?>
	
</p>
<form mothod="POST">
<input type="text" name="latinput" id='xx'>
<input type="text" name="latinput" id='yy'>
<input type="submit" name="In Time">
</form>

<script>
var x = document.getElementById("demo");

//function getLocation() 
//{
  if (navigator.geolocation) 
  {
	 navigator.geolocation.getCurrentPosition(showPosition);
  } 
  else 
  { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
//}

function showPosition(position) 
{
  x.innerHTML = "Latitude: " + position.coords.latitude + 
  "<br>Longitude: " + position.coords.longitude; 

  console.log(position.coords.latitude);
  console.log(position.coords.longitude);

  document.getElementById('1').innerHTML = position.coords.latitude;
  document.getElementById('2').innerHTML = position.coords.longitude;
  document.getElementById('9').innerHTML += 
  "<div style='width: 80%'><iframe width='100%' height='400' src='https://maps.google.com/maps?width=100%&amp;height=400&amp;hl=en&amp;coord="+position.coords.latitude;+","+position.coords.longitude;+"&amp;q=saka%20international%20ltd+(saka)&amp;ie=UTF8&amp;t=&amp;z=20&amp;iwloc=B&amp;output=embed' frameborder='0' scrolling='no' marginheight='0' marginwidth='0'><a href='https://www.maps.ie/map-my-route/'>sakaint</a></iframe></div><br />";

  document.getElementById('3').value = position.coords.latitude;
  document.getElementById('4').value = position.coords.longitude;

}
</script>

</body>
</html>

	 

 <!--
	<div id = "map"></div>
	<script type="text/javascript">
		function init map()
		{
			var location = {lat: -25.363, lng: 131.044};
			var map = new google.map.Map(document.getElementById("map"), 
				{
					zoom:4, center: location
				}
				);
			var marker = new google.maps.Marker(
			{
				position: location,
				map: map
			});
		}
	</script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADfsOcdgBa-N5xYECn_y16MT0jKJ-EPzo&callback=initMap">
		
	</script>

-->
</body>
</html>

<!-- API key AIzaSyADfsOcdgBa-N5xYECn_y16MT0jKJ-EPzo -->


