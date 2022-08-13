<div class="direct-chat-messages" id = "chatbox" style="height:796px;">

@foreach($messages as $message)
   @if($message['type']=='incoming')
     
            
   <div class="direct-chat-msg" style="margin-right:20%;">
      <div class="direct-chat-infos clearfix">
         <span class="direct-chat-name float-left">Meera</span>
         <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
      </div>
      
      <img class="direct-chat-img" src="/docs/3.1//assets/img/user1-128x128.jpg" alt="message user image">


      <div class="direct-chat-text">
      {{$message['message']}}
      </div>
      
   </div>

   @endif
  

   @if($message['type']=='outgoing')

   <div class="direct-chat-msg right" style="margin-left:20%;">
      <div class="direct-chat-infos clearfix">
         <span class="direct-chat-name float-right">Lakshya</span>
         <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
      </div>
      <img class="direct-chat-img" src="/docs/3.1//assets/img/user3-128x128.jpg" alt="message user image">
      

      <div class="direct-chat-text">
      {{$message['message']}}
      </div>

     
   </div>
   @endif

   @endforeach
</div>