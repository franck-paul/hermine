/*global $ */
'use strict';

$('html').addClass('js');

// Show/Hide main menu
$('.header__nav').
before('<button id="hamburger" type="button"><span class="visually-hidden">Navigation</span></button>').
toggle();
$('#hamburger').on('click', function() {
  $(this).toggleClass('open');
  $('.header__nav').toggle('easing');
});

$(document).ready(function() {
  // totop scroll
  $(window).scroll(function() {
    if ($(this).scrollTop() !== 0) {
      $('#gotop').fadeIn();
    } else {
      $('#gotop').fadeOut();
    }
  });
  $('#gotop').on('click', function(e) {
    $('body,html').animate({
      scrollTop: 0
    }, 800);
    e.preventDefault();
  });

  // Add specific .wide-display class to paragraph with media inside, figure and video
  $('.post-content p a img, .post-content figure a img, .post-excerpt p a img, .post-excerpt figure a img, .content-info__cat-desc p a img, .content-info__cat-desc figure a img').each(function() {
    // Scheme = p a (for full-size media) img (for thumbnail-size media)
    var src = $(this).attr('src');
    var cls = 'wide-media';
    if (src.indexOf('http://') !== 0 && (src.indexOf('https://') !== 0)) {
      cls = cls + ' local-media';
    }
    $(this).parent().parent().addClass(cls);
  });
  $('.post-content video, .post-excerpt video').each(function() {
    $(this).addClass('wide-media');
  });

  // Add specific style if first local media is used in post header
  if ($('.media-title')) {
    $('.post-content .local-media:first-child, .post-excerpt .local-media:first-child').css('display', 'none');
  }
  if ($('.media-cat-title')) {
    $('.content-info__cat-desc .local-media:first-child').css('display', 'none');
  }
});
