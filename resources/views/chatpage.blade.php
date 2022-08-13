@extends('layoutsAgent.app')
@section('content')
<div class="content-wrapper">


<div class="row">

<div class="container col-lg-4" ></div>

<div class="card card-primary direct-chat direct-chat-primary col-lg-8" style = "padding-right:15px;">
   <div class="card-header">
      <h3 class="card-title">Direct Chat</h3>
      <div class="card-tools">
         <!-- <span data-toggle="tooltip" title="3 New Messages" class="badge badge-light">3</span> -->
         <button type="button" class="btn btn-tool" data-card-widget="collapse">
         <i class="fas fa-minus"></i>
         </button>
         <!-- <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle">
         <i class="fas fa-comments"></i> -->
         <!-- </button>
         <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
         </button> -->
      </div>
   </div>
   
   <div class="card-body" id="chatscroll">
   <div class="direct-chat-messages" id = "chatbox" style="height:796px; overflow:auto;">
     
   


</div>
   </div>

   <div class="card-footer"  id="sendBtn">
        <form action="/savechat" method="POST">
            <div class="input-group" >
                @csrf
                <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                <input type="hidden" name="sender" value="2">
                <input type="hidden" name="receiver" value="4">
                <!-- <span class="input-group-append"> -->
                <button type="submit" class="btn btn-primary" id="send">Send</button>
                
                <!-- </span> -->
            </div>
        </form>
    </div>
                <!-- <button type="button" id="btn">scroll Top</button> -->
               
</div>

</div> 




<!-- <script>
    $(document).ready(function() {
        // auto refresh page after 1 second
        setInterval('refreshPage()', 5000);
    });
    function refreshPage() { 
        location.reload(); 
        // alert('hello');
    }
</script> -->

<!-- <script type="text/javascript">
    function doRefresh(){
        $("#chat").load("/loadchat");
    }
    setInterval(function(){doRefresh()}, 5000);
</script> -->






<script>
    $(document).ready(function (){

           $('#chatbox').html('');



    $.ajax({

        url: "/loadchat",

        method:'get',

        dataType: 'JSON',

        success: function(response) {
            // $('#chatbox').append(
            //         "<div class='direct-chat-messages' id = 'chat' style='height:0px;'>"
            //          );

            // for (let i = 0; i < 70; i++)
            // {
            //     $('#chatbox').append(
            //         "hello"+"<br>"
            //     );
            // }
            
            $.each(response.messages, function(key,chat){
                if(chat.type == 'incoming')
                {
                    $('#chatbox').append(
                        "<div class='direct-chat-msg' style='margin-right:20%;'>"+
                         "<div class='direct-chat-infos clearfix'>"+
                         "<span class='direct-chat-name float-left'>Meera</span>"+
                         "<span class='direct-chat-timestamp float-right'>23 Jan 2:00 pm</span></div>"+
                         "<div class='direct-chat-text'>"+chat.message+"</div></div>"
                     );
                }

                else if(chat.type == 'outgoing')
                {
                    $('#chatbox').append(
                        "<div class='direct-chat-msg right' style='margin-left:20%;'>"+
                        "<div class='direct-chat-infos clearfix'>"+
                        "<span class = 'direct-chat-name float-right'>Lakshya</span>"+
                        "<span class='direct-chat-timestamp float-left'>23 Jan 2:05 pm</span></div>"+
                         "<div class='direct-chat-text'>"+chat.message+"</div></div>"
                     );
                }

                
            });

        }

    });
});
</script>

<!-- <script>
    ​function scrollToEnd(){
	var chatList = document.getElementById("chatscroll");
	chatList.scrollTop = chatList.scrollHeight;
}
</script> -->


<script>var messageBody = document.querySelector('#chatbox');
messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;</script>


<!-- <script>
    var div = $("#chatbox");
    div.scrollTop(div.prop('scrollHeight'));
</script>


<script>
    const messages= document.getElementById('chatscroll');
    messages.scrollTop + messages.clientHeight === messages.scrollHeight;
</script>

 <script>
$("#chatbox").animate({ scrollTop: $(document).height() }, "slow");
  return false;
  </script>

  <script>
    document.getElementsByClassName('card-footer')[0].scrollTop = document.getElementsByClassName('card-footer')[0].scrollHeight;
  </script>

  <script>
    $(document).ready(function(){
        $('.body').scrollTop($('.body')[0].scrollHeight);
    });
  </script>
  
  <script>
    document.addEventListener('scroll', function(e){
        document.documentElement.scrollHeight - window.innerHeight;
    })
  </script> 

  -->

  <!-- <script>
    document.body.scrollIntoView(0);
  </script>

  <script>
    window.scrollTo(0,document.body.scrollHeight);
  </script>

  <script>
    var myDiv = document.getElementById("sendBtn");
    myDiv.scrollTop = myDiv.scrollHeight;
  </script> -->



</div>
@endsection
























const refreshchat = setInterval(function() {
        iid = $("#rec").val();
        if(id!=iid)
        {
            stopLoading();
        }
        //   alert('10 secs has passed');
          fetchChat(iid);

   
    }, 3000);

    // alert('page loaded');

    function stopLoading(){
        clearInterval(refreshchat);
    }
        















    $("#message").hover(function(){
    if($("#message").val() == empty())
    {
        $("#sendmsg").addClass("disabled");
    }
    else
    {
        $("#sendmsg").removeClass("disabled");

    }
  });




  //         setTimeout(function() {
//     alert('first 1 secs');
//     // loadCars();
  
//     setInterval(function() {
//           alert('10 secs has passed');
//           // loadCars();
//     }, 10000);
//     // alert('page loaded');

// }, 1000);




$(document).on('click','.loader',function(){
            let id = this.id;
            $("#rec").val(id);

            fetchChat(id);

            const refreshchat = setInterval(function(){
                iid = $("#rec").val();
                if(id!=iid)
                {
                    stopLoading();
                }                
                fetchChat(iid);
            }, 10000);


            function stopLoading(){
                clearInterval(refreshchat);
            }

        });   