<section id="loading" style="display:none;">
    <div class="loader-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100" overflow="visible" fill="#011428" stroke="none"><defs><rect id="loader" x="46.5" y="40" width="7" height="20" rx="2" ry="2" transform="translate(0 -30)" /></defs><use xlink:href="#loader" transform="rotate(45 50 50)"><animate attributeName="opacity" values="0;1;0" dur="1s" begin="0.13s" repeatCount="indefinite"></animate></use><use xlink:href="#loader" transform="rotate(90 50 50)"><animate attributeName="opacity" values="0;1;0" dur="1s" begin="0.25s" repeatCount="indefinite"></animate></use><use xlink:href="#loader" transform="rotate(135 50 50)"><animate attributeName="opacity" values="0;1;0" dur="1s" begin="0.38s" repeatCount="indefinite"></animate></use><use xlink:href="#loader" transform="rotate(180 50 50)"><animate attributeName="opacity" values="0;1;0" dur="1s" begin="0.50s" repeatCount="indefinite"></animate></use><use xlink:href="#loader" transform="rotate(225 50 50)"><animate attributeName="opacity" values="0;1;0" dur="1s" begin="0.63s" repeatCount="indefinite"></animate></use><use xlink:href="#loader" transform="rotate(270 50 50)"><animate attributeName="opacity" values="0;1;0" dur="1s" begin="0.75s" repeatCount="indefinite"></animate></use><use xlink:href="#loader" transform="rotate(315 50 50)"><animate attributeName="opacity" values="0;1;0" dur="1s" begin="0.88s" repeatCount="indefinite"></animate></use><use xlink:href="#loader" transform="rotate(360 50 50)"><animate attributeName="opacity" values="0;1;0" dur="1s" begin="1.00s" repeatCount="indefinite"></animate></use></svg>
    </div>
</section>
<style>
    #loading {
        z-index: 1000000;
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.4);
    }
    .loader-center {
        width: 100vw;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
<script>
    function showLoader() {
        document.getElementById('loading').style.display = 'block';
    }

    function hideLoader() {
        document.getElementById('loading').style.display = 'none';
    }

</script>