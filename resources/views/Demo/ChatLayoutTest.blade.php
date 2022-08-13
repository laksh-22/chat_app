@extends('layoutsAgent.app')
@section('content')
<div class="content-wrapper">


<div class="container-fluid">


<div class="center">
    <div class="contacts">
        <!-- <i class="fas fa-bars fa-2x"></i> -->
        <h2>
            Agents 
        </h2>

        <div class="contact" id="list">
            <div class="pic rogers"></div>
            <!-- <div class="badge">
                14
            </div> -->
            <div class="name">
                Steve Rogers
            </div>
            <div class="message">
                That is America's ass 🇺🇸🍑
            </div>
        </div>

    </div>

    <div class="chat">

        <div class="contact bar">
            <div class="pic stark"></div>
            <div class="name">
                <span class="name">mr stark</span>
            </div>
        </div>

        <div class="messages" id = "chatbox">
            <div class="time-send">
                <span class="timer-send">11:11 am</span>
            </div>
            <div class="message send">
                Hey, man! What's up, Mr Stark? 👋
            </div>
            <div class="time-receive">
                <span class="timer-receive">11:11 am</span>
            </div>
            <div class="message receive">
                Kid, where'd you come from? 
            </div>
            
            <!-- <div class="message stark">
                <div class="typing typing-1"></div>
                <div class="typing typing-2"></div>
                <div class="typing typing-3"></div>
            </div> -->
        </div>

        <div class="input">
            @csrf
            <input type="text" id='message' name="message" onkeyup="disableButton()" value="" placeholder="Type Message ..." class="form-control">
            <input type="hidden" id='sender' name="sender" value="{{session('id')}}">
            <input type="hidden" id="rec" name="receiver" value="">
            <!-- <span class="input-group-append"> -->
            <button type="submit" class="btn btn-primary disabled" id="sendMsg">Send</button>
            <!-- </span> -->
            <!-- <input placeholder="Type your message here!" type="text" /><i class="fas fa-microphone"></i> -->
        </div>
    </div>
</div>

<script>
    var chat = document.getElementById('chatbox');
   chat.scrollTop = chat.scrollHeight - chat.clientHeight;
</script>


</div>


</div>
@endsection