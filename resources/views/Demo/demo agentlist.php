@foreach($lists as $list)
                            <tr>
                                <!-- <td>{{ $list['id'] }}</td> -->
                                <td><button style="width: -webkit-fill-available;" class = "btn but btn-dark"><a href="/loadchat/{{$list['id']}}"> {{ $list['name'] }} <br> <small> {{ $list['email'] }}</small></button></td>
                                <!-- <td>{{ $list['email'] }}</td> -->
                            </tr>
                            
                        @endforeach