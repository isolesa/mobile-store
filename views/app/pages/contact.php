<div class="clear"> </div>
<style>
    .errorContact{
        visibility: hidden !important;
        color:red;
        font-size:14px;
    }
    .contactInput{
        border:1px solid transparent;
    }
    .redBorder{
        border:1px solid red !important;
    }
    .visibleError{
        visibility: visible !important;
    }
    .successMessage{
        color:green;
        visibility: visible !important;
    }
</style>
<div class="wrap">
    <div class="content">
        <div class="section group">
            <div class="col span_2_of_3">
                <div class="contact-form">
                    <h2>Contact Us</h2>
                    <form>
                        <div>
                            <span><label>NAME</label></span>
                            <span><input type="text" value="" placeholder="Your name" name="firstLastName" class="contactInput" id="firstLastName"></span>
                            <span class="errorContact">Name is not valid!</span>
                        </div>
                        <div>
                            <span><label>E-MAIL</label></span>
                            <span><input type="text" value="" placeholder="Your email" name="email" class="contactInput" id="contactEmail"></span>
                            <span class="errorContact">E-mail is not valid!</span>
                        </div>
                        <div>
                            <span><label>SUBJECT</label></span>
                            <span><textarea placeholder="Subject" id="subject" name="subject" class="contactInput"></textarea></span>
                            <span class="errorContact">Sorry! Something is wrong with this message!</span>
                        </div>
                        <div>
                            <span><input type="button" value="Submit" name="sendMessageBtn" id="sendMessageBtn"></span>
                        </div>
                        <span class="successMessage"></span>
                    </form>
                </div>
            </div>
        </div>
        <div class="clear"> </div>
    </div>
    <div class="clear"> </div>
</div>