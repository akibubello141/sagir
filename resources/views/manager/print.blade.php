<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Production Report</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    margin:30px;
}

table{
    width:100%;
}

@media print{

.no-print{

display:none;

}

}

</style>

</head>

<body>

<div class="text-center">

<h3>SAGIR ENTERPRISES</h3>

<h5>Production Report</h5>

<p>{{ now()->format('d M Y H:i') }}</p>

</div>

<table class="table table-bordered">

<thead>

<tr>

<th>#</th>

<th>Product</th>

<th>Quantity</th>

<th>Damaged</th>

<th>Returned</th>

<th>Date</th>

</tr>

</thead>

<tbody>

@foreach($productions as $production)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $production->product->name }}</td>

<td>{{ $production->quantity_produced }}</td>

<td>{{ $production->damaged_quantity }}</td>

<td>{{ $production->returned_quantity }}</td>

<td>{{ $production->production_date }}</td>

</tr>

@endforeach

</tbody>

</table>

<div class="mt-5">

<table width="100%">

<tr>

<td>

Prepared By

<br><br>

____________________

</td>

<td class="text-end">

Approved By

<br><br>

____________________

</td>

</tr>

</table>

</div>

<script>

window.print();

</script>

</body>

</html>