window.onload = () => {
  'use strict';

  if ('serviceWorker' in navigator) {
    navigator.serviceWorker
        .register('http://localhost/myci4/public/sw.js').then(r =>"");
   }
}
