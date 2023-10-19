<?php global $reviewsGroups ?>
<?php $reviewsGroups = 1; $i = 0;  ?>
@foreach($reviews as $comment)
    <div class="comment-item {{RatingParser::getCssClassForBackground($comment->rating)}} rev-group-{{$reviewsGroups}} @if($reviewsGroups > 1) {{'display_none'}} @endif" id="comment-{{$comment->id}}">
        <div class="title-line">
            <span class="title-review-name @if($comment->rating <= 2 && isset($comment->complain_result)) hidden-review-name @endif"><?php if($comment->author!=null) echo trim($comment->author); else echo trim($comment->last_name . ' ' . $comment->first_name . ' ' . $comment->middle_name); ?></span>
            @if($comment->rating!=null)
                <div class="rating-line rev">{!! App\Models\System::rating($comment->rating) !!}
                    <?php
                    /*
                    if(Auth::user() != null){
                        $role = Auth::user()->roles()->get()[0]->id;
                        if($role == 1){
                            echo "<button class=\"remove-review btn btn-danger pull-right\"><i class=\"remove-review fa fa-remove\"></i></button>";
                            echo "<button class=\"edit-review btn btn-primary pull-right\"><i class=\"edit-review fa fa-edit\"></i></button>";
                        }
                    }

                    */
                    ?>
                </div>
            @endif
            @if($comment->rating <= 2)
                @if(isset($comment->complain_result))
                    <span class="label_of_complain_success">Решено</span>
                @else
                    <span class="label_of_complain_warning">Рассматривается</span>
                @endif
            @endif
        </div>
        <div class="text-rew @if($comment->rating <= 2 && isset($comment->complain_result)) hidden-review-body @endif">
            {!!$comment->review!!}
        </div>
        @if(($comment->pros!=null) || ($comment->minuses!=null))
            <div class="pros_minuses_wrap @if($comment->rating <= 2 && isset($comment->complain_result)) hidden-review-body @endif">
                @if((ltrim($comment->pros, ' ')!=null))
                    <div class="pros">{!! $comment->pros !!}</div>
                @endif
                @if(ltrim($comment->minuses,' ')!=null)
                    <div class="minuses">{!! $comment->minuses !!}</div>
                @endif
                <div class="clearfix"></div>
            </div>
        @endif
        @if(isset($comment->child))
            @foreach($comment->child as $child)
                <div class="comment-item @if($child->off_answer != null) off_answer @endif @if($comment->rating <= 2 && isset($comment->complain_result)) hidden-review-body @endif" id="comment-{{$child->id}}">
                    <div class="title-line">@if($child->off_answer != null) <i class="fa fa-check-square-o"></i> @endif @if($child->first_name!=null) {{$child->last_name}} {{$child->first_name}} {{$child->middle_name}} @if($child->off_answer != null) - официальный представитель компании  @endif @else {{$child->author}} @endif
                        @if($comment->rating!=null)
                            @if($child->off_answer == null)
                                <div class="rating-line rev">
                                    <?php
                                    if(Auth::user() != null){
                                        $role = Auth::user()->roles()->get()[0]->id;
                                        if($role == 1){
                                            echo "<button class=\"remove-review btn btn-danger pull-right\"><i class=\"remove-review fa fa-remove\"></i></button>";
                                        }
                                    }
                                    ?>
                                </div>
                            @endif
                        @endif
                    </div>
                    <div class="text-rew">
                        {!!$child->review!!}
                    </div>
                </div>
            @endforeach
        @endif
        <div class="reply @if($comment->rating <= 2 && isset($comment->complain_result)) hidden-review-body @endif" data-id="{{$comment->id}}">
            <a rel="nofollow" class="review-reply-link" href="#">Ответить</a>
        </div>
    </div>
    <?php $i++; if($i % 10 == 0) $reviewsGroups++; ?>
@endforeach