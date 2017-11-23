
<!DOCTYPE html>
<html>

<body style='background: white; color: #222'>

@foreach($results as $result)

@endforeach
	<table width='600px' border='0' style="background:#583b78;text-align:center;">

		<thead>
			<tr><th colspan='2' style='background:#ffc900;color:#583b78;border:2px solid #583b78;'><img style='height:50px;' src="{{url(config('whyte.project.logo'))}}">
			{{-- <h4>Thank You !!! . We will reach you soon ..  </h4> --}}
			</th></tr>
			<tr><a href="{{url('/')}}">Go to Our Website</a></tr>		
		</thead>
		<tr>{!!$result->description !!}</tr>

		
	</table>


	

	


</body>
</html> 

