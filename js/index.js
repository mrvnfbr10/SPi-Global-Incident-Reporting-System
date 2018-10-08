$(document).ready(function(){
   var tbltickets =  $("#tbltickets").DataTable({
   	"ajax": "OIRS/ajax.php",
   	"order":[]
   });
  });

console.log("test");