<div class="card pub_image">
    <div class="card-header">
        @if($image->user->image)
        <div class="container-avatar">
            <img src="{{ route('user.avatar',['filename'=> $image->user->image ])}}" class="avatar">
        </div>
        @endif
        <div class="data-user">

        

            <a href="{{route('user.profile', ['id' => $image->user->id])}}">{{$image->user->name.' '. $image->user->surname}}
                <span class="nickname">{{' | @'.$image->user->nick}}</span></a>
                
            @if(Auth::user() && Auth::user()->id == $image->user->id)
            <div class="post-menu dropdown">
                <span class="ellipsis" href="#" id="dropdownMenuButton" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>&#8942;</span>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('image.edit', ['id' => $image->id]) }}">
                        Editar
                    </a>
                    <!-- Botón para abrir el modal de Bootstrap -->
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#myModal">
                        Eliminar
                    </a>
                </div>




                <!-- Modal -->
                <div class="modal" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Cabecera del modal -->
                            <div class="modal-header">
                                <h4 class="modal-title">¿Estás seguro?</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Cuerpo del modal -->
                            <div class="modal-body">
                                Estás a punto de eliminar la imagen. Una vez eliminada no podremos recuperarla. ¿Estás seguro de querer eliminarla?
                            </div>

                            <!-- Pie del modal -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-dismiss="modal">¡No, no quiero eliminarla!</button>
                                <a class="btn btn-danger" style="color: white" href="{{ route('image.delete', ['id' => $image->id]) }}">¡Si, quiero eliminarla!</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="likes">

            <!-- Comprobar si el usuario le dio like a la imagen -->
            <?php $user_like = false; ?>
            @foreach($image->likes as $like)
            @if($like->user->id == Auth::user()->id)
            <?php $user_like = true; ?>
            @endif
            @endforeach
            @if($user_like)
            <img src="{{asset('img/hearts-red.png')}}" data-id="{{$image->id}}" class="btn-dislike">
            @else
            <img src="{{asset('img/hearts-black.png')}}" data-id="{{$image->id}}" class="btn-like">
            @endif

            
        </div>
        </div>
    </div>

    <div class="card-body">
        <div class="image-container">
            <a href="{{route('image.detail', ['id' => $image->id])}}"><img src="{{route('image.file', ['filename' => $image->image_path])}}" alt=""></a>
        </div>

        <div class="description">
        

            <span class="nickname">{{'@'.$image->user->nick}} </span>
            <span class="nickname date">{{' | '.\FormatTime::LongTimeFilter($image->created_at)}} | </span><span class="number-likes" data-id="{{$image->id}}">{{count($image->likes)}} me gusta</span>

            <p>{{$image->description}}</p>
        </div>
        <div class="comments">
            <a href="{{route('image.detail', ['id' => $image->id])}}" class="btn btn-sm btn-warning btn-comments">Comentarios ({{count($image->comments)}})</a>

        </div>
    </div>
</div>