(function () {
  'use strict'
  var workerScript = document.currentScript.dataset.serviceWorker
  // adapted from create-react-app script

  if (workerScript && 'serviceWorker' in navigator) {
    window.addEventListener('load', function () {
      navigator.serviceWorker.register('/serviceworker.js', {scope: '/'})

      const showButton = () => {
        const b = window.addToHomeScreenBtn
        if (!b) {
          setTimeout(showButton, 100)
          return
        }
        b.style.display = 'block'
      }

      window.addEventListener('beforeinstallprompt', function(e) {
        if (window.bli_deferredPrompt === -1) return
        showButton()
        e.preventDefault()
        window.bli_deferredPrompt = e
      })
    })
  }

  if (window.matchMedia('(display-mode: standalone)').matches) {
    window.dataLayer.push({
      event: 'launchPWA',
      eventDetails: {
        action: 'launchPWA',
        category: 'retail-home'
      },
      pageType: 'retail-home',
      productType: 'Retail'
    })
  }
})()
