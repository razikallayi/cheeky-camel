
<!DOCTYPE html>
<html>

<body style='background: white; color: #222'>

	<table width='600px' border='0' style="background:#583b78;text-align:center;">



		<thead>
			<tr><th colspan='2' style='background:#ffc900;color:#583b78;border:2px solid #583b78;'><img style='height:50px;' src="{{url(config('whyte.project.logo'))}}">
			<h4>Name: {{$request->name}} </h4>
			</br>
			<h4>Email : {{$request->email}}</h4>
			</br>
			<h4>Phone : {{$request->phone}}</h4>
			</br>
			<h4>Message : {{$request->message}}</h4>
			</br>
			</th></tr>
			<tr><a href="{{url('/')}}">Go to Our Website</a></tr>		
		</thead>


		
	</table>



	

	


</body>
</html> 

