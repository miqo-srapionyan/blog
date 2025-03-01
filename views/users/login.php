<link rel="stylesheet" href="/assets/css/login_styles.css">

<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Icon -->
        <div class="fadeIn first">

        </div>

        <!-- Login Form -->
        <form action="/post_login" method="post" id="login_form">
            <input type="email" id="email" class="fadeIn second" name="email" placeholder="Email">
            <input type="password" id="password" class="fadeIn third" name="password" placeholder="Password">
            <input type="submit" name="submit" class="fadeIn fourth" value="Log In">
        </form>

        <!-- Remind Passowrd -->
        <div id="formFooter">
            <a class="underlineHover" href="/register">Register</a>
        </div>

    </div>
</div>

<script>
    $(document).ready(function(){
        $('#login_form').validate({
            rules:{
                email:{
                    required: true,
                    maxlength: 255,
                    email:true
                },
                password:{
                    required: true,
                    minlength:6,
                    maxlength:10
                },
            }
        });
    })
</script>
