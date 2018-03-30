$("#checkboxMur").on('click', function(){
    if(this.checked){
        $("#panelMur").show();

    }else{
        $("#panelMur").hide();
    }
});

$(".selectUnite").on('change', function(){
    var id = $(this).attr("id");
    var unit = $("#"+id).find(":selected").text();
    var idPrix = "prixCompo"+id.split("Compo")[1];
    var prix = $("#"+idPrix).text();
    var price = prix * unit;
    total = $("#prix").text();
    var p1 = parseInt(price);
    var p2 = parseInt(total);
    total = p1 + p2;
    $("#prix").text(total);
});

