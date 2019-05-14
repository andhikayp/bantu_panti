@extends('layouts.base.app')
@section('title', ' Dashboard')

@section('sidebar')
    @include('layouts.base.sidebar')
@endsection

@section('header')
    @include('layouts.base.header')
@endsection

@section('content')
<div class="col-12 mb-2 mt-2">
    @if($this->session->flashdata('message')) 
        @if($this->session->flashdata('message')['type'] == 'error')
        <div class="alert alert-danger">
            {{ implode('\n', $this->session->flashdata('message')['message']) }}
        </div>
        @else
        <div class="alert alert-success">
            {{ implode('\n', $this->session->flashdata('message')['message']) }}
        </div>
        @endif
    @endif
</div>

<nav class="breadcrumb bg-white push">
    <a class="breadcrumb-item" href="{{ base_url('/') }}">Dashboard</a>
    <span class="breadcrumb-item active">Statistik</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Statistik Pelaksanaan Survey</h3>
    </div>
    <div class="block-content">
        <div id="chartContainer" style="width: 50%; height: 0px;" class=""></div>
        <div class="row">
            <div class="col-md-6" style="min-width: 390px">
                <div id="piechart"></div>
            </div>
            <div class="col-md-6" style="min-width: 390px">
                <div id="piechart2"></div>
            </div>
    </div>
</div>
@php
    foreach($all as $data)
    {
        foreach($petugas as $sudah)
        {
            $belum=$data->jumlah-$sudah->jumlah;
        }
    }
    foreach($all_sekolah as $data)
    {
        foreach($sekolah as $sudah)
        {
            $belum_sekolah=$data->jumlah-$sudah->jumlah;
        }
    }
@endphp
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Task', 'Hours per Day'],
  ['Belum mengisi data', {{$belum}}],
  ['Sudah mengisi data', @foreach($petugas as $data)
        {{$data->jumlah}}
        @endforeach]
]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'Statistik Petugas', 'min-width':900, 'height':400};
  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script>
<script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Task', 'Hours per Day'],
  ['Belum memiliki petugas survey', {{$belum_sekolah}}],
  ['Sudah memiliki petugas survey', @foreach($sekolah as $data)
        {{$data->jumlah}}
        @endforeach]
]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'Statistik Sekolah', 'min-width':900, 'height':400};
  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart2'));
  chart.draw(data, options);
}
</script>
@endsection