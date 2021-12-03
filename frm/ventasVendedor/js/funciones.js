/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var cod_marca;
var desc_marca;
var cod_rubro;
var desc_rubro;
(function () {
    console.log('ventasVendedor');
    var params = sessionStorage.getItem('ventasVendedor');
    if (!empty(params)) {
        this.cod_marca = JSON.parse(params).cod_marca;
        this.desc_marca = JSON.parse(params).desc_marca;
        this.cod_rubro = JSON.parse(params).cod_rubro;
        this.desc_rubro = JSON.parse(params).desc_rubro;
        $('#filtro').text(this.desc_marca);
        $('#filtro').append('- Rubro: '+this.desc_rubro);
        $('#fec_desde').val(moment(JSON.parse(params).fec_desde).format("YYYY-MM-DD"));
        $('#fec_hasta').val(moment(JSON.parse(params).fec_hasta).format("YYYY-MM-DD"));;
        console.log(this.cod_rubro);
    } else {
        $('#fec_desde').val(moment(new Date(date.getFullYear(), date.getMonth(), 1)).format("YYYY-MM-DD"));
        $('#fec_hasta').val(moment(new Date(date.getFullYear(), date.getMonth() + 1, 0)).format("YYYY-MM-DD"));
    }
    GetDetalleVentas();
})();

function cargar(){
    $('#cargando-ventas').removeClass('oculto');
    $('#table-ventas"').addClass('oculto');
    GetDetalleVentas();
}
function GetDetalleVentas(){
    var vfec_desde = moment($('#fec_desde').val()).format('DD/MM/YYYY');
    var vfec_hasta = moment($('#fec_hasta').val()).format('DD/MM/YYYY');
    var pUrl= 'api/GetDetalleVentasVendedor?fec_desde='+vfec_desde+'&fec_hasta='+vfec_hasta+'&cod_marca='+this.cod_marca+'&cod_rubro='+this.cod_rubro;
    var pBeforeSend = "";
    var pSucces = "GetDetalleVentasSuccess(json)";
    var pError = "ajax_error()";
    var pComplete = "";
    console.log(pUrl);
    ajaxGet(pUrl, pBeforeSend, pSucces, pError, pComplete);
}

function GetDetalleVentasSuccess(json){
    //console.log(json['datos']);
    var vplantilla;
    var vdatos;
    $('#cargando-ventas').addClass('oculto');
    $('#table-ventas').removeClass('oculto');
    $.each(json['datos'], function (key, value) {
        var vVendedor = value.NOM_VENDEDOR;
        var vZona = value.COD_ZONA;
        var vVentaNeta = value.VENTAS_NETA;
        var vCantidad = value.CANTIDAD;
        var vDevolucion = value.DEVOLUCION;
        var vVentaBruta = value.VENTAS_BRUTA;
        
        
        vplantilla = '<tr> '+
                        '<td>'+vVendedor+'</td> '+
                        '<td> '+vZona+'</td> '+
                        '<td class="gs"> '+vVentaNeta+'</td> '+
                        '<td> '+vCantidad+'</td> '+
                        '<td class="gs"> '+vDevolucion+'</td> '+
                        '<td class="gs"> '+vVentaBruta+'</td> '
                    "</tr>";
        
        vdatos += vplantilla;
    });
    //console.log(vdatos);
    $('#tableBody').html(vdatos);
    $('#datatable').DataTable();
    formatoGs();
    $('#cargando-ventas').addClass('oculto');
    $('#table-ventas').removeClass('oculto');
}

/*function formatoGs() {
    $('.gs').priceFormat({
        prefix: '',
        centsSeparator: ',',
        thousandsSeparator: '.',
        centsLimit: 0,
        allowNegative: true
    });
}*/



