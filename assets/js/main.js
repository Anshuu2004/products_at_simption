/* assets/js/main.js */
/* Hover preview: floating preview on desktop, hero update fallback on small screens */
document.addEventListener('DOMContentLoaded', function(){
  const floatPreview = document.createElement('div');
  floatPreview.className = 'float-preview';
  floatPreview.innerHTML = '<img src="" alt="preview" style="width:100%;height:100%;object-fit:cover;">';
  document.body.appendChild(floatPreview);

  const fpImg = floatPreview.querySelector('img');
  const heroImg = document.getElementById('heroPreviewImg');

  let isMobile = window.matchMedia("(max-width: 768px)").matches;

  function onEnter(e){
    const target = e.currentTarget;
    const large = target.dataset.large;
    if (!large) return;
    if (!isMobile) {
      fpImg.src = large;
      floatPreview.style.display = 'block';
    } else {
      // mobile fallback: update hero image
      heroImg.src = large;
    }
  }

  function onMove(e){
    if (!isMobile) {
      const x = e.clientX + 20;
      const y = e.clientY + 20;
      floatPreview.style.left = x + 'px';
      floatPreview.style.top = y + 'px';
    }
  }

  function onLeave(){
    if (!isMobile) {
      floatPreview.style.display = 'none';
    }
  }

  document.querySelectorAll('.product-card').forEach(el=>{
    el.addEventListener('mouseenter', onEnter);
    el.addEventListener('mousemove', onMove);
    el.addEventListener('mouseleave', onLeave);
    // also support focus for accessibility
    el.addEventListener('focus', onEnter);
    el.addEventListener('blur', onLeave);
  });

  // update isMobile on resize
  window.addEventListener('resize', function(){
    isMobile = window.matchMedia("(max-width: 768px)").matches;
  });
});
