document.addEventListener('error', function (event) {
  const img = event.target;
  if (!img || img.tagName !== 'IMG' || img.dataset.bookspotFallback === '1') return;
  img.dataset.bookspotFallback = '1';
  const placeholder = (document.querySelector('meta[name=bookspot-placeholder]') || {}).content || 'assets/uploads/placeholder-book.svg';
  const base = document.querySelector('meta[name=bookspot-base]');
  if (base && base.content) img.src = base.content + placeholder.replace(/^\//,'');
}, true);
