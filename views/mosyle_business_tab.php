<div id="mosyle_business-tab"></div>
<h2 data-i18n="mosyle_business.title"></h2>

<table id="mosyle_business-tab-table"></table>

<script>
$(document).on('appReady', function(){
    $.getJSON(appUrl + '/module/mosyle_business/get_data/' + serialNumber, function(data){
        var table = $('#mosyle_business-tab-table');
        $.each(data, function(key,val){
            var th = $('<th>').text(i18n.t('mosyle_business.column.' + key));
            var td = $('<td>').text(val);
            table.append($('<tr>').append(th, td));
        });
    });
});
</script>
