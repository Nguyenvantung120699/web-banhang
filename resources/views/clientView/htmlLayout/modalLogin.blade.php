@if(!Auth::check())
 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <section class="login_box_area section_gap">
            <div class="container">
              <div class="row">
                <div class="col-lg-12">
                  <div class="login_form_inner">
                    <h3>Login</h3>
                    <form class="row login_form" action="#" method="post" id="contactForm" novalidate="novalidate">
                    @csrf
                      <div class="col-md-12 form-group">
                        <input class="form-control" id="email"  type="email" name="email" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'">
                      </div>
                      <div class="col-md-12 form-group">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
                      </div>
                      <div class="col-md-12 form-group">
                        <div class="creat_account">
                          <input type="checkbox" id="f-option2" name="selector">
                          <label for="f-option2">Keep me logged in</label>
                        </div>
                      </div>
                      <div class="col-md-12 form-group">
                        <button type="button" id="loginBtn" class="primary-btn">Log In</button>
                        <a href="#">Forgot Password?</a>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
    </div>
</div>

<script type="text/javascript">
        $("#loginBtn").bind("click",function () {
           $.ajax({
               url: "{{url("postLogin")}}",
               method: "POST",
               data: {
                   _token: $("input[name=_token]").val(),
                   email: $("input[name=email]").val(),
                   password: $("input[name=password]").val(),
               },
               success: function (res) {
                   if(res.status){
                        location.reload();
                   }else{
                       alert(res.message);
                   }
               }
           });
        });
    </script>
    @endif
