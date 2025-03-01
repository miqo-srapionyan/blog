<div class="container">
    <h1 class="text-center mb-20">Blog Posts</h1>
    <div class="row scroll">
        <?php if(isset($data) && $data){?>
        <?php foreach ($data as $post){?>
        <div class="col-lg-8" style="margin:0 auto;">

            <article class="blog_style1">
                <div class="blog_img">
                    <img class="img-fluid" src="<?php echo ($post['image']) ? "/uploads/".$post['image'] : '';?>" alt="">
                </div>
                <div class="blog_text">
                    <div class="blog_text_inner">
                        <div class="cat">

                            <a href="#"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo date("F d, Y",strtotime($post['created_at']));?></a>
                            <a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> <?php echo $post['comment_count'];?></a>
                        </div>
                        <a href="/blog/<?php echo $post['id'];?>"><h4><?php echo $post['title'];?></h4></a>
                        <p><?php echo substr(strip_tags($post['description']),0,200);?></p>
                        <a class="blog_btn" href="/blog/<?php echo $post['id'];?>">Read More</a>
                    </div>
                </div>
            </article>
        </div>
        <?php }?>
        <?php }?>

    </div>

</div>



<script>
    var lastScrollTop = 0;
    var flag = true;
    $(window).scroll(function() {
        var st = $(this).scrollTop();
        if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {

            if(!flag) return false;

            if (st > lastScrollTop){


                var limit = $('.blog_style1').length;
                var offset = $('.blog_style1').length + 3;
                $.ajax({
                    url:'/infinite_scroll',
                    type:'post',
                    dataType:'json',
                    data:{limit:limit,offset:offset},
                    success:function(obj){
                        if(obj.length){
                            var html = ``;
                            $.each(obj,function(i,v){
                                html += `<div class="col-lg-8" style="margin:0 auto;">

                                    <article class="blog_style1">
                                        <div class="blog_img">
                                            <img class="img-fluid" src="${v['image']}" alt="">
                                        </div>
                                        <div class="blog_text">
                                            <div class="blog_text_inner">
                                                <div class="cat">

                                                    <a href="#"><i class="fa fa-calendar" aria-hidden="true"></i> ${v['created_at']}</a>
                                                    <a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> ${v['comment_count']}</a>
                                                </div>
                                                <a href="/blog/${v['id']}"><h4>${v['title']}</h4></a>
                                                <p>${v['description']}</p>
                                                <a class="blog_btn" href="/blog/${v['id']}">Read More</a>
                                            </div>
                                        </div>
                                    </article>
                                </div>`;
                            })
                            $('.scroll').append(html);
                        }
                        flag = true;
                    }
                })
            }
            flag = false;

        }
        lastScrollTop = st;
    });
</script>