<script src="https://cdn.tiny.cloud/1/jmzu46r7lgkehxlsoqbxl2z1ioxfcyu2piw5ekkbfsike4z7/tinymce/5/tinymce.min.js"></script>

<div class="container">
    <h1 class="text-center mb-20">Admin Posts</h1>
    <div class="row">
        <div class="col-lg-8" style="margin:0 auto;">
            <form id="blog-post-form" action="/add_post" method="post" enctype="multipart/form-data" class="mb-5">
                <div class="form-group">
                    <label>Title</label>
                    <input name="title" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>


                <div class="form-group custom-file mt-3 mb-3">
                    <label class="custom-file-label">Image</label>
                    <input name="image" type="file" class="custom-file-input">
                </div>
                <div class="form-check mb-2">
                    <input type="checkbox" name="status" class="form-check-input" id="check1">
                    <label class="form-check-label" for="check1">Status</label>
                </div>
                <input type="submit" class="btn btn-primary" name="submit" value="Add">
            </form>
            <table id="data-table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Comments count</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (isset($data) && $data) { ?>
                    <?php
                    foreach ($data as $post) { ?>
                        <tr>
                            <td><?php
                                echo $post['id']; ?></td>
                            <td><?php
                                echo $post['title']; ?></td>
                            <td><?php
                                echo substr(strip_tags($post['description']), 0, 100)."..."; ?></td>
                            <td><?php
                                echo ($post['image']) ? "<img src='/uploads/".$post['image']."' style='width:100px;height:100px;'>" : '' ?></td>
                            <td>
                                <span><?php
                                    echo ($post['status']) ? "On production" : 'On moderation'; ?></span>
                                <button data-id="<?php
                                echo $post['id']; ?>" data-status="<?php
                                echo $post['status']; ?>" class="btn btn-primary change-status">change
                                </button>
                            </td>
                            <td><?php
                                echo $post['comment_count']; ?></td>
                            <td><a href="/delete_post/<?php
                                echo $post['id']; ?>">Delete</a></td>
                        </tr>
                        <?php
                    }
                } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>tinymce.init({ selector: 'textarea', });</script>
<script>
    $('#blog-post-form').validate({
        rules: {
            title: {
                required: true,
                maxlength: 20,
            },
            description: {
                maxlength: 800,
            },
            image: {
                extension: "jpg|jpeg|gif|png"
            }
        }
    });
    $(document).on('click', '.change-status', function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        var status = $(this).attr('data-status');
        var $this = $(this);
        $.ajax({
            url: '/change_status',
            type: 'post',
            data: { id: id, status: status },
            success: function () {

                if (parseInt(status) === 1) {
                    $this.attr('data-status', '0')
                    $this.parent().find('span').text('On moderation');
                } else {
                    $this.attr('data-status', '1')
                    $this.parent().find('span').text('On production');
                }
            }
        })
    })

    $('#data-table').DataTable();
</script>