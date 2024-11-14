<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Event Management System😎</title>

    <!-- Swiper CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />

    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <!-- header section -->
    <header class="header">
      <a href="#" class="logo"><span>Event</span>Universe</a>

      <nav class="navbar">
        <a href="#home">home</a>
        <a href="#service">service</a>
        <a href="#about">about</a>
        <!-- <a href="#gallery">gallery</a> -->
        <a href="#price">price</a>
        <a href="#review">review</a>
        <a href="#contact">contact</a>
      </nav>

      <div id="menu-bars" class="fas fa-bars"></div>
    </header>

    <!-- home section starts -->
    <section class="home" id="home">
      <div class="image">
        <img src="namaste_img.jpg" alt=" Namaste">
      </div>

      <div class="content">
        <h3>It's time to celebrate the best <span>events</span></h3>
        <button onclick="location.href='register.html'">Register</button>
        <button onclick="location.href='login.html'">Login</button>
      </div>

      <div id="post">
        <h2 id="post-title"></h2>
        <p id="post-body"></p>
      </div>
    
      <!-- Updated Swiper Container -->
      <div class="swiper home-slider">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <img src="images/event1.jpg" alt="Event 1" />
          </div>
          <div class="swiper-slide">
            <img src="images/event2.jpg" alt="Event 2" />
          </div>
          <div class="swiper-slide">
            <img src="images/event3.jpg" alt="Event 3" />
          </div>
          <div class="swiper-slide">
            <img src="images/event4.jpg" alt="Event 4" />
          </div>
          <div class="swiper-slide">
            <img src="images/event5.jpg" alt="Event 5" />
          </div>
          <div class="swiper-slide">
            <img src="images/event6.jpg" alt="Event 6" />
          </div>
        </div>

        <!-- Swiper Pagination -->
        <div class="swiper-pagination"></div>
      </div>
    </section>

    <!-- Service section starts -->
    <section class="service" id="service">
      <h1 class="heading"> Our <span>Services</span></h1>

      <div class="box-container">
        <div class="box">
          <i class="fa-solid fa-location-dot"></i>
          <h3>Venue Selection</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea consequatur similique quam dicta tenetur sint quaerat expedita odit tempore necessitatibus.</p>
        </div>

        <div class="box">
          <i class="fa-regular fa-envelope"></i>
          <h3>Invitation Card</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea consequatur similique quam dicta tenetur sint quaerat expedita odit tempore necessitatibus.</p>
        </div>

        <div class="box">
          <i class="fa-solid fa-music"></i>
          <h3>Entertainment</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea consequatur similique quam dicta tenetur sint quaerat expedita odit tempore necessitatibus.</p>
        </div>

        <div class="box">
          <i class="fa-solid fa-utensils"></i>
          <h3>Snacks</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea consequatur similique quam dicta tenetur sint quaerat expedita odit tempore necessitatibus.</p>
        </div>

        <div class="box">
          <i class="fa-solid fa-photo-film"></i>
          <h3>Photo and Video</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea consequatur similique quam dicta tenetur sint quaerat expedita odit tempore necessitatibus.</p>
        </div>

        <div class="box">
          <i class="fa-solid fa-cake-candles"></i>
          <h3>Cakes</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea consequatur similique quam dicta tenetur sint quaerat expedita odit tempore necessitatibus.</p>
        </div>
      </div>
    </section>

    <!-- About Section -->
     <section class="about" id="about">
      <h1 class="heading"><span>About</span>Us</h1>
      <div class="row">

        <div class="image">
          <img src="about_img.jpg" alt="">
        </div>

        <div class="content">
          <h3>We give very special event venue.</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam dolore sunt nemo asperiores, laboriosam numquam illum necessitatibus consectetur reiciendis commodi dolorum animi minus, provident perspiciatis deserunt quaerat minima quod quia.</p>
          <a href="#" class="btn">Contact Us</a>
        </div>
      </div>
     </section>

     <!-- Price Section -->
      <section class="price" id="price">
        <h1 class="heading">Our <span>Pricing</span></h1>
        <div class="box-container">
          <div class="box">
            <h3 class="title">For Birthdays</h3>
            <h3 class="price">₹5000</h3>
            <ul>
              <li><i class="fa-solid fa-check"></i>Full Services</li>
              <li><i class="fa-solid fa-check"></i>Full Services</li>
              <li><i class="fa-solid fa-check"></i>Full Services</li>
              <li><i class="fa-solid fa-check"></i>Full Services</li>
              <li><i class="fa-solid fa-check"></i>Full Services</li>
            </ul>
            <a href="#" class="btn">Check Out</a>
          </div>
        </div>

        <div class="box-container">
          <div class="box">
            <h3 class="title">For Weddings</h3>
            <h3 class="price">₹9000</h3>
            <ul>
              <li><i class="fa-solid fa-check"></i>Full Services</li>
              <li><i class="fa-solid fa-check"></i>Full Services</li>
              <li><i class="fa-solid fa-check"></i>Full Services</li>
              <li><i class="fa-solid fa-check"></i>Full Services</li>
              <li><i class="fa-solid fa-check"></i>Full Services</li>
            </ul>
            <a href="#" class="btn">Check Out</a>
          </div>
        </div>

        <div class="box-container">
          <div class="box">
            <h3 class="title">For Musical Nights</h3>
            <h3 class="price">₹15000</h3>
            <ul>
              <li><i class="fa-solid fa-check"></i>Full Services</li>
              <li><i class="fa-solid fa-check"></i>Full Services</li>
              <li><i class="fa-solid fa-check"></i>Full Services</li>
              <li><i class="fa-solid fa-check"></i>Full Services</li>
              <li><i class="fa-solid fa-check"></i>Full Services</li>
            </ul>
            <a href="#" class="btn">Check Out</a>
          </div>
        </div>

        <div class="box-container">
          <div class="box">
            <h3 class="title">For Private celebrations</h3>
            <h3 class="price">₹16000</h3>
            <ul>
              <li><i class="fa-solid fa-check"></i>Full Services</li>
              <li><i class="fa-solid fa-check"></i>Full Services</li>
              <li><i class="fa-solid fa-check"></i>Full Services</li>
              <li><i class="fa-solid fa-check"></i>Full Services</li>
              <li><i class="fa-solid fa-check"></i>Full Services</li>
            </ul>
            <a href="#" class="btn">Check Out</a>
          </div>
        </div>
      </section>

      <!-- Review Section -->
       <section class="review" id="review">

        <h1 class="heading">Client's <span>Review</span></h1>
        <div class="review-slider swiper-container">
          <div class="swiper-wrapper">
            <div class="swiper-slide box">
              <!-- <i class="fa-solid fa-quote-right"></i> -->
              <div class="user">
                <img src="client1.jpg" alt="">
                <div class="user-info">
                  <h3>Johnson Smith</h3>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star"></span> <br>
                  <span>Clients are Satisfied</span>
                </div>
              </div>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi in nisi aliquam nostrum, cupiditate eveniet ea molestias volupt</p>
            </div>

            <div class="swiper-slide box">
              <!-- <i class="fa-solid fa-quote-right"></i> -->
              <div class="user">
                <img src="client2.jpg" alt="">
                <div class="user-info">
                  <h3>Steve Smith</h3>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star"></span> <br>
                  <span>Clients are Satisfied</span>
                </div>
              </div>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi in nisi aliquam nostrum, cupiditate eveniet ea molestias volupta.</p>
            </div>

            <div class="swiper-slide box">
              <!-- <i class="fa-solid fa-quote-right"></i> -->
              <div class="user">
                <img src="client3.jpg" alt="">
                <div class="user-info">
                  <h3>Alex Michael</h3>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star"></span> <br>
                  <span>Clients are Satisfied</span>
                </div>
              </div>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi in nisi aliquam nostrum, cupiditate eveniet ea molestias voluptas i.</p>
            </div>

            <div class="swiper-slide box">
              <!-- <i class="fa-solid fa-quote-right"></i> -->
              <div class="user">
                <img src="client4.jpg" alt="">
                <div class="user-info">
                  <h3>Joe Smith</h3>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span> <br>
                  <span>Clients are Satisfied</span>
                </div>
              </div>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi in nisi aliquam nostrum, cupiditate eveniet ea m</p>
            </div>

          </div>
        </div>
       </section>

      <!-- Contact Section -->
       <section class="contact" id="contact">
        <h1 class="heading">Contact <span>Us</span></h1>
        <form action="">
          <div class="inputBox">
            <input type="text" placeholder="name">
            <input type="email" placeholder="email">
          </div>
          <div class="inputBox">
            <input type="number" placeholder="Phone Number">
            <input type="text" placeholder="Title">
          </div>
          <textarea name="" placeholder="Your Message" id="" cols="10" rows="7"></textarea>
          <input type="submit" value="Send" class="btn">
        </form>
       </section>

       <!-- Footer section -->
        <section class="footer" id="footer">
          <div class="box-container">
            <div class="box">
              <h3>Our other outlets</h3>
              <a href="#"><i class="fa-solid fa-location-dot"></i>Hyderabad</a>
              <a href="#"><i class="fa-solid fa-location-dot"></i>Goa</a>
              <a href="#"><i class="fa-solid fa-location-dot"></i>Delhi</a>
              <a href="#"><i class="fa-solid fa-location-dot"></i>Andheri West, Mumbai</a>
              <a href="#"><i class="fa-solid fa-location-dot"></i>Bangalore</a>
            </div>

            <div class="box">
              <h3>Quick Navigation</h3>
              <a href="#home"><i class="fa-solid fa-up-right-from-square"></i>Home</a>
              <a href="#service"><i class="fa-solid fa-up-right-from-square"></i>Service</a>
              <a href="#about"><i class="fa-solid fa-up-right-from-square"></i>About</a>
              <a href="#price"><i class="fa-solid fa-up-right-from-square"></i>Price</a>
              <a href="#review"><i class="fa-solid fa-up-right-from-square"></i>Review</a>
              <a href="#contact"><i class="fa-solid fa-up-right-from-square"></i>Contact</a>
            </div>

            <div class="box">
              <h3>Contact Information</h3>
              <a href="#"><i class="fa-solid fa-phone"> +91-77499 50272</i>
              <a href="#"><i class="fa-solid fa-phone"> +91-78470 01248</i><br>
              <a href="#"><i class="fa-solid fa-envelope"></i>khuntiachandan26@gmail.com</a>
            </div>

            <div class="box">
              <h3>Follow Us</h3>
              <a href="#"><i class="fa-brands fa-facebook"> Facebook</i>
              <a href="#"><i class="fa-brands fa-instagram"> Instagram</i>
              <a href="#"><i class="fa-brands fa-x-twitter"> Twitter</i>
              <a href="#"><i class="fa-brands fa-youtube"> YouTube</i>
              <a href="#"><i class="fa-brands fa-threads"> Threads</i>
              <a href="#"><i class="fa-brands fa-pinterest"> Pininterest</i>
            </div>

            <div class="copy"> <br><br>
              <p class="footer-text">© 2024 Event Management System. All Rights Reserved.</p>
            </div>
          </div>
        </section>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Custom JS -->
    <script src="script.js"></script>
  </body>
</html>
