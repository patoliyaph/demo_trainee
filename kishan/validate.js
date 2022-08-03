$(document).ready(function() {
    $("#signup").validate({
      rules:{
        fname:{
          requried:true,
          minlength:3
        },
      },
      message:{
        fname:"enter your name"
      }
    })
   });