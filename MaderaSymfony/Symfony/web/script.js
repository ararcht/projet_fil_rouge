$(".modulePanel").on('click', function(){
    var id = $(this).attr("id");
    var module = "panel"+id.split("box")[1];
    if($("#"+id).is(':checked')){
        $("#"+module).show();

    }else{
        $("#"+module).hide();
    }
});


$(".selectUnite").each( function(){
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
    getSelectedOption();
});

<<<<<<< HEAD


$(".selectUnite").change(function() {
  var total = 50000;
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
});
=======
>>>>>>> d1ff687d317fad7be11205e939a3ec7272e4ba95
function getSelectedOption(){
    var count = 0;
    var listvalue = $(".selectUnite").find(":selected").text();
    for (let index = 0; index < listvalue.length; index++) {
        count = count +parseInt(listvalue[index]);
<<<<<<< HEAD

    }
    $("#nOpt").text(count);
}
=======
        
    }
    $("#nOpt").text(count);   
}
>>>>>>> d1ff687d317fad7be11205e939a3ec7272e4ba95
