$(".modulePanel").on('click', function(){
    var id = $(this).attr("id");
    var module = "panel"+id.split("box")[1];
    if($("#"+id).is(':checked')){
        $("#"+module).show();

    }else{
        $("#"+module).hide();
    }
});

function calculPrice(){
  var total = 100000;
    $(".selectUnite").each( function(){
        var id = $(this).attr("id");
        var unit = $("#"+id).find(":selected").text();
        var idPrix = "prixCompo"+id.split("Compo")[1];
        var prix = $("#"+idPrix).text();
        var price = prix * unit;
        var p1 = parseInt(price);
        var p2 = parseInt(total);
        total = p1 + p2;
        $("#prix").text(total);
    });
}

$(".selectUnite").change(function() {
  calculPrice();
  getSelectedOption();
});

function getSelectedOption(){
    var count = 0;
    var listvalue = $(".selectUnite").find(":selected").text();
    for (let index = 0; index < listvalue.length; index++) {
        count = count +parseInt(listvalue[index]);
    }
    $("#nOpt").text(count);
}
    