<section id="contact" class="contact">
    <div class="dos__container">
        <h2 class="heading heading__2">Contact us</h2>
        <p class="heading__description">Need help ? Get in touch with us.</p>
    </div>
    <div class="contact__details">
        <div class="contact__form">
            <form id="contact-form" role="form" action="{{route('contact-us-form')}}" method="post">
                @csrf

                <input type="text" class="form-control" placeholder="Full Name" id="name" name="name" required>

                <input type="email" class="form-control" placeholder="Your Email" id="email" name="email" required>

                <input type="tel" class="form-control" placeholder="Your Phone" id="number" name="phone_number" required>

                <select class="form-control" id="cf-budgets" name="reason">
                    <option>Contact reason</option>
                    <option>Can't create a book</option>
                    <option>Can't upload book images</option>
                    <option>Pricing enquiries</option>
                    <option>Other reasons</option>
                </select>

                <textarea class="form-control" rows="6" placeholder="Your requirements" id="cf-message" name="message" required></textarea>
                <div class="contact__captcha">
                    <img style="width:100%;" src="{{ Captcha::src('math'); }}">
                    <button type="button" class="btn btn__rounded" class="reload" id="reload">
                        &#x21bb;
                    </button>
                </div>
                <input type="text" class="form-control" placeholder="Enter Captcha on the left" id="captcha" name="captcha" required>

                <div class="col-md-4 col-sm-12">
                    <input type="submit" class="btn btn__rounded" name="submit" value="Send Message">
                </div>

            </form>
        </div>
        <div class="contact__map">
            <iframe class="contact__map--map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15955.364608344307!2d36.80127391953077!3d-1.2681032326610508!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f173c0a1f9de7%3A0xad2c84df1f7f2ec8!2sWestlands%2C%20Nairobi!5e0!3m2!1sen!2ske!4v1656073547817!5m2!1sen!2ske" style="border:0;" allowfullscreen="true" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</section>