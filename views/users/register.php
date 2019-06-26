<link rel="stylesheet" href="/assets/css/login_styles.css">

<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Icon -->
        <div class="fadeIn first">

        </div>

        <!-- Login Form -->
        <form action="/post_register" method="POST" id="register_form">
            <input type="text" id="first_name" class="fadeIn second" name="first_name" placeholder="First Name">
            <input type="text" id="last_name" class="fadeIn second" name="last_name" placeholder="Last Name">
            <input type="email" id="email" class="fadeIn second" name="email" placeholder="Email">
            <input type="password" id="password" class="fadeIn third" name="password" placeholder="Password">
            <div>
                <input type="submit" name="submit" class="fadeIn fourth submit" value="Register">
            </div>

        </form>

        <!-- Remind Passowrd -->
        <div id="formFooter">
            <a class="underlineHover" href="/login">Login</a>
        </div>

    </div>
</div>

<script>
    $(document).ready(function(){
        $('#register_form').validate({
            rules:{
                first_name:{
                    required: true,
                    maxlength: 255,
                },
                last_name:{
                    required: true,
                    maxlength: 255,
                },
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
        /*$('#register_form').on('submit', function(e){
            if(!$('#register_form').valid()){
                return false;
            }


        });*/


    })



</script>