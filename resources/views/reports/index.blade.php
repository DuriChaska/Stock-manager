@extends('layouts.app') 


@section('content')
<div class="container-fluid py-4">
    <h2 class="mb-4">Reportes y Análisis</h2>
    <p class="text-muted">Estadísticas y métricas del negocio</p>
    
    <div class="card mb-4 p-3 shadow-sm">
        <h4>Configuración de reporte</h4>
        <div class="d-flex flex-wrap gap-3">
            <button class="btn btn-outline-secondary d-flex align-items-center"><i class="fas fa-calendar-alt me-2"></i> Último mes</button>
            <button class="btn btn-outline-secondary d-flex align-items-center"><i class="fas fa-file-invoice-dollar me-2"></i> Reporte de venta</button>
            </div>
    </div>

    <div class="row g-4 mb-4">
        
        <div class="col-lg-3 col-md-6">
            <div class="card p-3 shadow-sm border-start border-success border-5 h-100">
                <h5 class="text-success">Ventas Totales</h5>
                <h3 class="display-6">${{ number_format($totalVentas, 2) }}</h3>
                <small class="text-muted">Ingresos brutos generados.</small>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card p-3 shadow-sm border-start border-primary border-5 h-100">
                <h5 class="text-primary">Productos en Stock</h5>
                <h3 class="display-6">{{ number_format($totalProductos) }}</h3>
                <small class="text-muted">Total de artículos en inventario.</small>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
            <div class="card p-3 shadow-sm border-start border-info border-5 h-100">
                <h5 class="text-info">Ticket Promedio</h5>
                <h3 class="display-6">$0.00</h3>
                <small class="text-muted">Faltan datos de Ingresos y Ventas para calcular.</small>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
            <div class="card p-3 shadow-sm border-start border-danger border-5 h-100">
                <h5 class="text-danger">Rotación Stock</h5>
                <h3 class="display-6">0x</h3>
                <small class="text-muted">Requiere lógica de entradas y salidas.</small>
            </div>
        </div>
    </div>

    <div class="row g-4">
        
        <div class="col-lg-6">
            <div class="card shadow-sm p-4 h-100">
                <h4>Tendencia de ventas e ingresos</h4>
                <p class="text-muted">Evolución mensual de la venta</p>
                <div style="height: 250px; background-color: #f8f9fa; border: 1px dashed #ccc;">
                    [Espacio para Gráfico de Barras]
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow-sm p-4 h-100">
                <h4>Distribución de ventas por Marca</h4>
                <p class="text-muted">Porcentaje de ventas por marca</p>
                <div style="height: 250px; background-color: #f8f9fa; border: 1px dashed #ccc; display: flex; justify-content: center; align-items: center;">
                    [Espacio para Gráfico Circular]
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow-sm p-4 h-100">
                <h4>Productos más vendidos</h4>
                <p class="text-muted">Ranking por unidades vendidas e ingresos generados</p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="badge bg-success me-2">01</span> Producto A
                        <span class="text-muted">100 unidades</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="badge bg-success me-2">02</span> Producto B
                        <span class="text-muted">85 unidades</span>
                    </li>
                    </ul>
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="card shadow-sm p-4 h-100">
                <h4>Evolución del Inventario</h4>
                <p class="text-muted">Tendencia del stock actual en el tiempo</p>
                <div style="height: 250px; background-color: #f8f9fa; border: 1px dashed #ccc;">
                    [Espacio para Gráfico de Línea]
                </div>
            </div>
        </div>

    </div>

    <div class="card shadow-sm p-4 mt-4">
        <h4>Resumen Ejecutivo</h4>
        <p class="text-muted">Análisis general del periodo seleccionado</p>
        <div class="row">
            <div class="col-md-4"><h6>Ventas:</h6><small>Total de unidades vendidas.</small></div>
            <div class="col-md-4"><h6>Finanzas:</h6><small>Margen de ganancia.</small></div>
            <div class="col-md-4"><h6>Inventario:</h6><small>Productos con bajo stock.</small></div>
        </div>
    </div>
</div>
@endsection
