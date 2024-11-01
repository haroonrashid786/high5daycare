<style>
#page-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(228, 239, 249, 0.7);
    backdrop-filter: blur(10px);
    z-index: 9998;
}

#loader {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 9999;
    text-align: center;
}

#loader img {
    width: 10rem;
    animation: heartbeat 1s ease infinite;
}

#loader p {
    font-size: 20px;
    margin-top: 12px;
    font-weight: bold;
}

@keyframes heartbeat {
    0% {
        transform: scale(0.8);
    }
    14% {
        transform: scale(1);
    }
    28% {
        transform: scale(0.8);
    }
    42% {
        transform: scale(1);
    }
    70% {
        transform: scale(0.8);
    }
    100% {
        transform: scale(0.8);
    }
}
</style>

<div id="page-overlay"></div>
<div id="loader">
    <img src="{{ asset('assets/media/logos/favicon.png') }}" alt="High5Daycare">
    <p>Processing...</p>
</div>


<script>
document.addEventListener("DOMContentLoaded", function() {

    document.addEventListener("submit", function(event) {
        event.preventDefault(); 
        var loader = document.getElementById("loader");
        var overlay = document.getElementById("page-overlay");
        overlay.style.display = "block";
        loader.style.display = "block";

        event.target.submit(); 

        setTimeout(function() {
            loader.classList.add("d-none");
        }, 7000);
    });

});
</script>