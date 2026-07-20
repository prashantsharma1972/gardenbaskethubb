<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500&family=Roboto:wght@400;500&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href='/wp-content/themes/gardenbaskethubb/build/contactUs/contactUs.css?a8'>
    <script type="module" defer
        src='/wp-content/themes/gardenbaskethubb/build/contactUs/contactUs.bundle.js?a8'></script>

    <?php
    $homeUrl = get_home_url();
    get_header();
    ?>

    <main class="main--container">

        <section class="contact-banner">
            <div class="banner-flex">
                <div class="banner-text">
                    <div class="upper-text">
                        <h4>Start a Conversation!</h4>
                        <p>Want to know more or have a quick chat?</p>
                        <p class="small-text-bottom">Feel free to reach out here!</p>
                    </div>
                </div>
                <div class="banner-image">
                    <img src="https://gardenbaskethubb.com/wp-content/uploads/2025/01/contact-banner-img.webp"
                        width="410" height="210" fetchpriority="high" alt="gardenbaskethubb">
                </div>
            </div>
        </section>

        <section class="contact-form">
            <div class="form-container">
                <form id="needform">
                    <div class="full-name-container">
                        <div class="form-group">
                            <label for="form-firstname">NAME <span style="color: red;">*</span></label>
                            <div class="input-container-inner">
                                <div>
                                    <input type="text" id="form-firstname" name="lfirstname" placeholder="First Name">
                                </div>
                                <div>
                                    <input type="text" id="form-lastname" name="llastname" placeholder="Last Name">
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="full-name-container">
                        <div class="form-group">
                            <div class="input-container-outer">
                                <div>
                                    <label for="form-company">COMPANY /INSTITUTION <span
                                            style="color: red;">*</span></label>
                                    <input type="text" id="form-company" name="lcompany">
                                </div>
                                <div>
                                    <label for="form-jobtitle">JOB ROLE<span style="color: red;">*</span></label>
                                    <input type="text" id="form-jobtitle" name="ljobtitle">
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="form-group">
                        <label for="form-email">EMAIL <span style="color: red;">*</span></label>
                        <input type="email" id="form-email" name="lemail">
                    </div>
                    <div class="form-group">
                        <label for="form-git-phonenumber">PHONE <span style="color: red;">*</span></label>
                        <input type="tel" id="form-git-phonenumber" name="lphone">
                    </div>

                    <div class="form-group">
                        <label for="course">SUBJECT <span style="color: red;">*</span></label>
                        <select name="preffered-subject" id="course">
                            <option value="" disabled="" selected="">Select Preferred Subject of Contact </option>
                            <option value="General Contact">General Contact </option>
                            <option value="Book to Speak">Book to Speak </option>
                            <option value="Press/Media Inquiry">Press/Media Inquiry </option>
                            <option value="partnership">partnership </option>
                            <option value="Looking for Job Opportunities">Looking for Job Opportunities</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="form-message">MESSAGE <span style="color: red;">*</span></label>
                        <textarea id="form-message" name="Description"></textarea>
                    </div>
                    <div class="submit-btn-container">
                        <button type="submit" class="button"><b>Submit</b></button>
                    </div>
                </form>
            </div>
        </section>

    </main>

    <?php get_footer(); ?>

    </body>

</html>