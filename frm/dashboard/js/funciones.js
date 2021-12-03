/**
 * Autor: Esteban Aqiono
 * Fecha: 30/09/2018
 * Descripcion: Funciones del Dashboard
 */
$.ready(inicializa());
var interval;
function inicializa() {
    validadSesion();
    cargar();
    Repetir();
    borrar_filtro();
    $('#ventas_dia').on('click',function(){
        cargar_formulario('frm/ventas');
    });
    $('#ventas_ayer').on('click',function(){
        cargar_formulario('frm/ventas_ayer');
    });
}
function cargar(){
    console.log("Cargando");
    GetVentasDia();
    GetVentasAyer();
    GetVentasMes();
    GetRentaMes();
    GetUnidadesMes();
    GetTicketsMes();
    GetMontoPromTicketsMes();
    
}
function Repetir() {
    this.interval = setInterval("cargar()", 30000);
}
function GetVentasDia(){
    var pUrl= 'api/getventasdia';
    var pBeforeSend = "";
    var pSucces = "GetVentasDiaSuccess(json)";
    var pError = "ajax_error()";
    var pComplete = "";
    //console.log("enviando-func");
    ajaxGet(pUrl, pBeforeSend, pSucces, pError, pComplete);
}
function GetVentasDiaSuccess(json){
    //console.log("recibiendo");
    //console.log(json['existencia'].VENTAS_HOY);
    var ventas_dia = '0'+json['existencia'][0].VENTAS_HOY|| 0;
    var ventas_ani_past = json['existencia'][0].VENTAS_ANIO_PAST|| 0;
    var proc_ventas_dia = json['existencia'][0].PORC|| 0;
    var ventas_dia_ani_past = json['existencia'][0].VENTAS_ANIO_PAST|| 0;
    var ventas_desc_dia = json['existencia'][0].DESC_DIA;
    var ventas_desc_dia_past = json['existencia'][0].DESC_DIA_PAST;
    var vcolor;
    var vflecha;
    if (parseInt(ventas_dia)>parseInt(ventas_ani_past)){
        vcolor = 'green';
        vflecha = 'fa fa-sort-asc';
    }else if(parseInt(ventas_dia)<parseInt(ventas_ani_past)){
        vcolor = 'red';
        vflecha = 'fa fa-sort-down';
    } else{
        vcolor = 'grey';
        vflecha = 'fa fa-unsorted';
    }
    
    if (parseInt(proc_ventas_dia) > 500){
        proc_ventas_dia = "+500";
    }
    //console.log(json['existencia'][0].VENTAS_HOY);
    $('#dia').text(ventas_desc_dia);
    $('#dia_past').text(ventas_desc_dia_past);
    $('#monto_ventas_dia').text(ventas_dia);
    $('#porc_ventas_dia').text(proc_ventas_dia+'%');
    $('#monto_ventas_dia_anio_past').text(ventas_dia_ani_past);
    
    $('#ventas_dia_color').removeClass();
    $('#ventas_dia_color').addClass(vcolor);
    $('#ventas_dia_flecha').removeClass();
    $('#ventas_dia_flecha').addClass(vflecha);
    
    $('#cargando-ventas-dia').addClass('oculto');
    $('#div-ventas-dia').removeClass('oculto-d');
    $('#div-ventas-dia-past').removeClass('oculto-d');
    formatoNro();
    console.log("Ventas Dia Cargado");
}
// Ayer
function GetVentasAyer(){
    var pUrl= 'api/getventasayer';
    var pBeforeSend = "";
    var pSucces = "GetVentasAyerSuccess(json)";
    var pError = "ajax_error()";
    var pComplete = "";
    //console.log("enviando-func");
    ajaxGet(pUrl, pBeforeSend, pSucces, pError, pComplete);
}
function GetVentasAyerSuccess(json){
    //console.log("recibiendo");
    //console.log(json['existencia'].VENTAS_HOY);
    var ventas_dia = json['existencia'][0].VENTAS_AYER|| 0;
    var ventas_ani_past = json['existencia'][0].VENTAS_ANIO_PAST|| 0;
    var proc_ventas_dia = json['existencia'][0].PORC|| 0;
    var ventas_dia_ani_paso = json['existencia'][0].VENTAS_ANIO_PAST|| 0;
    var desc_ayer_past = json['existencia'][0].DESC_DIA_PAST;
    var desc_ayer = json['existencia'][0].DESC_DIA;
    //console.log(desc_dia_ani_paso);
    var vcolor;
    var vflecha;
    if (parseInt(ventas_dia)>parseInt(ventas_ani_past)){
        vcolor = 'green';
        vflecha = 'fa fa-sort-asc';
    }else if(parseInt(ventas_dia)<parseInt(ventas_ani_past)){
        vcolor = 'red';
        vflecha = 'fa fa-sort-down';
    } else{
        vcolor = 'grey';
        vflecha = 'fa fa-unsorted';
    }
    
    if (parseInt(proc_ventas_dia) > 500){
        proc_ventas_dia = "+500";
    }
    
    $('#dia_ayer').text(desc_ayer);
    $('#dia_ayer_past').text(desc_ayer_past);
    $('#monto_ventas_ayer').text(ventas_dia);
    $('#porc_ventas_ayer').text(proc_ventas_dia+'%');
    $('#monto_ventas_ayer_anio_past').text(ventas_dia_ani_paso);
    $('#monto_ventas_ayer').text(ventas_dia);
    
    $('#ventas_ayer_color').removeClass();
    $('#ventas_ayer_color').addClass(vcolor);
    $('#ventas_ayer_flecha').removeClass();
    $('#ventas_ayer_flecha').addClass(vflecha);
    
    $('#cargando-ventas-ayer').addClass('oculto');
    $('#div-ventas-ayer').removeClass('oculto-d');
    $('#div-ventas-ayer-past').removeClass('oculto-d');
    formatoNro();
    console.log("Ventas Ayer Cargado");
}

// Ventas Mes
function GetVentasMes(){
    var pUrl= 'api/getventasmes';
    var pBeforeSend = "";
    var pSucces = "GetVentasMesSuccess(json)";
    var pError = "ajax_error()";
    var pComplete = "";
    //console.log("enviando-func");
    ajaxGet(pUrl, pBeforeSend, pSucces, pError, pComplete);
}
function GetVentasMesSuccess(json){
    //console.log("recibiendo");
    //console.log(json['datos']);
    var ventas_mes = json['datos'][0].VENTAS_MES|| 0;
    var ventas_ani_past = json['datos'][0].VENTAS_ANIO_PAST|| 0;
    var proc_ventas = json['datos'][0].PORC|| 0;

    var vcolor;
    var vflecha;
    if (parseInt(ventas_mes)>parseInt(ventas_ani_past)){
        vcolor = 'green';
        vflecha = 'fa fa-sort-asc';
        
    }else if(parseInt(ventas_mes)<parseInt(ventas_ani_past)){
        vcolor = 'red';
        vflecha = 'fa fa-sort-down';
    } else{
        vcolor = 'grey';
        vflecha = 'fa fa-unsorted';
    }
    
    if (parseInt(proc_ventas) > 500){
        proc_ventas = "+500";
    }
    
    
    $('#monto_ventas_mes').text(ventas_mes);
    $('#porc_ventas_mes').text(proc_ventas+'%');
    $('#monto_ventas_mes_anio_past').text(ventas_ani_past);
    
    $('#ventas_mes_color').removeClass();
    $('#ventas_mes_color').addClass(vcolor);
    // console.log('mes: '+vcolor);
    $('#ventas_mes_flecha').removeClass();
    $('#ventas_mes_flecha').addClass(vflecha);
    
    $('#cargando-ventas-mes').addClass('oculto');
    $('#div-ventas-mes').removeClass('oculto-d');
    $('#div-ventas-mes-past').removeClass('oculto-d');
    formatoNro();
    console.log("Ventas mes Cargado");
}

// Renta Anio
function GetRentaMes(){
    var pUrl= 'api/getrentaanio';
    var pBeforeSend = "";
    var pSucces = "GetRentaAnioSuccess(json)";
    var pError = "ajax_error()";
    var pComplete = "";
    //console.log("enviando-func");
    ajaxGet(pUrl, pBeforeSend, pSucces, pError, pComplete);
}
function GetRentaAnioSuccess(json){
    //console.log("recibiendo");
    //console.log(json['datos']);
    var renta_anio = json['datos'][0].RENTA_PORC|| 0;
    var renta_anio_past = json['datos'][0].RENTA_ANT_PORC|| 0;
    var proc_renta = json['datos'][0].RENTA_DIF_PORC|| 0;

    var vcolor;
    var vflecha;
    if (parseInt(renta_anio)>parseInt(renta_anio_past)){
        vcolor = 'green';
        vflecha = 'fa fa-sort-asc';
    }else if(parseInt(renta_anio)<parseInt(renta_anio_past)){
        vcolor = 'red';
        vflecha = 'fa fa-sort-down';
    } else{
        vcolor = 'grey';
        vflecha = 'fa fa-unsorted';
    }
    
    if (parseInt(proc_renta) > 500){
        proc_renta = "+500";
    }
    
    $('#monto-renta-anio').text(renta_anio);
    $('#porc-renta-anio').text(proc_renta+'%');
    $('#monto-renta-anio-past').text(renta_anio_past);
    
    $('#renta-anio-color').removeClass();
    $('#renta-anio-color').addClass(vcolor);
    $('#renta-anio-flecha').removeClass();
    $('#renta-anio-flecha').addClass(vflecha);
    
    $('#cargando-renta-anio').addClass('oculto');
    $('#div-renta-anio').removeClass('oculto-d');
    $('#div-renta-anio-past').removeClass('oculto-d');
    formatoNro();
    console.log("Renta año Cargado");
}

// Unidades Mes
function GetUnidadesMes(){
    var pUrl= 'api/getunidadesmes';
    var pBeforeSend = "";
    var pSucces = "GetUnidadesMesSuccess(json)";
    var pError = "ajax_error()";
    var pComplete = "";
    //console.log("enviando-func");
    ajaxGet(pUrl, pBeforeSend, pSucces, pError, pComplete);
}
function GetUnidadesMesSuccess(json){
    //console.log("recibiendo");
    //console.log(json['datos']);
    var unidades_mes = json['datos'][0].CANTIDAD_MES|| 0;
    var unidades_mes_past = json['datos'][0].CANTIDAD_ANIO_PAST|| 0;
    var proc = json['datos'][0].PORC|| 0;

    var vcolor;
    var vflecha;
    if (parseInt(unidades_mes)>parseInt(unidades_mes_past)){
        vcolor = 'green';
        vflecha = 'fa fa-sort-asc';
    }else if(parseInt(unidades_mes)<parseInt(unidades_mes_past)){
        vcolor = 'red';
        vflecha = 'fa fa-sort-down';
    } else{
        vcolor = 'grey';
        vflecha = 'fa fa-unsorted';
    }
    
    if (parseInt(proc) > 500){
        proc = "+500";
    }
    
    $('#monto-unidades-mes').text(unidades_mes);
    $('#porc-unidades-mes').text(proc+'%');
    $('#monto-unidades-mes-past').text(unidades_mes_past);
    
    $('#unidades-mes-color').removeClass();
    $('#unidades-mes-color').addClass(vcolor);
    $('#unidades-mes-flecha').removeClass();
    $('#unidades-mes-flecha').addClass(vflecha);
    
    $('#cargando-unidades-mes').addClass('oculto');
    $('#div-unidades-mes').removeClass('oculto-d');
    $('#div-unidades-mes-past').removeClass('oculto-d');
    formatoGs();
    console.log("Unidades Mes Cargado");
}
// Tickets Mes
function GetTicketsMes(){
    var pUrl= 'api/getticketsmes';
    var pBeforeSend = "";
    var pSucces = "GetTicketsMesSuccess(json)";
    var pError = "ajax_error()";
    var pComplete = "";
    //console.log("enviando-func");
    ajaxGet(pUrl, pBeforeSend, pSucces, pError, pComplete);
}
function GetTicketsMesSuccess(json){
    //console.log("recibiendo");
    //console.log(json['datos']);
    var tickets_mes = json['datos'][0].TICKETS_MES|| 0;
    var tickets_mes_past = json['datos'][0].TICKETS_MES_ANT|| 0;
    var proc = json['datos'][0].PORC|| 0;

    var vcolor;
    var vflecha;
    if (parseInt(tickets_mes)>parseInt(tickets_mes_past)){
        vcolor = 'green';
        vflecha = 'fa fa-sort-asc';
    }else if(parseInt(tickets_mes)<parseInt(tickets_mes_past)){
        vcolor = 'red';
        vflecha = 'fa fa-sort-down';
    } else{
        vcolor = 'grey';
        vflecha = 'fa fa-unsorted';
    }
    
    if (parseInt(proc) > 500){
        proc = "+500";
    }
    
    $('#cant-tickets-mes').text(tickets_mes);
    $('#porc-tickets-mes').text(proc+'%');
    $('#cant-tickets-mes-past').text(tickets_mes_past);
    
    $('#tickets-mes-color').removeClass();
    $('#tickets-mes-color').addClass(vcolor);
    $('#tickets-mes-flecha').removeClass();
    $('#tickets-mes-flecha').addClass(vflecha);
    
    $('#cargando-tickets-mes').addClass('oculto');
    $('#div-tickets-mes').removeClass('oculto-d');
    $('#div-tickets-mes-past').removeClass('oculto-d');
    formatoGs();
    console.log("Tickets Mes Cargado");
}

// Monto Promedio Tickets Mes
function GetMontoPromTicketsMes(){
    var pUrl= 'api/getmontopromticketsmes';
    var pBeforeSend = "";
    var pSucces = "GetMontoPromTicketsMesSuccess(json)";
    var pError = "ajax_error()";
    var pComplete = "";
    //console.log("enviando-func");
    ajaxGet(pUrl, pBeforeSend, pSucces, pError, pComplete);
}
function GetMontoPromTicketsMesSuccess(json){
    //console.log("recibiendo");
   // console.log(json['datos']);
    var monto_tickets_mes = json['datos'][0].MONTO_PROM_TICK_MES|| 0;
    var monto_ttickets_mes_past = json['datos'][0].MONTO_PROM_TICK_MES_ANT|| 0;
    var proc = json['datos'][0].PORC|| 0;
    //console.log(json['datos'][0]);
    var vcolor;
    var vflecha;
    if (parseInt(monto_tickets_mes)>parseInt(monto_ttickets_mes_past)){
        vcolor = 'green';
        vflecha = 'fa fa-sort-asc';
    }else if(parseInt(monto_tickets_mes)<parseInt(monto_ttickets_mes_past)){
        vcolor = 'red';
        vflecha = 'fa fa-sort-down';
    } else{
        vcolor = 'grey';
        vflecha = 'fa fa-unsorted';
    }
    
    if (parseInt(proc) > 500){
        proc = "+500";
    }
    
    $('#monto-monto-tickets-mes').text(monto_tickets_mes);
    $('#porc-monto-tickets-mes').text(proc+'%');
    $('#monto-monto-tickets-mes-past').text(monto_ttickets_mes_past);
    
    $('#monto-tickets-mes-color').removeClass();
    $('#monto-tickets-mes-color').addClass(vcolor);
    $('#monto-tickets-mes-flecha').removeClass();
    $('#monto-tickets-mes-flecha').addClass(vflecha);
    
    $('#cargando-monto-tickets-mes').addClass('oculto');
    $('#div-monto-tickets-mes').removeClass('oculto-d');
    $('#div-monto-tickets-mes-past').removeClass('oculto-d');
    formatoGs();
    console.log("Tickets Mes Cargado");
}