// jQuery
$(window).load(function() {
  // Gallery
  $('.image a, a.gallery-item[href$=jpg],a.gallery-item[href$=gif],a.gallery-item[href$=png],.gallery-item a[href$=jpg],.gallery-item a[href$=png],.gallery-item a[href$=gif]').magnificPopup({
    type: 'image',
    removalDelay: 300, // Delay removal by X to allow out-animation
    disableOn: 0,
    gallery: {
        enabled : true,
        disableOn: 0,
        tCounter: '<span class="mfp-counter">%curr% / %total%</span>'
    },
    callbacks: {

          beforeClose: function() {
            var self = this;
            self.wrap.addClass('mfp-animate');
          },

          close: function() {
            var self = this;
            self.wrap.removeClass('mfp-animate');
          },

          open: function() {

            // Overwrite default prev + next function. Add timeout for CSS3 crossfade animation
            $.magnificPopup.instance.next = function() {
              var self = this;
              self.wrap.removeClass('mfp-image-loaded');
              setTimeout(function() { $.magnificPopup.proto.next.call(self); }, 120);
            }
            $.magnificPopup.instance.prev = function() {
              var self = this;
              self.wrap.removeClass('mfp-image-loaded');
              setTimeout(function() { $.magnificPopup.proto.prev.call(self); }, 120);
            }

            // Add custom CSS class for different styling
            if( this.st.el && this.st.el.data('mfp-dudestyles') ) {
              this.wrap.addClass( this.currItem.el.data('mfp-dudestyles') );
            }

          },

          imageLoadComplete: function() {
            var self = this;
            setTimeout(function() { self.wrap.addClass('mfp-image-loaded'); }, 16);
          },

          change: function() {
              var img = this.content.find('img');
              img.css('max-height', parseFloat(img.css('max-height')) -200);
              if (this.isOpen) {
                this.wrap.addClass('mfp-open');
              }
          },

          resize: function() {
              var img = this.content.find('img');
              img.css('max-height', parseFloat(img.css('max-height')) -200);
          }
      },
      disableOn: 0,
      image : {
      markup : '<div class="mfp-figure">'+
              '<div class="mfp-close"></div>'+
              '<div class="mfp-img"></div>'+
              '<div class="mfp-bottom-bar">'+
                '<div class="mfp-title"></div>'+
                '<div class="mfp-counter"></div>'+
              '</div>'+
            '</div>'
    }
  });

  $('.video a.global-link').magnificPopup({
    type:'iframe',
    disableOn: 0
  });

  $('a.modal').magnificPopup({
    type:'iframe',
    disableOn: 0
  });
});
