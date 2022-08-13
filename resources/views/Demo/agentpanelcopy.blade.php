@extends('layoutsAgent.app')
@section('content')
<div class="content-wrapper">

    <div style="height:100%;"class="container-fluid"> 

        <div class="row">

            <div style="background-color: #ccc;" class="container-fluid col-lg-3">
                <table style="border:2px solid black;" class="table text-center">
                    <thead class = "table-dark">
                        <tr>
                            <th scope="col">Agents Listed</th>
                        </tr>
                    </thead>

                    <tbody id="list">

                       <!-- script -->

                    </tbody>
                </table>
            </div>


            <script>
                $(document).ready(function (){

                    $('#list').html('');

                    $.ajax({

                        url: "/agentpanel-list",
                        method:'get',
                        dataType: 'JSON',
                        success: function(response){
                        
                            $.each(response.lists, function(key,list){

                                if(list.id == {{session('id')}})
                                {
                                    return;
                                }
                                $('#list').append(
                                    "<tr>"+
                                    "<td><button id="+list.id+"  style='width: -webkit-fill-available;' class = 'btn btn-success loader'>"+
                                    list.name+ "<br><small>" +list.email+"</small></button></td></tr>"
                                );

                            });
                        }
                    });
                });
            </script>
            
<!-- ---------------------------------------------second division------------------------------------------------------- -->

            <div class="card card-primary direct-chat direct-chat-primary col-lg-9" style = "padding-right:15px;">

                <div class="card-header">
                    <h3 class="card-title"><span class="name"></span></h3>

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
                    <div class="direct-chat-messages" id = "chatbox" style="height:796px; overflow:scroll; overflow-x:hidden;">
                        
                        <!-- script -->        

                    </div>
                </div>
   

                <div class="card-footer"  id="sendBtn">
                    <div class="input-group" >
                        @csrf
                        <input type="text" id='message' name="message" onkeyup="disableButton()" value="" placeholder="Type Message ..." class="form-control">
                        <input type="hidden" id='sender' name="sender" value="{{session('id')}}">
                        <input type="hidden" id="rec" name="receiver" value="">
                        <!-- <span class="input-group-append"> -->
                        <button type="submit" class="btn btn-primary disabled" id="sendMsg">Send</button>
                        <!-- </span> -->
                    </div>
                </div>               
            </div>

            <script>
                function disableButton()
                {
                    if(document.getElementById('message').value != "")
                    {
                        document.getElementById('sendMsg').classList.remove("disabled");
                    }
                    else if(document.getElementById('message').value == "")
                    {
                        document.getElementById('sendMsg').classList.add("disabled");
                    }
                }
            </script>

            <script> 

                $(document).ready(function (){

                    $(document).on('click','.loader',function(){
                        let id = this.id;
                        $("#rec").val(id);

                        fetchChat(id);

                        const refreshchat = setInterval(function(){

                            $(document).on('click','.loader',function(){
                                let iid = this.id;
                                $("#rec").val(iid);
                                
                                stopLoading();
                                fetchChat(iid);
                            });
                           
                            fetchChat(id);

                        }, 10000);

                        function stopLoading(){
                            clearInterval(refreshchat);
                        }

                    });   

                    $(document).on('click','#sendMsg',function(){
                        var id = $("#rec").val();
                        let data = {
                            'sender': $("#sender").val(),
                            'receiver': $("#rec").val(),
                            'message': $("#message").val()
                        }
                        saveChat(data);
                        fetchChat(id);
                    });   

                    function saveChat(data){
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "/savechat",
                            method:'POST',
                            data: data,
                            dataType: 'JSON',
                            success: function(response){
                                console.log(response.message);
                            },
                        });

                        $("#message").val('');
                    }


                    function fetchChat(id){
                        // var id = $("#rec").val();
                        $('#chatbox').html('');
                        $.ajax({

                            url: "/loadchat/"+id,
                            method:'get',
                            dataType: 'JSON',
                            success: function(response) {
                                $('.name').empty();
                                $('.name').append(response.name);

                                $.each(response.messages, function(key,chat){
                                
                                    if(chat.type == 'incoming')
                                    {
                                        $('#chatbox').append(
                                            "<div class='direct-chat-msg' style='margin-right:20%;'>"+
                                            "<div class='direct-chat-infos clearfix'>"+
                                            //  "<span class='direct-chat-name float-left'>"+chat.personname+"</span>"+
                                            "<span class='direct-chat-timestamp float-right'>"+chat.time+"</span></div>"+
                                            "<div class='direct-chat-text'>"+chat.message+"</div></div>"
                                        );
                                    }

                                    else if(chat.type == 'outgoing')
                                    {
                                        $('#chatbox').append(
                                            "<div class='direct-chat-msg right' style='margin-left:20%;'>"+
                                            "<div class='direct-chat-infos clearfix'>"+
                                            // "<span class = 'direct-chat-name float-right'>"+chat.personname+"</span>"+
                                            "<span class='direct-chat-timestamp float-left'>"+chat.time+"</span></div>"+
                                            "<div class='direct-chat-text'>"+chat.message+"</div></div>"
                                        );
                                    } 
                                });
                                var messageBody = document.querySelector('#chatbox');
                                messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
                            }
                        });
                    }
                });
            </script> 

        </div>  <!-- row -->
    </div>  <!-- container-fluid -->

</div> 
@endsection









public function DeleteChat(Request $req)
    {
        $senderData = Chatdetail::where('senderId',session('id'))->Where('receiverId',$req->idd);
        $senderData->delete();
        $receiverData = Chatdetail::where('senderId',$req->idd)->Where('receiverId',session('id'));
        $receiverData->delete();
        return redirect('agentpanel');
    }