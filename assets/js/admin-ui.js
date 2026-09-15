(function(){
  'use strict';
  function qs(id){return document.getElementById(id)}
  function init(){
    var body=document.body, sidebar=qs('adminSidebar'), overlay=qs('sidebarOverlay'), toggle=qs('sidebarToggle');
    var noticeBtn=qs('noticeBtn'), noticeMenu=qs('noticeMenu'), userBtn=qs('adminUserBtn'), userMenu=qs('adminUserMenu'), themeToggle=qs('themeToggle');
    function mobile(){return window.innerWidth<=991}
    function sync(){
      if(!sidebar) return;
      var opened=sidebar.classList.contains('is-open');
      if(toggle) {
        toggle.setAttribute('aria-label', opened?'Close sidebar':'Open sidebar');
        toggle.title=opened?'Close sidebar':'Open sidebar';
        toggle.innerHTML=opened ? '<i class="fa-solid fa-xmark"></i>' : '<i class="fa-solid fa-bars"></i>';
        if(window.BookSpotIcons) window.BookSpotIcons.render();
      }
    }
    function close(){ if(!sidebar)return; sidebar.classList.remove('is-open'); if(mobile()){overlay&&overlay.classList.remove('show');body.style.overflow='';} else localStorage.setItem('bookspot-sidebar','closed'); sync(); }
    function open(){ if(!sidebar)return; sidebar.classList.add('is-open'); if(mobile()){overlay&&overlay.classList.add('show');body.style.overflow='hidden';} else localStorage.setItem('bookspot-sidebar','open'); sync(); }
    if(sidebar){
      if(mobile()) {
        sidebar.classList.remove('is-open');
      } else {
        var saved=localStorage.getItem('bookspot-sidebar');
        if(saved==='open') sidebar.classList.add('is-open');
        else sidebar.classList.remove('is-open');
      }
      sync();
    }
    toggle&&toggle.addEventListener('click',function(){ sidebar.classList.contains('is-open')?close():open(); });
    overlay&&overlay.addEventListener('click',close);
    window.addEventListener('resize',function(){ if(mobile()){ sidebar&&sidebar.classList.remove('is-open'); overlay&&overlay.classList.remove('show'); body.style.overflow=''; } sync(); });
    sidebar&&sidebar.querySelectorAll('a').forEach(function(a){a.addEventListener('click',function(){if(mobile())close();})});

    var dark=localStorage.getItem('bookspot-admin-mode')==='dark';
    if(dark) body.classList.add('theme-dark');
    function syncTheme(){
      if(!themeToggle)return;
      var isDark=body.classList.contains('theme-dark');
      themeToggle.innerHTML=isDark?'<i class="fa-solid fa-sun"></i><span class="theme-toggle-label">Light</span>':'<i class="fa-solid fa-moon"></i><span class="theme-toggle-label">Dark</span>';
    }
    syncTheme();
    themeToggle&&themeToggle.addEventListener('click',function(e){e.stopPropagation();body.classList.toggle('theme-dark');localStorage.setItem('bookspot-admin-mode',body.classList.contains('theme-dark')?'dark':'light');syncTheme(); if(window.BookSpotIcons)window.BookSpotIcons.render();});
    noticeBtn&&noticeBtn.addEventListener('click',function(e){e.stopPropagation(); if(noticeMenu)noticeMenu.classList.toggle('show');if(userMenu)userMenu.classList.remove('show');});
    userBtn&&userBtn.addEventListener('click',function(e){e.stopPropagation(); if(userMenu)userMenu.classList.toggle('show');if(noticeMenu)noticeMenu.classList.remove('show');});
    document.addEventListener('click',function(){noticeMenu&&noticeMenu.classList.remove('show');userMenu&&userMenu.classList.remove('show');});
  }
  if(document.readyState==='loading')document.addEventListener('DOMContentLoaded',init);else init();
})();
