<!DOCTYPE html>
<html>
<head></head>
<body style='background: white; color: #222'>
<table width='600px' border='0'>
		<thead>
		<tr><th colspan='2' style='background:#3c2b2b;color:#FFF'><img style='height:50px;' src='{{url(config('whyte.project.logo'))}}'><h4>Purchase Order From Cheeky Camel Website</h4></th></tr>
		</thead>
		<tbody>
			<tr><td>Name</td><td>{{$request->name}}</td></tr>
			<tr><td>Email</td><td>{{$request->email}}</td></tr>
			<tr><td>Phone</td><td>{{$request->phone}}</td></tr>
			<tr><td>Address</td><td>{{$request->address}}</td></tr>
			<tr><td colspan='2'>
				<table width='600px' class='table' border='0'>
				      <thead style='background:#fC0'>
				        <tr>
				          <th>Image</th>
				          <th>Item</th>
				          <th>Unit Price</th>
				          <th>Quantity</th>
				         
				          <th>Total</th>
				        </tr>
				      </thead>
				      <tbody>
				       @foreach(Cart::getContent() as $item)
				        <tr style='text-align:center; border-bottom: #222 solid; '>

				        	@if($item->attributes->table == "shops") 
				        	<td><img src="{{url('uploads/shops/'.$item->attributes->image)}}" class="img-responsive"></td>
				        	@elseif($item->attributes->table == "apparels")
				        	<td><img src="{{url('uploads/apparels/'.$item->attributes->image)}}" class="img-responsive"></td>
				        	@elseif($item->attributes->table == "consoles")
				        	<td><img src="{{url('uploads/console/'.$item->attributes->image)}}" class="img-responsive"></td>
				        	@endif

			 	          {{-- <td><img style='width:50px;' src='{{url("uploads/product/".$item->attributes->image)}}'></td> --}}
			 	          <td>{{$item->name}}</td>
				          <td>QAR {{$item->price}}</td>
				          <td>{{$item->quantity}}</td>
				          
				          <td>QAR {{$item->price * $item->quantity}}</td>
				        </tr>
				       @endforeach
		       	        <tr style='background:#3c2b2b;color:#FFF;text-align:right;'>
		        	      <td  colspan='3' style=' padding:0.8em;'>TOTAL</td>
		        	      <td  colspan='3'  style=' padding:0.8em;'>{{Cart::getTotal()}}</td>
		       	        </tr>
				      </tbody>
				    </table>
			</td></tr>
		</tbody>
	</table>
</body>
</html>