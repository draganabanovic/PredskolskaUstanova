$(document).ready(function(){
    $("#dugmeZaTeblu").on("click", function(){
      $("#pretraga").val('');
      $("#pretraga").trigger('keyup');
      if($("#tabela").css('display') === 'none')
      {
        $("#tabela").css("display", "");
      }
    });
//na svaku promenu u inputu pretraga on ce izvrsiti funkciju
    $("#pretraga").on("keyup", function() {
      if($("#pretraga").val()=="")
    {
      $("#tabela").css("display", "none");
    }else{
      $("#tabela").css("display", "");
    }
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    });