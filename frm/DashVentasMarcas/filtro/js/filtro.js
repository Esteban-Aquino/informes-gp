/**
 * Autor: Esteban Aqiono
 * Fecha: 15/10/2018
 * Descripcion: Cargar parametros del filtro en caso que tenga
 * caso contrario inicializar los filtros
 */
(function (){
    var params = sessionStorage.getItem('DashVentasMarcas');
    console.log('Carga filtro');
    if (!empty(params)) {
        $('#fec_desde').val(moment(JSON.parse(params).fec_desde).format("YYYY-MM-DD"));
        $('#fec_hasta').val(moment(JSON.parse(params).fec_hasta).format("YYYY-MM-DD"));;
    } else {
        var date = new Date();
        $('#fec_desde').val(moment(new Date(date.getFullYear(), date.getMonth(), 1)).format("YYYY-MM-DD"));
        $('#fec_hasta').val(moment(new Date(date.getFullYear(), date.getMonth() + 1, 0)).format("YYYY-MM-DD"));
    }
    aplicarFiltros(); 
    
})();

