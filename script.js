// Your existing JS code

// let menu = document.querySelector('#menu-bars');
// let navbar = document.querySelector('.navbar');

// menu.onclick = () => {
//     menu.classList.toggle('fa-times');
//     navbar.classList.toggle('active');
// };

// window.onscroll = () => {
//     menu.classList.remove('fa-times');
//     navbar.classList.remove('active');
// };

// Initialize Swiper
var swiper = new Swiper(".home-slider", {
    effect: "coverflow",
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: 1,
    loop: true,
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
    },
    coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: true,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
});

// Fetching a resource
// fetch('https://jsonplaceholder.typicode.com/posts/1')
//     .then((response) => response.json())
//     .then((json) => {
//         console.log(json);
//         // Display the fetched data in the HTML
//         document.querySelector('#post-title').textContent = json.title;
//         document.querySelector('#post-body').textContent = json.body;
//     })
//     .catch((error) => console.error('Error fetching data:', error));

// // Creating a resource
// fetch('https://jsonplaceholder.typicode.com/posts', {
//   method: 'POST',
//   body: JSON.stringify({
//     title: 'foo',
//     body: 'bar',
//     userId: 1,
//   }),
//   headers: {
//     'Content-Type': 'application/json; charset=UTF-8',
//   },
// })
//   .then((response) => {
//     // Check if the response is okay (status in the range 200-299)
//     if (!response.ok) {
//       throw new Error('Network response was not ok ' + response.statusText);
//     }
//     return response.json();
//   })
//   .then((json) => {
//     console.log(json);
//     // Optionally, provide user feedback (e.g., display a message)
//     alert('Resource created successfully!');
//   })
//   .catch((error) => {
//     console.error('Error creating resource:', error);
//     // Optionally, provide error feedback
//     alert('Failed to create resource: ' + error.message);
//   });

