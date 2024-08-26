/*==================== SHOW MENU ====================*/
const navMenu = document.getElementById('nav-menu'),
      navToggle = document.getElementById('nav-toggle'),
      navClose = document.getElementById('nav-close')

/*===== MENU SHOW =====*/
/* Validate if constant exists */
if(navToggle){
    navToggle.addEventListener('click', () =>{
        navMenu.classList.add('show-menu')
    })
}

/*===== MENU HIDDEN =====*/
/* Validate if constant exists */
if(navClose){
    navClose.addEventListener('click', () =>{
        navMenu.classList.remove('show-menu')
    })
}

/*==================== REMOVE MENU MOBILE ====================*/
const navLink = document.querySelectorAll('.nav__link')

function linkAction(){
    const navMenu = document.getElementById('nav-menu')
    // When we click on each nav__link, we remove the show-menu class
    navMenu.classList.remove('show-menu')
}
navLink.forEach(n => n.addEventListener('click', linkAction))


/*==================== CHANGE BACKGROUND HEADER ====================*/
function scrollHeader(){
    const header = document.getElementById('header')
    // When the scroll is greater than 100 viewport height, add the scroll-header class to the header tag
    if(this.scrollY >= 100) header.classList.add('scroll-header'); else header.classList.remove('scroll-header')
}
window.addEventListener('scroll', scrollHeader)

/*==================== SWIPER DISCOVER ====================*/
let swiper = new Swiper(".discover__container", {
    effect: "coverflow",
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: "auto",
    loop: true,
    spaceBetween: 32,
    coverflowEffect: {
        rotate: 0,
    },
})

/*==================== VIDEO ====================*/
// Dapatkan elemen video
const video = document.getElementById('video-file');
video.poster = 'assets/img/videoframe_220533.png';

// Fungsi untuk memeriksa apakah elemen terlihat
function isInViewport(element) {
    const rect = element.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
}

// Fungsi untuk memutar video ketika terlihat
function playVideoIfInView(entries) {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            video.play(); // Mulai video ketika masuk ke dalam tampilan
        } else {
            video.pause(); // Jeda video ketika keluar dari tampilan
        }
    });
}

// Buat Intersection Observer
const observer = new IntersectionObserver(playVideoIfInView);

// Amati elemen video
observer.observe(video);

// Fungsi untuk memperbarui status interseksi saat meresize jendela
function updateIntersectionStatus() {
    if (isInViewport(video)) {
        video.play();
    } else {
        video.pause();
    }
}

// Tambahkan event listener untuk resize jendela
window.addEventListener('resize', updateIntersectionStatus);

// Periksa apakah video terlihat saat halaman dimuat
updateIntersectionStatus();


// // Get the video element
// const video = document.getElementById('video-file');
// video.poster = 'assets/img/videoframe_220533.png';

// // Function to check if element is in view
// function isInViewport(element) {
//     const rect = element.getBoundingClientRect();
//     return (
//         rect.top >= 0 &&
//         rect.left >= 0 &&
//         rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
//         rect.right <= (window.innerWidth || document.documentElement.clientWidth)
//     );
// }

// // Function to play the video when it's in view
// function playVideoIfInView(entries) {
//     entries.forEach(entry => {
//         if (entry.isIntersecting) {
//             video.play();
//         } else {
//             video.pause();
//         }
//     });
// }

// // Create an Intersection Observer
// const observer = new IntersectionObserver(playVideoIfInView);

// // Observe the video element
// observer.observe(video);

// // Function to update intersection status when resizing the window
// function updateIntersectionStatus() {
//     if (isInViewport(video)) {
//         video.play();
//     } else {
//         video.pause();
//     }
// }

// // Add event listener for window resize
// window.addEventListener('resize', updateIntersectionStatus);

// // Check if video is in view on page load
// updateIntersectionStatus();

//end

// const videoFile = document.getElementById('video-file'),
//       videoButton = document.getElementById('video-button'),
//       videoIcon = document.getElementById('video-icon')

//       videoFile.poster = 'assets/img/videoframe_220533.png';

// function playPause(){ 
//     if (videoFile.paused){
//         // Play video
//         videoFile.play()
//         // We change the icon
//         videoIcon.classList.add('ri-pause-line')
//         videoIcon.classList.remove('ri-play-line')
//     }
//     else {
//         // Pause video
//         videoFile.pause(); 
//         // We change the icon
//         videoIcon.classList.remove('ri-pause-line')
//         videoIcon.classList.add('ri-play-line')

//     }
// }

// videoButton.addEventListener('click', playPause)

// function finalVideo(){
//     // Video ends, icon change
//     videoIcon.classList.remove('ri-pause-line')
//     videoIcon.classList.add('ri-play-line')
// }
// // ended, when the video ends
// videoFile.addEventListener('ended', finalVideo)

// const videoFile = document.getElementById('video-file');
// const videoButton = document.getElementById('video-button');
// const videoIcon = document.getElementById('video-icon');

// videoFile.poster = 'assets/img/videoframe_220533.png';

// function playPause() {
//     if (videoFile.paused) {
//         // Play video
//         videoFile.play();
//         // We change the icon
//         videoIcon.classList.add('ri-pause-line');
//         videoIcon.classList.remove('ri-play-line');
//         // Adjust button opacity
//         videoButton.style.opacity = '0.3';
//     } else {
//         // Pause video
//         videoFile.pause();
//         // We change the icon
//         videoIcon.classList.remove('ri-pause-line');
//         videoIcon.classList.add('ri-play-line');
//         // Adjust button opacity
//         videoButton.style.opacity = '1';
//     }
// }
// videoButton.addEventListener('click', playPause);

// function finalVideo() {
//     // Video ends, icon change
//     videoIcon.classList.remove('ri-pause-line');
//     videoIcon.classList.add('ri-play-line');
//     // Reset button opacity
//     videoButton.style.opacity = '1';
// }
// // ended, when the video ends
// videoFile.addEventListener('ended', finalVideo);

/*==================== SHOW SCROLL UP ====================*/ 
function scrollUp(){
    const scrollUp = document.getElementById('scroll-up');
    if(window.scrollY >= 2500) {
        scrollUp.classList.add('show-scroll');
    } 
        else {
            scrollUp.classList.remove('show-scroll');
        }
}
window.addEventListener('scroll', scrollUp);


/*==================== SHOW whatsapp ====================*/ 
function whatsApp(){
    const whatsApp = document.getElementById('whatsapp');
    if(this.scrollY >= 200) {
        whatsApp.classList.add('show-whatsapp');
    }
         else {
            whatsApp.classList.remove('show-whatsapp');
         } 
}
window.addEventListener('scroll', whatsApp)

/*==================== SCROLL SECTIONS ACTIVE LINK ====================*/
// const sections = document.querySelectorAll('section[id]')

// function scrollActive(){
//     const scrollY = window.pageYOffset

//     sections.forEach(current =>{
//         const sectionHeight = current.offsetHeight
//         const sectionTop = current.offsetTop - 50;
//         sectionId = current.getAttribute('id')

//         if(scrollY > sectionTop && scrollY <= sectionTop + sectionHeight){
//             document.querySelector('.nav__menu a[href*=' + sectionId + ']').classList.add('active-link')
//         }else{
//             document.querySelector('.nav__menu a[href*=' + sectionId + ']').classList.remove('active-link')
//         }
//     })
// }
// window.addEventListener('scroll', scrollActive)

/*==================== SCROLL REVEAL ANIMATION ====================*/
const sr = ScrollReveal({
    distance: '60px',
    duration: 2800,
    // reset: true,
})


sr.reveal(`.home__data, .home__social-link, .home__info,
           .discover__container,
           .experience__data, .experience__overlay,
           .place__card,
           .sponsor__content,
           .footer__data, .footer__rights`,{
    origin: 'top',
    interval: 100,
})

sr.reveal(`.about__data, 
           .video__description,
           .subscribe__description`,{
    origin: 'left',
})

sr.reveal(`.about__img-overlay, 
           .video__content,
           .subscribe__form`,{
    origin: 'right',
    interval: 100,
})

/*==================== DARK LIGHT THEME ====================*/ 
// const themeButton = document.getElementById('theme-button')
// const darkTheme = 'dark-theme'
// const iconTheme = ' fa-toggle-off'

// // Previously selected topic (if user selected)
// const selectedTheme = localStorage.getItem('selected-theme')
// const selectedIcon = localStorage.getItem('selected-icon')

// // We obtain the current theme that the interface has by validating the dark-theme class
// const getCurrentTheme = () => document.body.classList.contains(darkTheme) ? 'dark' : 'light'
// const getCurrentIcon = () => themeButton.classList.contains(iconTheme) ? ' fa-toggle-on' : ' fa-toggle-off'

// // We validate if the user previously chose a topic
// if (selectedTheme) {
// //   If the validation is fulfilled, we ask what the issue was to know if we activated or deactivated the dark
//   document.body.classList[selectedTheme === 'dark' ? 'add' : 'r÷: 'remove'](iconTheme)
// }

// // Activate / deactivate the theme manually with the button
// themeButton.addEventListener('click', () => {
//     // Add or remove the dark / icon theme
//     document.body.classList.toggle(darkThem÷nTheme)
//     // We save the theme and the current icon that the user chose
//     localStorage.setItem('selected-theme', getCurrentTheme())
//     localStorage.setItem('selected-icon', getCurrentIcon())
// })

// ==================== DARK LIGHT THEME ====================
const themeButton = document.getElementById('theme-button');
const darkTheme = 'dark-theme';
const iconTheme = 'fa-toggle-on';
// const backgroundImage = document.getElementById('backgroundLight');

// Previously selected topic (if user selected)
const selectedTheme = localStorage.getItem('selected-theme');
const selectedIcon = localStorage.getItem('selected-icon');

// We obtain the current theme that the interface has by validating the dark-theme class
const getCurrentTheme = () => document.body.classList.contains(darkTheme) ? 'dark' : 'light';
const getCurrentIcon = () => themeButton.classList.contains(iconTheme) ? 'fa-toggle-on' : 'fa-toggle-off';

// We validate if the user previously chose a topic
if (selectedTheme) {
  // If the validation is fulfilled, we ask what the issue was to know if we activated or deactivated the dark
  document.body.classList[selectedTheme === 'dark' ? 'add' : 'remove'](darkTheme);
  themeButton.classList[selectedIcon === 'fa-toggle-on' ? 'add' : 'remove'](iconTheme);
}

// Function to toggle background image
function toggleBackgroundImage() {
    const currentTheme = getCurrentTheme();
    const isDarkTheme = currentTheme === 'dark';
    // if (isDarkTheme) {
    //     backgroundImage.src = 'assets/img/night.jpg'; // Change to night image when dark theme is activated
    // } else {
    //     backgroundImage.src = 'assets/img/day.jpg'; // Change to day image when light theme is activated
    // }
}

// Function to toggle background image
function toggleBackgroundImage() {
    const currentTheme = getCurrentTheme();
    const isDarkTheme = currentTheme === 'dark';

    // Mengambil referensi kedua gambar
    // const dayImage = document.getElementById('backgroundLight');
    // const nightImage = document.getElementById('backgroundDark');

    // if (isDarkTheme) {
    //     // Jika tema gelap, tampilkan gambar malam dan sembunyikan gambar siang
    //     nightImage.style.display = 'block';
    //     dayImage.style.display = 'none';
    // } else {
    //     // Jika tema terang, tampilkan gambar siang dan sembunyikan gambar malam
    //     dayImage.style.display = 'block';
    //     nightImage.style.display = 'none';
    // }
}

// Activate / deactivate the theme manually with the button
themeButton.addEventListener('click', () => {
    // Add or remove the dark / icon theme
    document.body.classList.toggle(darkTheme);
    themeButton.classList.toggle(iconTheme);
    // Toggle background image
    toggleBackgroundImage();
    // We save the theme and the current icon that the user chose
    localStorage.setItem('selected-theme', getCurrentTheme());
    localStorage.setItem('selected-icon', getCurrentIcon());
});

// Set initial background image based on current theme
toggleBackgroundImage();


// dropdown
    //element'footer__subtitle'
    const subtitles = document.querySelectorAll('.footer__subtitle');

    // Loop melalui setiap elemen dan tambahkan event listener untuk mengelola klik
    subtitles.forEach(subtitle => {
        subtitle.addEventListener('click', function() {
            // Toggle kelas 'open' pada elemen parent (footer__data)
            this.parentNode.classList.toggle('open');
        });
    });

// FLIPBOOK
//   flipbook HotelDirectory
$(document).ready(function () {
    $("#container").flipBook({
    pdfUrl:"/assets/pdf/RoomDirection.pdf",
        lightBox:true,
        lightboxBackground:'rgb(21,80,92,0.8)',
        // lightboxBackground:'none',
        lightBoxFullscreen:false,

        currentPage: {
            enabled: true,
            title: "Current page",
            vAlign: 'bottom',
            hAlign: 'left',
            marginH: 0,
            marginV: 0,
            background: 'none'
        },

        btnClose: {
            title: "Close",
            iconFA: "flipbook-icon-times",
            iconM: "flipbook-icon-clear",
            hAlign: 'right',
            vAlign: 'bottom',
            size: 15
        },

        btnExpand: {
            enabled: true,
            title: "Toggle fullscreen",
            iconFA: "flipbook-icon-times",
            iconM: "flipbook-icon-clear",
            hAlign: 'left',
            vAlign: 'bottom'
        },

        btnThumbs: {
            enabled: true,
            title: "Pages",
            iconFA: "flipbook-icon-th-large",
            iconM: "flipbook-icon-view_module",
            hAlign: 'left',
            vAlign: 'bottom'
        },

        menuMargin:0,
        menuBackground:'none',
        menuShadow:'none',
        menuAlignHorizontal:'right',
        menuOverBook:true,
        btnZoomIn : {enabled:false},
        btnZoomOut : {enabled:false},
        btnToc : {enabled:false},
        btnShare : {enabled:false},
        btnDownloadPages : {enabled:false},
        btnDownloadPdf : {enabled:false},
        btnSound : {enabled:false},
        btnBookmark:{enabled: false},
        btnSelect:{enabled: false},
        btnAutoplay : {enabled: false},
        btnPrint: {enabled: false},
        viewMode:'webgl',
        btnRadius:50,
        btnMargin:4,
        btnSize:15,
        // btnPaddingV:16,
        // btnPaddingH:16,
        btnColor: 'rgba(220,225,229)',
        btnBackground:'none',

        sideBtnRadius:30,
        sideBtnSize:30,
        sideBtnBackground:'none',
        sideBtnColor:'rgba(220,225,229)',
        })
    })

//canting&picadilly
$(document).ready(function () {
    $("#canting").flipBook({
    pdfUrl:"/assets/pdf/FB_MENU_TABLET.pdf",
        lightBox:true,
        lightboxBackground:'rgb(21,80,92,0.8)',
        // lightboxBackground:'none',
        lightBoxFullscreen:false,

        currentPage: {
            enabled: true,
            title: "Current page",
            vAlign: 'bottom',
            hAlign: 'left',
            marginH: 0,
            marginV: 0,
            background: 'none'
        },

        btnClose: {
            title: "Close",
            iconFA: "flipbook-icon-times",
            iconM: "flipbook-icon-clear",
            hAlign: 'right',
            vAlign: 'bottom',
            size: 15
        },

        btnExpand: {
            enabled: true,
            title: "Toggle fullscreen",
            iconFA: "flipbook-icon-times",
            iconM: "flipbook-icon-clear",
            hAlign: 'left',
            vAlign: 'bottom'
        },

        btnThumbs: {
            enabled: true,
            title: "Pages",
            iconFA: "flipbook-icon-th-large",
            iconM: "flipbook-icon-view_module",
            hAlign: 'left',
            vAlign: 'bottom'
        },

        menuMargin:0,
        menuBackground:'none',
        menuShadow:'none',
        menuAlignHorizontal:'right',
        menuOverBook:true,
        btnZoomIn : {enabled:false},
        btnZoomOut : {enabled:false},
        btnToc : {enabled:false},
        btnShare : {enabled:false},
        btnDownloadPages : {enabled:false},
        btnDownloadPdf : {enabled:false},
        btnSound : {enabled:false},
        btnBookmark:{enabled: false},
        btnSelect:{enabled: false},
        btnAutoplay : {enabled: false},
        btnPrint: {enabled: false},
        viewMode:'webgl',
        btnRadius:50,
        btnMargin:4,
        btnSize:15,
        // btnPaddingV:16,
        // btnPaddingH:16,
        btnColor: 'rgba(220,225,229)',
        btnBackground:'none',

        sideBtnRadius:30,
        sideBtnSize:30,
        sideBtnBackground:'none',
        sideBtnColor:'rgba(220,225,229)',
        })
    })

//   semarang
$(document).ready(function () {
    $("#semarang").flipBook({
    pdfUrl:"/assets/pdf/Hotel-Dafam-Semarang.pdf",
    lightBox:true,
    lightboxBackground:'rgb(21,80,92,0.8)',
    // lightboxBackground:'none',
    lightBoxFullscreen:false,

    currentPage: {
        enabled: true,
        title: "Current page",
        vAlign: 'bottom',
        hAlign: 'left',
        marginH: 0,
        marginV: 0,
        background: 'none'
    },

    btnClose: {
        title: "Close",
        iconFA: "flipbook-icon-times",
        iconM: "flipbook-icon-clear",
        hAlign: 'right',
        vAlign: 'bottom',
        size: 15
    },

    btnExpand: {
        enabled: true,
        title: "Toggle fullscreen",
        iconFA: "flipbook-icon-times",
        iconM: "flipbook-icon-clear",
        hAlign: 'left',
        vAlign: 'bottom'
    },

    btnThumbs: {
        enabled: true,
        title: "Pages",
        iconFA: "flipbook-icon-th-large",
        iconM: "flipbook-icon-view_module",
        hAlign: 'left',
        vAlign: 'bottom'
    },

    menuMargin:0,
    menuBackground:'none',
    menuShadow:'none',
    menuAlignHorizontal:'right',
    menuOverBook:true,
    btnZoomIn : {enabled:false},
    btnZoomOut : {enabled:false},
    btnToc : {enabled:false},
    btnShare : {enabled:false},
    btnDownloadPages : {enabled:false},
    btnDownloadPdf : {enabled:false},
    btnSound : {enabled:false},
    btnBookmark:{enabled: false},
    btnSelect:{enabled: false},
    btnAutoplay : {enabled: false},
    btnPrint: {enabled: false},
    viewMode:'webgl',
    btnRadius:50,
    btnMargin:4,
    btnSize:15,
    // btnPaddingV:16,
    // btnPaddingH:16,
    btnColor: 'rgba(220,225,229)',
    btnBackground:'none',

    sideBtnRadius:30,
    sideBtnSize:30,
    sideBtnBackground:'none',
    sideBtnColor:'rgba(220,225,229)',
    })
})

    //   cilacap
$(document).ready(function () {
$("#cilacap").flipBook({
pdfUrl:"/assets/pdf/Hotel-Dafam-Cilacap.pdf",
lightBox:true,
        lightboxBackground:'rgb(21,80,92,0.8)',
        // lightboxBackground:'none',
        lightBoxFullscreen:false,

        currentPage: {
            enabled: true,
            title: "Current page",
            vAlign: 'bottom',
            hAlign: 'left',
            marginH: 0,
            marginV: 0,
            background: 'none'
        },

        btnClose: {
            title: "Close",
            iconFA: "flipbook-icon-times",
            iconM: "flipbook-icon-clear",
            hAlign: 'right',
            vAlign: 'bottom',
            size: 15
        },

        btnExpand: {
            enabled: true,
            title: "Toggle fullscreen",
            iconFA: "flipbook-icon-times",
            iconM: "flipbook-icon-clear",
            hAlign: 'left',
            vAlign: 'bottom'
        },

        btnThumbs: {
            enabled: true,
            title: "Pages",
            iconFA: "flipbook-icon-th-large",
            iconM: "flipbook-icon-view_module",
            hAlign: 'left',
            vAlign: 'bottom'
        },

        menuMargin:0,
        menuBackground:'none',
        menuShadow:'none',
        menuAlignHorizontal:'right',
        menuOverBook:true,
        btnZoomIn : {enabled:false},
        btnZoomOut : {enabled:false},
        btnToc : {enabled:false},
        btnShare : {enabled:false},
        btnDownloadPages : {enabled:false},
        btnDownloadPdf : {enabled:false},
        btnSound : {enabled:false},
        btnBookmark:{enabled: false},
        btnSelect:{enabled: false},
        btnAutoplay : {enabled: false},
        btnPrint: {enabled: false},
        viewMode:'webgl',
        btnRadius:50,
        btnMargin:4,
        btnSize:15,
        // btnPaddingV:16,
        // btnPaddingH:16,
        btnColor: 'rgba(220,225,229)',
        btnBackground:'none',

        sideBtnRadius:30,
        sideBtnSize:30,
        sideBtnBackground:'none',
        sideBtnColor:'rgba(220,225,229)',
        })
    })

//   pekalongan
$(document).ready(function () {
$("#pekalongan").flipBook({
pdfUrl:"/assets/pdf/Hotel-Dafam-Pekalongan.pdf",
lightBox:true,
        lightboxBackground:'rgb(21,80,92,0.8)',
        // lightboxBackground:'none',
        lightBoxFullscreen:false,

        currentPage: {
            enabled: true,
            title: "Current page",
            vAlign: 'bottom',
            hAlign: 'left',
            marginH: 0,
            marginV: 0,
            background: 'none'
        },

        btnClose: {
            title: "Close",
            iconFA: "flipbook-icon-times",
            iconM: "flipbook-icon-clear",
            hAlign: 'right',
            vAlign: 'bottom',
            size: 15
        },

        btnExpand: {
            enabled: true,
            title: "Toggle fullscreen",
            iconFA: "flipbook-icon-times",
            iconM: "flipbook-icon-clear",
            hAlign: 'left',
            vAlign: 'bottom'
        },

        btnThumbs: {
            enabled: true,
            title: "Pages",
            iconFA: "flipbook-icon-th-large",
            iconM: "flipbook-icon-view_module",
            hAlign: 'left',
            vAlign: 'bottom'
        },

        menuMargin:0,
        menuBackground:'none',
        menuShadow:'none',
        menuAlignHorizontal:'right',
        menuOverBook:true,
        btnZoomIn : {enabled:false},
        btnZoomOut : {enabled:false},
        btnToc : {enabled:false},
        btnShare : {enabled:false},
        btnDownloadPages : {enabled:false},
        btnDownloadPdf : {enabled:false},
        btnSound : {enabled:false},
        btnBookmark:{enabled: false},
        btnSelect:{enabled: false},
        btnAutoplay : {enabled: false},
        btnPrint: {enabled: false},
        viewMode:'webgl',
        btnRadius:50,
        btnMargin:4,
        btnSize:15,
        // btnPaddingV:16,
        // btnPaddingH:16,
        btnColor: 'rgba(220,225,229)',
        btnBackground:'none',

        sideBtnRadius:30,
        sideBtnSize:30,
        sideBtnBackground:'none',
        sideBtnColor:'rgba(220,225,229)',
        })
    })

// pekanbaru
$(document).ready(function () {
$("#pekanbaru").flipBook({
pdfUrl:"/assets/pdf/Hotel-Dafam-Pekanbaru.pdf",
lightBox:true,
        lightboxBackground:'rgb(21,80,92,0.8)',
        // lightboxBackground:'none',
        lightBoxFullscreen:false,

        currentPage: {
            enabled: true,
            title: "Current page",
            vAlign: 'bottom',
            hAlign: 'left',
            marginH: 0,
            marginV: 0,
            background: 'none'
        },

        btnClose: {
            title: "Close",
            iconFA: "flipbook-icon-times",
            iconM: "flipbook-icon-clear",
            hAlign: 'right',
            vAlign: 'bottom',
            size: 15
        },

        btnExpand: {
            enabled: true,
            title: "Toggle fullscreen",
            iconFA: "flipbook-icon-times",
            iconM: "flipbook-icon-clear",
            hAlign: 'left',
            vAlign: 'bottom'
        },

        btnThumbs: {
            enabled: true,
            title: "Pages",
            iconFA: "flipbook-icon-th-large",
            iconM: "flipbook-icon-view_module",
            hAlign: 'left',
            vAlign: 'bottom'
        },

        menuMargin:0,
        menuBackground:'none',
        menuShadow:'none',
        menuAlignHorizontal:'right',
        menuOverBook:true,
        btnZoomIn : {enabled:false},
        btnZoomOut : {enabled:false},
        btnToc : {enabled:false},
        btnShare : {enabled:false},
        btnDownloadPages : {enabled:false},
        btnDownloadPdf : {enabled:false},
        btnSound : {enabled:false},
        btnBookmark:{enabled: false},
        btnSelect:{enabled: false},
        btnAutoplay : {enabled: false},
        btnPrint: {enabled: false},
        viewMode:'webgl',
        btnRadius:50,
        btnMargin:4,
        btnSize:15,
        // btnPaddingV:16,
        // btnPaddingH:16,
        btnColor: 'rgba(220,225,229)',
        btnBackground:'none',

        sideBtnRadius:30,
        sideBtnSize:30,
        sideBtnBackground:'none',
        sideBtnColor:'rgba(220,225,229)',
        })
    })

// marlin
$(document).ready(function () {
$("#marlin").flipBook({
pdfUrl:"/assets/pdf/Hotel-Marlin-Pekalongan.pdf",
lightBox:true,
        lightboxBackground:'rgb(21,80,92,0.8)',
        // lightboxBackground:'none',
        lightBoxFullscreen:false,

        currentPage: {
            enabled: true,
            title: "Current page",
            vAlign: 'bottom',
            hAlign: 'left',
            marginH: 0,
            marginV: 0,
            background: 'none'
        },

        btnClose: {
            title: "Close",
            iconFA: "flipbook-icon-times",
            iconM: "flipbook-icon-clear",
            hAlign: 'right',
            vAlign: 'bottom',
            size: 15
        },

        btnExpand: {
            enabled: true,
            title: "Toggle fullscreen",
            iconFA: "flipbook-icon-times",
            iconM: "flipbook-icon-clear",
            hAlign: 'left',
            vAlign: 'bottom'
        },

        btnThumbs: {
            enabled: true,
            title: "Pages",
            iconFA: "flipbook-icon-th-large",
            iconM: "flipbook-icon-view_module",
            hAlign: 'left',
            vAlign: 'bottom'
        },

        menuMargin:0,
        menuBackground:'none',
        menuShadow:'none',
        menuAlignHorizontal:'right',
        menuOverBook:true,
        btnZoomIn : {enabled:false},
        btnZoomOut : {enabled:false},
        btnToc : {enabled:false},
        btnShare : {enabled:false},
        btnDownloadPages : {enabled:false},
        btnDownloadPdf : {enabled:false},
        btnSound : {enabled:false},
        btnBookmark:{enabled: false},
        btnSelect:{enabled: false},
        btnAutoplay : {enabled: false},
        btnPrint: {enabled: false},
        viewMode:'webgl',
        btnRadius:50,
        btnMargin:4,
        btnSize:15,
        // btnPaddingV:16,
        // btnPaddingH:16,
        btnColor: 'rgba(220,225,229)',
        btnBackground:'none',

        sideBtnRadius:30,
        sideBtnSize:30,
        sideBtnBackground:'none',
        sideBtnColor:'rgba(220,225,229)',
        })
    })