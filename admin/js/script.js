$(document).ready(function() {
    $('#summernote').summernote({
       height: 200
    });
  });


$(document). ready(function(){

   $('#selectAllBoxes').click(function(event){
      if(this.checked){
         $('.checkBoxes').each(function(){
         this.checked = true;
         });
      } else {
         $('.checkBoxes').each(function(){
            this.checked = false;
         });
      }
   });


   var divbox = "<div id='load-screen'><div id='loading'></div></div>";

   $("body").prepend(divbox);
0
   $('#load-screen').delay(7).fadeOut(600, function(){
      $(this).remove();
   });
});

function loadUsersOnline() {

$.get("functions.php?onlineusers=result", function(data){

   $(".useronline").text(data);
});

}

setInterval(function(){

   loadUsersOnline();

},500);