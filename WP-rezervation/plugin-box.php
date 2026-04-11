<?php

/*
Plugin Name: Rezervacia Lightbox
Description: Otvori rezervaciu v iframe lightboxe pre pridanie kdekoľvek na stránku pridajte.
Version: 1.0.0
Author: Tvoje meno
*/

add_action('wp_footer', 'pridaj');
function pridaj() {
    ?>
    <style>
  .lb-backdrop{
    position:fixed; inset:0;
    background:rgba(0,0,0,.6);
    display:none;
    align-items:center;
    justify-content:center;
    z-index:9999;
    padding:16px;
  }
  .lb-backdrop.open{ display:flex; }
  .lb-box{
    width:min(820px, 100%);
    height:min(80vh, 760px);
    background:#fff;
    border-radius:14px;
    overflow:hidden;
    box-shadow:0 20px 60px rgba(0,0,0,.35);
    position:relative;
    padding: 20px;
  }
  .lb-close{
    position:absolute; top:8px; right:8px;
    z-index:2;
    border:0; border-radius:10px;
    padding:8px 10px;
    background:rgba(0,0,0,.08);
    cursor:pointer;
  }
  .lb-iframe{
    width:100%;
    height:100%;
    border:0;
  }
</style>

<div class="lb-backdrop" id="rezLb" aria-hidden="true">
  <div class="lb-box" role="dialog" aria-modal="true">
    <button class="lb-close" type="button" id="rezLbClose">✕</button>
    <iframe class="lb-iframe" id="rezIframe" src=""></iframe>
  </div>
</div>

<script>
  (function(){
    const lb = document.getElementById('rezLb');
    const iframe = document.getElementById('rezIframe');
    const btnClose = document.getElementById('rezLbClose');

    function openRezervacia(){
      iframe.src = 'http://localhost/crystal-media/rezervacia.php?api=(tu api kluc)&embed=1'; // uprav cestu ak treba
      lb.classList.add('open');
      lb.setAttribute('aria-hidden', 'false');
    }

    function closeRezervacia(){
      lb.classList.remove('open');
      lb.setAttribute('aria-hidden', 'true');
      iframe.src = ''; // stopne “život” iframe po zavretí
    }

    // klik na pozadie zavrie
    lb.addEventListener('click', (e) => {
      if(e.target === lb) closeRezervacia();
    });
    btnClose.addEventListener('click', closeRezervacia);

    // ESC zavrie
    document.addEventListener('keydown', (e) => {
      if(e.key === 'Escape' && lb.classList.contains('open')) closeRezervacia();
    });

    // sprístupni funkciu globálne
    window.openRezervacia = openRezervacia;
  })();
</script>
<?php
}

add_shortcode('box-rezervacia', 'plugin_rezervuj');
function plugin_rezervuj() {
    $html = '<button type="button" onclick="openRezervacia()">Rezervovať</button>';
    return $html;
}