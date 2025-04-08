<section class="blog_area p_120 single-post-area">
    <h1 class="text-center mb-20">Blog Posts</h1>
    <div class="container">

        <div class="row">
            <?php
            if (isset($data) && $data) { ?>
                <div class="col-lg-8" style="margin:0 auto;">
                    <div class="main_blog_details">
                        <img class="img-fluid" src="<?php
                        echo ($data[0]['image']) ? "/uploads/".$data[0]['image'] : ''; ?>" alt="">
                        <a href="#"><h4><?php
                                echo $data[0]['title']; ?></h4></a>
                        <div class="user_details">

                            <div class="float-right">
                                <div class="media">
                                    <div class="media-body">
                                        <h5><?php
                                            echo $data[0]['first_name']." ".$data[0]['last_name']; ?></h5>
                                        <p><?php
                                            echo date("F d, Y", strtotime($data[0]['created_at'])); ?></p>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <?php
                        echo $data[0]['description']; ?>
                        <div class="news_d_footer">

                            <a class="justify-content-center ml-auto" href="#"><i class="lnr lnr lnr-bubble"></i><?php
                                echo $data[0]['comment_count']; ?> Comments</a>
                            <div class="news_socail ml-auto">
                                <a title="copy url" style="cursor: pointer;" class="copy-link" data-url="<?php
                                echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>">
                                    <i class="fa fa-link"></i>
                                </a>
                                <a title="share via twitter" class="twitter-share-button"
                                   href="https://twitter.com/intent/tweet?text=<?php
                                   echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>">
                                    <i class="fa fa-twitter"></i>
                                </a>

                            </div>
                        </div>
                    </div>

                    <div class="comments-area">
                        <?php
                        if (isset($comments) && $comments) { ?>
                            <?php
                            foreach ($comments as $comment) { ?>
                                <div class="comment-list">
                                    <div class="single-comment justify-content-between d-flex">
                                        <div class="user justify-content-between d-flex">

                                            <div class="desc">
                                                <h5><a href="#"><?php
                                                        echo $comment['first_name']." ".$comment['last_name']; ?></a></h5>
                                                <p class="date"><?php
                                                    echo date("F d, Y", strtotime($comment['created_at'])); ?> </p>
                                                <p class="comment">
                                                    <?php
                                                    echo $comment['content']; ?>
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <?php
                            }
                        } ?>

                        <?php
                        if ($session->get('user') !== null && $session->get('user') !== '' && $session->get('user')['role'] == 'user') { ?>
                            <div class="comment-form">
                                <h4>Leave a Comment</h4>
                                <form action="/add_comment" method="post" id="comment-form">
                                    <input type="hidden" name="post_id" value="<?php
                                    echo $data[0]['id']; ?>">

                                    <div class="form-group">
                                        <textarea class="form-control mb-10" rows="5" name="content" placeholder="Messege"
                                                  onfocus="this.placeholder = ''" onblur="this.placeholder = 'Messege'" required=""></textarea>
                                    </div>
                                    <button type="submit" class="primary-btn submit_btn">Post Comment</button>
                                </form>
                            </div>
                            <?php
                        } else { ?>
                            <div class="comment-form">
                                <h4>Please login to leave a comment</h4>
                            </div>
                            <?php
                        } ?>
                    </div>
                </div>
                <?php
            } else { ?>
                <h1>There is no such blog</h1>
                <?php
            } ?>
        </div>
</section>

<script>
    $('#comment-form').validate({
        rules: {
            content: {
                required: true,
                maxlength: 255
            }
        }
    })

    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).attr('data-url')).select();
        document.execCommand("copy");
        $temp.remove();
    }

    $('.copy-link').on('click', function () {
        copyToClipboard('.copy-link');
    })
</script>
