let navabar = document.querySelector('.header .navbar');

document.querySelector('#menu-btn').onclick = () =>{
    navabar.classList.toggle('active');
}

document.querySelectorAll('.primera .video-container .controls .control-btn').forEach(btn =>{
    btn.onclick = () =>{
        let src = btn.getAttribute('data-src');
        document.querySelector('.primera .video-container .video').src = src;
    }
})