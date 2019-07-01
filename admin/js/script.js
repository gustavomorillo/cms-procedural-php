    $(document).ready(function() {
        $('#summernote').summernote();


        $('#selectAllBoxes').click(function(e){
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

        // var div_box = "<div id='load-screen'><div id='loading'></div></div>";

        // $("body").prepend(div_box);

        // $('#load-screen').delay(700).fadeOut(600, function(){
        //     $(this).remove();

        // });

         $(".delete_link").on('click', function(){

            var id = $(this).attr("rel");
            var delete_url = "posts.php?delete="+ id + " ";

            $(".modal_delete_link").attr("href",delete_url);

            $("#myModal").modal('show');


        });

    });

    function loadUsersOnline() {

        $.get("functions.php?onlineusers=result", function(data){

        $(".usersonline").text(data);


        });

    }
    setInterval(function(){
           loadUsersOnline();
    }, 500);

   
     



 

