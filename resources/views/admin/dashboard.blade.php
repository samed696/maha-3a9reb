@extends('layouts.app')

@section('content')
<h1>Bienvenue sur le Dashboard Admin</h1>

<div class="mb-4">
    <a href="{{ route('coupons.index') }}" class="btn btn-primary">📦 Gérer les coupons</a>
    <a href="{{ route('admin.notifications') }}" class="btn btn-secondary">🔔 Voir les notifications</a>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-white bg-primary mb-3">
            <div class="card-header">Total des commandes</div>
            <div class="card-body">
                <h3 class="card-title">{{ $totalOrders }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success mb-3">
            <div class="card-header">Chiffre d'affaires</div>
            <div class="card-body">
                <h3 class="card-title">{{ number_format($totalRevenue, 2) }} €</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-info mb-3">
            <div class="card-header">Nombre d'utilisateurs</div>
            <div class="card-body">
                <h3 class="card-title">{{ $totalUsers }}</h3>
            </div>
        </div>
    </div>
</div>

<h3>Évolution des ventes (30 derniers jours)</h3>
<div id="chart-daily" style="height: 300px;"></div>

<h3>Évolution des ventes (12 dernières semaines)</h3>
<div id="chart-weekly" style="height: 300px;"></div>

<h3>Évolution des ventes (12 derniers mois)</h3>
<div id="chart-monthly" style="height: 300px;"></div>

<h3>Top 5 des produits les plus vendus</h3>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Produit</th>
            <th>Quantité vendue</th>
        </tr>
    </thead>
    <tbody>
        @foreach($topProducts as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->total_sold }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Placeholder for charts scripts -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    // Prepare data for charts
    var salesDaily = @json($salesDaily);
    var salesWeekly = @json($salesWeekly);
    var salesMonthly = @json($salesMonthly);

    function prepareChartData(data, labelKey, valueKey) {
        return {
            categories: data.map(item => item[labelKey]),
            series: [{
                name: 'Ventes',
                data: data.map(item => item[valueKey])
            }]
        };
    }

    var optionsDaily = {
        chart: { type: 'line', height: 300 },
        series: prepareChartData(salesDaily, 'date', 'total').series,
        xaxis: { categories: prepareChartData(salesDaily, 'date', 'total').categories },
        title: { text: 'Ventes quotidiennes' }
    };

    var optionsWeekly = {
        chart: { type: 'line', height: 300 },
        series: prepareChartData(salesWeekly, 'week', 'total').series,
        xaxis: { categories: prepareChartData(salesWeekly, 'week', 'total').categories },
        title: { text: 'Ventes hebdomadaires' }
    };

    var optionsMonthly = {
        chart: { type: 'line', height: 300 },
        series: prepareChartData(salesMonthly, 'month', 'total').series,
        xaxis: { categories: prepareChartData(salesMonthly, 'month', 'total').categories },
        title: { text: 'Ventes mensuelles' }
    };

    var chartDaily = new ApexCharts(document.querySelector("#chart-daily"), optionsDaily);
    var chartWeekly = new ApexCharts(document.querySelector("#chart-weekly"), optionsWeekly);
    var chartMonthly = new ApexCharts(document.querySelector("#chart-monthly"), optionsMonthly);

    chartDaily.render();
    chartWeekly.render();
    chartMonthly.render();
</script>
@endsection
